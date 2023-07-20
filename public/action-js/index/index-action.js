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
    });

    $("#book-btn").on("click", function (e) {
        e.preventDefault();
        saveData();
    });
});

function saveData() {
    date = $("#min-date").val();
    time = $("#form-time").val();
    var combinedDateTime = date + " " + time;
    var formattedDateTime = moment(combinedDateTime, "DD/MM/YYYY HH:mm").format(
        "YYYY-MM-DD HH:mm:ss"
    );
    service = $("#form-service").val();
    employee = $("input:radio[name=radioemployee]:checked").val();
    var data = {
        booking_date: formattedDateTime,
        booking_details: [
            {
                id_service: service,
                id_employee: employee,
            },
        ],
    };
    console.log(data);
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    $.ajax({
        url: baseUrl + "/ajax-createbookingonline",
        type: "POST",
        data: JSON.stringify(data),
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
