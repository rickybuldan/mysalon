var baseUrl = window.location.origin;
var csrfToken = $('meta[name="csrf-token"]').attr("content");
$(document).ready(function () {
    $("#label_employee").hide();
    $("#book-btn").hide();
    loadServices();
    $("#form-time").select2({
        placeholder: "choose a service",
    });

    $("#form-service").on("change", function () {
        var selectedValue = $(this).val();

        loadDate(selectedValue);
    });

    $("#min-date").on("change", function () {
        var selectedValue = $(this).val();
        if ($("#form-item-date").val()) {
            $("#min-date").attr("disabled", true);
        }
        loadTime(selectedValue);
    });

    $("#min-date, #form-time, #form-service").on("change", function () {
        $("#label_employee").hide();
        $("#list_employee").empty();

        var selectedValue0 = $("#form-service").val();

        var selectedValue1 = $("#min-date").val();

        var selectedValue2 = $("#form-time").val();

        if (selectedValue0 && selectedValue1 && selectedValue2) {
            getEmployees();
        }
        if ($("#form-item-date").val()) {
            $("#min-date").attr("disabled", true);
        }
    });

    $("#book-btn").on("click", function (e) {
        e.preventDefault();
        saveData();
    });
});

let isObject = {};
function itemToObj() {
    var data = {
        booking_date: $("#form-item-date").val(),
        booking_details: [],
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

    isObject = data;
    console.log(isObject);
}

function saveData() {
    itemToObj();
    console.log(isObject);
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    $.ajax({
        url: baseUrl + "/ajax-createbookingonline",
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
                    location.replace(
                        baseUrl + "/invoice?no-booking=" + response.data
                    );
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
    console.log(selectedValue);
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
        });
        console.log(response);
        dataService = response.data;
        const res = response.data.map(function (item) {
            return {
                id: item.id,
                text: item.service_name + " Rp. " + item.price,
            };
        });

        $("#form-service").select2({
            data: res,
            placeholder: "Please choose an option",
            allowClear: true,

            // dropdownParent: $("#modal-data"),
        });
        $("#form-service").val(null).trigger("change");
    } catch (error) {
        // sweetAlert("Oops...", error.responseText, "error");
    }
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

let name_service = "";
$("#form-service").on("change", function () {
    var selectedValue = $(this).val();
    var selectedOption = $(this).find("option:selected");
    var selectedText = selectedOption.text();
    name_service = selectedText;
    loadDate(selectedValue);
});

var c = 0;
$("#add-service-btn").on("click", function (e) {
    e.preventDefault();

    c++;
    date = $("#min-date").val();
    time = $("#form-time").val();

    var combinedDateTime = date + " " + time;
    var formattedDateTime = moment(combinedDateTime, "DD/MM/YYYY HH:mm").format(
        "YYYY-MM-DD HH:mm:ss"
    );

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
        <td><input type="text" id="form-item-date" class="form-control form-item" readonly  value="` +
            formattedDateTime +
            `"></input>
        <input type="hidden" class="form-control itemidservice form-item" value="` +
            service +
            `"></input>
        <input type="hidden" class="form-control itemidemployee form-item" value="` +
            employee +
            `"></input>
        </td>
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
            `')" class="btn btn-sm btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
          </svg></button>
        </td>
        </tr>`;
        $("#item-book").append(el);
    }

    checkItem();
    allPrice();
});

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

    $("#total-price").text(total);

    total = totalService + totalProduct * qty;
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
    if (count2 > 0) {
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

function getEmployees() {
    id = $("#form-service").val();
    date = $("#min-date").val();
    time = $("#form-time").val();
    var combinedDateTime = date + " " + time;
    var formattedDateTime = moment(combinedDateTime, "DD/MM/YYYY HH:mm").format(
        "YYYY-MM-DD HH:mm:ss"
    );
    $.ajax({
        url: baseUrl + "/ajax-getemployeebyservice",
        method: "GET",
        data: { id_service: id, date: formattedDateTime },
        success: function (response) {
            console.log(response);
            res = response.data;
            var targetElement = $("#list_employee");
            var row = "";
            var status = "";
            res.forEach(function (employee) {
                if (employee.status_booked == "Booked") {
                    status = `<div class="text-center"><span class="badge badge-secondary bg-warning mb-2">Booked</span></div>`;
                    id = "Booked";
                } else {
                    status = `<div class="text-center"><span class="badge badge-success bg-success mb-2">Idle</span></div>`;
                    id = employee.id_employee;
                }
                if (employee.path) {
                    path = baseUrl + "/images/" + employee.path;
                } else {
                    path = baseUrl + "/template/admin/images/product/1.jpg";
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
                    path +
                    `" alt="">
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
                $("#book-btn").show();
            } else {
                $("#book-btn").hide();
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
