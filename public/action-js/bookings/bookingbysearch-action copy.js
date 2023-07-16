var baseUrl = window.location.origin;

var dataService = [];
var dataProduct = [];
$("#book-btn").hide();
loadProducts();
async function loadServices() {
    try {
        const response = await $.ajax({
            url: baseUrl + "/ajax-listservices",
            type: "GET",
            dataType: "json",
            beforeSend: function () {
                // Swal.fire({
                //     title: "Loading",
                //     text: "Please wait...",
                // });
            },
            complete: function () {},
        });

        if (response.code == 0) {
            dataService = response.data;
            const res = response.data.map(function (item) {
                return {
                    id: item.id,
                    text:
                        item.service_name +
                        " (duration " +
                        item.duration +
                        " minutes)",
                };
            });
            $("#form-service").select2({
                data: res,
                placeholder: "Please choose an option",
                allowClear: true,

                // dropdownParent: $("#modal-data"),
            });
            $("#form-service").val(null).trigger("change");
        }
    } catch (error) {
        // sweetAlert("Oops...", error.responseText, "error");
    }
}
async function loadProducts() {
    try {
        const response = await $.ajax({
            url: baseUrl + "/ajax-getlistproducts",
            type: "GET",
            dataType: "json",
            beforeSend: function () {
                // Swal.fire({
                //     title: "Loading",
                //     text: "Please wait...",
                // });
            },
            complete: function () {},
        });

        if (response.code == 0) {
            dataProduct = response.data;
            console.log(dataProduct);
            const res = response.data.map(function (item) {
                return {
                    id: item.id,
                    text: item.name,
                };
            });

            $("#form-product").select2({
                data: res,
                placeholder: "Please choose an option",
                allowClear: true,

                // dropdownParent: $("#modal-data"),
            });
            $("#form-product").val(null).trigger("change");
        }
    } catch (error) {
        // sweetAlert("Oops...", error.responseText, "error");
    }
}

let name_product = "";
$("#form-product").on("change", function () {
    var selectedValue = $(this).val();
    var selectedOption = $(this).find("option:selected");
    var selectedText = selectedOption.text();
    name_product = selectedText;
});

let c = 0;
$("#add-product-btn").on("click", function (e) {
    e.preventDefault();

    c++;

    product = $("#form-product").val();
    qty = $("#form-qty").val();

    stat = true;

    $(".itemidproduct").each(function () {
        var value = $(this).val();
        if (value == product) {
            sweetAlert("Oops...", "product already exists.", "error");

            stat = false;
        }
    });

    if (stat) {
        var el = `
        <tr class="dataitem" id="data${c}">
          <td><input type="hidden" class="form-control itemidproduct form-item" value="${product}"><input type="text" class="form-control" readonly value="${name_product}"></td>
          <td><input type="text" class="form-control itemqty" readonly value="${qty}"></td>
          <td><button onclick="removeItem('data${c}')" class="btn btn-sm btn-danger"><i class="bi bi-x-square"></i></button></td>
        </tr>
      `;
        $("#item-product").append(el);
    }

    checkItem();
    allPrice();
});

function checkItem() {
    count = $("#item-product > tr").length;
    if (count > 0) {
        // loadProducts();
        $("#no-datapic").hide();
        $("#book-btn").show();
        $("#min-date").prop("disabled", true);
        $("#form-time").prop("disabled", true);
    } else {
        $("#min-date").prop("disabled", false);
        $("#form-time").prop("disabled", false);
        $("#no-datapic").show();
        $("#book-btn").hide();
    }
}

function removeItem(el) {
    $("#" + el).remove();

    checkItem();
    allPrice();
}

let totalService = 0;
let totalProduct = 0;
function countPrice(array, selected) {
    for (let index = 0; index < array.length; index++) {
        if (array[index].id == selected) {
            price = array[index].price;
        }
    }
    return price;
}

function allPrice() {
    totalProduct = 0;
    qty = $("#form-qty").val();
    $(".itemidproduct").each(function () {
        value = $(this).val();
        priceProduct = countPrice(dataProduct, value);
        totalProduct += parseInt(priceProduct);
    });

    total = totalProduct * qty;
    $("#total-price").text(total);
}

function itemToObj() {
    var data = {
        id_booking: idbooking,
        // booking_details: [],
        booking_products: [],
    };

    // $(".dataitem").each(function () {
    //     var service = $(this).find(".itemidservice").val();
    //     var employee = $(this).find(".itemidemployee").val();

    //     var bookingDetail = {
    //         id_service: service,
    //         id_employee: employee,
    //     };

    //     data.booking_details.push(bookingDetail);
    // });
    $(".dataitem").each(function () {
        var product = $(this).find(".itemidproduct").val();
        var qty = $(this).find(".itemqty").val();

        var bookingDetail = {
            id_product: product,
            qty: qty,
        };

        data.booking_products.push(bookingDetail);
    });

    isObject = data;
    console.log(isObject);
}

$("#book-btn").on("click", function (e) {
    e.preventDefault();
    saveData();
});

var isObject = {};

function saveData() {
    itemToObj();
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    $.ajax({
        url: baseUrl + "/ajax-updatebookingproduct",
        type: "POST",
        data: JSON.stringify(isObject),
        dataType: "json",
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": csrfToken, // Sertakan CSRF token dalam headers permintaan
        },
        beforeSend: function () {
            Swal.fire({
                title: "Loading",
                text: "Please wait...",
            });
        },
        complete: function () {},
        success: function (response) {
            // Handle response sukses
            if (response.code == 0) {
                swal("Saved !", response.message, "success").then(function () {
                    location.reload();
                });
                // Reset form
            } else {
                sweetAlert("Oops...", response.message, "error");
            }
        },
        error: function (xhr, status, error) {
            // Handle error response
            // console.log(xhr.responseText);
            sweetAlert("Oops...", xhr.responseText, "error");
        },
    });
}
