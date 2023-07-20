var baseUrl = window.location.origin;
var csrfToken = $('meta[name="csrf-token"]').attr("content");
$(document).ready(function () {
    loadServices();
    loadProducts();
    // loadCustomers();

    $("#label_employee").hide();
    $("#add-service-btn").hide();
    // $("#book-btn").hide();

    checkItem();

    $("#form-time").select2({
        placeholder: "choose a service",
    });

    $("#form-customer").select2({
        placeholder: "choose a customer",
    });

    // $("#form-customer").on("change", function () {
    //     var selectedValue = $(this).val();
    //     // var selectedOption = $(this).find("option:selected");
    //     // var selectedText = selectedOption.text();
    //     // name_service = selectedText;
    //     $("#form-phone-customer").val("");
    //     $("#form-email-customer").val("");
    //     $("#form-name-customer").val("");

    //     $("#form-phone-customer").prop("readonly", false);
    //     $("#form-email-customer").prop("readonly", false);
    //     $("#form-name-customer").prop("readonly", false);

    //     if (selectedValue) {
    //         res = getCustomerById(dataCustomer, selectedValue);

    //         $("#form-phone-customer").val(res.phone);
    //         $("#form-email-customer").val(res.email);
    //         $("#form-name-customer").val(res.name);

    //         $("#form-phone-customer").prop("readonly", true);
    //         $("#form-email-customer").prop("readonly", true);
    //         $("#form-name-customer").prop("readonly", true);
    //     }
    // });

    let name_service = "";
    $("#form-service").on("change", function () {
        var selectedValue = $(this).val();
        var selectedOption = $(this).find("option:selected");
        var selectedText = selectedOption.text();
        name_service = selectedText;
        if (selectedValue) {
            $("#add-service-btn").show();
            getEmployees();
            $("#list_employee").empty();
        } else {
            $("#add-service-btn").hide();
        }
    });

    $("#book-btn").on("click", function (e) {
        e.preventDefault();
        saveData();
    });

    let c = 0;

    $("#add-service-btn").on("click", function (e) {
        e.preventDefault();

        c++;
        date = $("#min-date").val();
        time = $("#form-time").val();

        var combinedDateTime = date + " " + time;
        var formattedDateTime = moment(
            combinedDateTime,
            "DD/MM/YYYY HH:mm"
        ).format("YYYY-MM-DD HH:mm:ss");

        service = $("#form-service").val();
        employee = $("input:radio[name=radioemployee]:checked").val();
        let priceService = 9;

        priceService = countPrice(dataService, service);
        totalService += priceService;

        // console.log(employee);
        name_employee = $("input:radio[name=radioemployee]:checked").data("id");

        stat = true;

        if (employee == "Booked") {
            stat = false;
            sweetAlert(
                "Oops...",
                "The selected employee is already booked.",
                "error"
            );
        } else if (employee == undefined) {
            stat = false;
            sweetAlert("Oops...", "Choose an employee.", "error");
        }

        $(".itemidservice").each(function () {
            var value = $(this).val();
            if (value == service) {
                sweetAlert("Oops...", "Service already exists.", "error");

                stat = false;
            }
        });

        if (stat) {
            el =
                `<tr class="dataitem" id="data` +
                c +
                `">
          
            <input type="hidden" class="form-control itemidservice form-item" value="` +
                service +
                `"></input>
            <input type="hidden" class="form-control itemidemployee form-item" value="` +
                employee +
                `"></input>
           
            <td><input type="text" class="form-control" readonly value="` +
                name_service +
                `"></input>
            </td>
            <td><input type="text" class="form-control" readonly value="` +
                name_employee +
                `"></input>
            </td>
            <td><button onclick="removeItem('data` +
                c +
                `')" class="btn btn-sm btn-danger"><i class="bi bi-x-square"></i></button>
            </td>
            </tr>`;
            $("#item-book").append(el);
        }

        checkItem();
        allPrice();
    });

    loadBookingService();
    loadBookingProduct();
});

function preventDeleteItem() {
    sweetAlert("Oops...", "Sorry, Cant Delete Item", "error");
}

function loadBookingService() {
    $.ajax({
        url: baseUrl + "/ajax-detbooking?id=" + idbooking,
        method: "GET",
        beforeSend: function () {
            Swal.fire({
                title: "Loading",
                text: "Please wait...",
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
            });
        },
        complete: function () {
            Swal.close();
        }, // Tipe data yang diharapkan sebagai respons
        success: function (res) {
            // Fungsi ini dijalankan jika permintaan berhasil
            // console.log(res);
            datax = res.data;
            // console.log(datax);
            $("#form-name-customer").val(datax[0].name_customer);
            $("#form-phone-customer").val(datax[0].phone);
            $("#form-email-customer").val(datax[0].email);
            var formattedDateTime = datax[0].booking_date;
            $("#form-item-date").val(formattedDateTime);
            c = 0;
            for (let index = 0; index < datax.length; index++) {
                // Contoh akses atribut 'date'
                var service = datax[index].id_service; // Contoh akses atribut 'idservice'
                var employee = datax[index].id_employee; // Contoh akses atribut 'idemployee'
                var name_service = datax[index].service_name; // Contoh akses atribut 'name_service'
                var name_employee = datax[index].employee_name;
                el =
                    `<tr class="dataitem" id="data` +
                    c +
                    `">
                    <input type="hidden" class="form-control itemidservice form-item" value="` +
                    service +
                    `"></input>
                    <input type="hidden" class="form-control itemidemployee form-item" value="` +
                    employee +
                    `"></input>
                   
                    <td><input type="text" class="form-control" readonly value="` +
                    name_service +
                    `"></input>
                    </td>
                    <td><input type="text" class="form-control" readonly value="` +
                    name_employee +
                    `"></input>
                    </td>
                    <td><button onclick="preventDeleteItem()" class="btn btn-sm btn-danger"><i class="bi bi-x-square"></i></button>
                    </td>
                    </tr>`;

                $("#item-book").append(el);
            }
            checkItem();
            allPrice();
        },
        error: function (xhr, status, error) {
            // Fungsi ini dijalankan jika terjadi kesalahan
            console.log(xhr.responseText);
        },
    });
}
function loadBookingProduct() {
    $.ajax({
        url: baseUrl + "/ajax-getdetbookingproduct?id=" + idbooking,
        method: "GET",
        beforeSend: function () {
            Swal.fire({
                title: "Loading",
                text: "Please wait...",
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
            });
        },
        complete: function () {
            Swal.close();
        }, // Tipe data yang diharapkan sebagai respons
        success: function (res) {
            // Fungsi ini dijalankan jika permintaan berhasil
            console.log(res);
            datax = res.data;
            d = 0;
            for (let index = 0; index < datax.length; index++) {
                var el = `
                <tr class="dataitem2" id="productdata${d}">
                  <td><input type="hidden" class="form-control itemidproduct form-item" value="${datax[index].id_product}"><input type="text" class="form-control" readonly value="${datax[index].name_product}"></td>
                  <td><input type="text" class="form-control itemqty" readonly value="${datax[index].quantity}"></td>
                  <td><button onclick="preventDeleteItem()" class="btn btn-sm btn-danger"><i class="bi bi-x-square"></i></button></td>
                </tr>
              `;
                $("#item-product").append(el);
            }
            checkItem();
            allPrice();
        },
        error: function (xhr, status, error) {
            // Fungsi ini dijalankan jika terjadi kesalahan
            console.log(xhr.responseText);
        },
    });
}

let name_product = "";
$("#form-product").on("change", function () {
    var selectedValue = $(this).val();
    var selectedOption = $(this).find("option:selected");
    var selectedText = selectedOption.text();
    name_product = selectedText;
});

let isObject = {};
function itemToObj() {
    let type = 1;
    if ($("#form-customer").val()) {
        type = 2;
    }
    var data = {
        id_booking: idbooking,
        total: totalAllItem,
        id_customer: $("#form-customer").val(),
        customer_name: $("#form-name-customer").val(),
        customer_email: $("#form-email-customer").val(),
        customer_phone: $("#form-phone-customer").val(),
        type: type,
        booking_date: $("#form-item-date").val(),
        booking_details: [],
        booking_products: [],
    };

    $(".dataitem").each(function () {
        var service = $(this).find(".itemidservice").val();
        var employee = $(this).find(".itemidemployee").val();

        var bookingDetail = {
            id_service: service,
            id_employee: employee,
        };

        data.booking_details.push(bookingDetail);
    });
    $(".dataitem2").each(function () {
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

function getCustomerById(array, selected) {
    datax = {};
    for (let index = 0; index < array.length; index++) {
        if (array[index].id == selected) {
            datax["name"] = array[index].name;
            datax["email"] = array[index].email;
            datax["phone"] = array[index].phone;
        }
    }
    return datax;
}
let totalAllItem = 0;

function allPrice() {
    totalService = 0;
    totalProduct = 0;

    let qtyArray = [];
    let productArray = [];

    $(".itemqty").each(function () {
        let value = $(this).val();
        qtyArray.push(parseInt(value));
    });

    $(".itemidproduct").each(function () {
        let value = $(this).val();
        let priceProduct = countPrice(dataProduct, value);
        productArray.push(parseInt(priceProduct));
    });

    for (let i = 0; i < qtyArray.length; i++) {
        totalProduct += qtyArray[i] * productArray[i];
    }

    $(".itemidservice").each(function () {
        value = $(this).val();
        priceService = countPrice(dataService, value);
        totalService += priceService;
    });

    let total = totalService + totalProduct;
    // console.log(productArray, "product", qtyArray, "qty");
    totalAllItem = total;
    $("#total-price").text(total);
}

function removeItem(el) {
    $("#" + el).remove();

    checkItem();
    allPrice();
}

function checkItem() {
    count = $("#item-book > tr").length;
    count2 = $("#item-product > tr").length;
    if (count2 > 0 || count) {
        // loadProducts();
        $("#no-datapic2").hide();
        $("#book-btn").show();
    } else {
        $("#no-datapic2").show();
        $("#book-btn").hide();
    }
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

function saveData() {
    itemToObj();
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    $.ajax({
        url: baseUrl + "/ajax-updatebookingproductservice",
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
                    location.replace(baseUrl + "/listbooking");
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

function loadDate(selectedValue) {
    $("#min-date").empty();
    if (selectedValue) {
        $("#min-date").prop("disabled", false);
        $("#min-date").bootstrapMaterialDatePicker({
            format: "DD/MM/YYYY",
            minDate: new Date(),
            time: false,
        });
    } else {
        $("#min-date").val("").trigger("change");
        $("#min-date").prop("disabled", true);
    }
}

function loadTime(selectedValue) {
    $("#form-time").empty();
    if (selectedValue) {
        $("#form-time").prop("disabled", false);
        $("#form-time").select2({
            data: getFilteredData(selectedValue),
            placeholder: "choose a time",
            templateResult: function (data) {
                if (!data.id) {
                    return data.text;
                }

                var formattedTime = moment(data.text, "HH:mm").format("HH");
                return $("<span>" + formattedTime + ":00" + "</span>");
            },
            templateSelection: function (data) {
                if (!data.id) {
                    return data.text;
                }

                var formattedTime = moment(data.text, "HH:mm").format("HH");
                return $("<span>" + formattedTime + ":00" + "</span>");
            },
        });
        $("#form-time").val(null).trigger("change");
    } else {
        $("#form-time").empty();

        $("#form-time").prop("disabled", true);
    }
}

function getFilteredData(selectedValue) {
    var data = [
        { id: "9", text: "09:00" },
        { id: "10", text: "10:00" },
        { id: "11", text: "11:00" },
        { id: "12", text: "12:00" },
        { id: "13", text: "13:00" },
        { id: "14", text: "14:00" },
        { id: "15", text: "15:00" },
        { id: "16", text: "16:00" },
        { id: "17", text: "17:00" },
    ];

    var now = moment(); // Mengambil waktu sekarang
    var future = moment().add(1, "hour").format("HH:mm"); // Menambahkan 1 jam pada waktu sekarang
    // var diffHours = future.diff(now, "hours");
    // console.log(now);
    // console.log(future);
    // console.log(diffHours);

    var filteredData = data.filter(function (item) {
        // return moment(item.text, "HH:mm").isAfter(future);
        // return item.text > future;
        var selectedDate = moment(selectedValue, "DD/MM/YYYY");
        if (selectedDate.isSame(now, "day")) {
            return item.text > future;
        } else {
            return true;
        }
    });
    return filteredData;
}

var dataService = [];
var dataProduct = [];
var dataCustomer = [];
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

async function loadCustomers() {
    try {
        const response = await $.ajax({
            url: baseUrl + "/ajax-listcustomers",
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
            dataCustomer = response.data;
            const res = response.data.map(function (item) {
                return {
                    id: item.id,
                    text: item.name,
                };
            });

            $("#form-customer").select2({
                data: res,
                placeholder: "Please choose an option",
                allowClear: true,

                // dropdownParent: $("#modal-data"),
            });

            $("#form-customer").val(null).trigger("change");
        }
    } catch (error) {
        // sweetAlert("Oops...", error.responseText, "error");
    }
}

function getEmployees() {
    id = $("#form-service").val();
    date = $("#form-item-date").val();
    time = $("#form-time").val();
    var combinedDateTime = date + " " + time;
    var formattedDateTime = moment(combinedDateTime, "DD/MM/YYYY HH:mm").format(
        "YYYY-MM-DD HH:mm:ss"
    );
    $.ajax({
        url: baseUrl + "/ajax-getemployeebyservice",
        method: "GET",
        data: { id_service: id, date: formattedDateTime },
        beforeSend: function () {
            Swal.fire({
                title: "Loading",
                text: "Please wait...",
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
            });
        },
        complete: function () {
            Swal.close();
        },
        success: function (response) {
            res = response.data;
            var targetElement = $("#list_employee");
            var row = "";
            var status = "";
            res.forEach(function (employee) {
                if (employee.status_booked == "Booked") {
                    status = `<div class="text-center"><span class="badge badge-sm  badge-secondary mb-2">Booked</span></div>`;
                    id = "Booked";
                } else {
                    status = `<div class="text-center"><span class="badge badge-sm  badge-success mb-2">Idle</span></div>`;
                    id = employee.id_employee;
                }
                row =
                    `
                    <div class="col-xl-2 col-md-6 col-sm-6 mx-0">
                   
                        <label>
                        ` +
                    status +
                    `
                            <input type="radio" name="radioemployee" value="${id}" data-id="${employee.name}">
                            <img class="img-fluid" src="` +
                    baseUrl +
                    `/template/admin/images/product/1.jpg") }}" alt="">
                            <p id="name-employee" class="text-center">${employee.name}</p>
                        </label>
                        
                    </div>
                `;

                // Menambahkan baris ke elemen target
                targetElement.append(row);
                if (employee.status_booked == "Booked") {
                    var radioElement = $(row).find("input[name=radioemployee]");
                    radioElement.prop("disabled", true);
                }
            });

            if (row) {
                $("#label_employee").show();
                // $("#book-btn").show();
            } else {
                // $("#book-btn").hide();
                $("#label_employee").hide();
            }

            // Handle success response
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
            // Handle error response
        },
    });
}

let d = 0;
$("#add-product-btn").on("click", function (e) {
    e.preventDefault();

    d++;

    product = $("#form-product").val();
    qty = $("#form-qty").val();
    let priceProduct = 9;

    priceProduct = countPrice(dataProduct, product);
    res = priceProduct * qty;
    totalProduct += parseInt(res);
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
        <tr class="dataitem2" id="productdata${d}">
          <td><input type="hidden" class="form-control itemidproduct form-item" value="${product}"><input type="text" class="form-control" readonly value="${name_product}"></td>
          <td><input type="text" class="form-control itemqty" readonly value="${qty}"></td>
          <td><button onclick="removeItem('productdata${d}')" class="btn btn-sm btn-danger"><i class="bi bi-x-square"></i></button></td>
        </tr>
      `;
        $("#item-product").append(el);
    }

    checkItem();
    allPrice();
});
