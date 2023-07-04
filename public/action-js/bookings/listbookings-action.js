var baseUrl = window.location.origin;

$(document).ready(function () {
    // Ambil element "paid" berdasarkan id
    $("#pay-btn").hide();
    var paid = $("#form-pay-amount");

    // Ambil element tombol Bayar berdasarkan id
    var btnBayar = $("#pay-btn");

    // Ambil element kembalian berdasarkan id
    var kembalian = $("#form-change");

    // Tambahkan event onchange pada "paid"
    paid.on("keyup", function () {
        // console.log(paid.val());
        // Ambil nilai "paid"
        var paidAmount = parseInt(paid.val());
        kembalian.val(0);

        // Ambil nilai total_price dari elemen yang relevan
        var total_price = parseInt($("#form-total-price").val());

        // Periksa jika "paid" lebih besar atau sama dengan total_price
        if (paidAmount >= total_price) {
            // Tampilkan tombol Bayar
            btnBayar.show();

            // Hitung kembalian
            var kembalianAmount = paidAmount - total_price;

            // Tampilkan nilai kembalian
            kembalian.val(kembalianAmount);
        } else {
            // Sembunyikan tombol Bayar
            btnBayar.hide();

            // Kosongkan nilai kembalian
            kembalian.text("");
        }
    });
});

getListData();
function getListData() {
    // $.ajax({
    //     url: baseUrl + "/ajax-listusers",
    //     method: "GET",
    //     data: {},
    //     success: function (response) {
    //         console.log(response);
    //         // Handle success response
    //     },
    //     error: function (xhr, status, error) {
    //         console.log(xhr.responseText);
    //         // Handle error response
    //     },
    // });
    let dtpr = $("#table-list").DataTable({
        ajax: {
            url: baseUrl + "/ajax-listbookings",
            type: "GET",
            dataSrc: function (response) {
                if (response.code == 0) {
                    es = response.data;
                    // console.log(es);

                    return response.data;
                } else {
                    return response;
                }
            },
            complete: function () {
                // loaderPage(false);
            },
        },
        language: {
            oPaginate: {
                sFirst: "First",
                sLast: "Last",
                sNext: ">",
                sPrevious: "<",
            },
        },
        columns: [
            {
                data: "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            { data: "booking_date" },
            { data: "no_booking" },
            { data: "name_customer" },
            // { data: "category_name" },
            { data: "status" },
            { data: "is_paid" },
            // { data: "discount" },
            // { data: "total_price" },
            { data: "id" },
        ],
        columnDefs: [
            // {
            //     mRender: function (data, type, row) {
            //         // var $rowData = '<button class="btn btn-sm btn-icon isEdit i_update"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 text-info"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>';
            //         // $rowData += `<button class="btn btn-sm btn-icon delete-record i_delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>`;
            //         $rowData =
            //             ` <span class="badge badge-dark">` +
            //             row.category_name +
            //             `</span>`;
            //         return $rowData;
            //     },
            //     visible: true,
            //     targets: 4,
            //     className: "text-center",
            // },
            {
                mRender: function (data, type, row) {
                    // var $rowData = '<button class="btn btn-sm btn-icon isEdit i_update"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 text-info"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>';
                    // $rowData += `<button class="btn btn-sm btn-icon delete-record i_delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>`;
                    if (row.status == 0) {
                        $rowData = ` <span class="badge badge-info">Idle</span>`;
                    } else if (row.status == 1) {
                        $rowData = ` <span class="badge badge-success">Already Done</span>`;
                    } else {
                        $rowData = ` <span class="badge badge-danger">Expired</span>`;
                    }

                    return $rowData;
                },
                visible: true,
                targets: 4,
                className: "text-center",
            },
            {
                mRender: function (data, type, row) {
                    // var $rowData = '<button class="btn btn-sm btn-icon isEdit i_update"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 text-info"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>';
                    // $rowData += `<button class="btn btn-sm btn-icon delete-record i_delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>`;
                    if (row.is_paid == 1) {
                        $rowData = ` <span class="badge badge-info">Paid</span>`;
                    } else {
                        $rowData = ` <span class="badge badge-warning">Unpaid</span>`;
                    }

                    return $rowData;
                },
                visible: true,
                targets: 5,
                className: "text-center",
            },
            // {
            //     mRender: function (data, type, row) {
            //         // var $rowData = '<button class="btn btn-sm btn-icon isEdit i_update"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 text-info"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>';
            //         // $rowData += `<button class="btn btn-sm btn-icon delete-record i_delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>`;
            //         $rowData = ` <span class="badge badge-danger">Inactive</span>`;
            //         if (row.is_active == 1) {
            //             $rowData = `<span class="badge badge-success">Active</span>`;
            //         }
            //         return $rowData;
            //     },
            //     visible: true,
            //     targets: 4,
            //     className: "text-center",
            // },
            {
                mRender: function (data, type, row) {
                    var $rowData = `<button type="button" class="btn btn-primary btn-icon-sm mx-2 detail-btn"><i class="bi bi-eye"></i></button>`;
                    // var $rowData = `<button type="button" class="btn btn-primary btn-icon-sm mx-2 edit-btn"><i class="bi bi-pencil-square"></i></button>`;
                    // $rowData += `<button type="button" class="btn btn-danger btn-icon-sm delete-btn"><i class="bi bi-x-square"></i></button>`;
                    return $rowData;
                },
                visible: true,
                targets: 6,
                className: "text-center",
            },
        ],
        drawCallback: function (settings) {
            var api = this.api();
            var rows = api.rows({ page: "current" }).nodes();
            var last = null;

            $(rows)
                .find(".edit-btn")
                .on("click", function () {
                    var tr = $(this).closest("tr");
                    var rowData = dtpr.row(tr).data();
                    editdata(rowData);
                });
            $(rows)
                .find(".detail-btn")
                .on("click", function (e) {
                    e.preventDefault();
                    var tr = $(this).closest("tr");
                    var rowData = dtpr.row(tr).data();
                    if (dtprx) {
                        dtprx.destroy();
                    }
                    detaildata(rowData);
                });
            $(rows)
                .find(".delete-btn")
                .on("click", function (e) {
                    e.preventDefault();
                    var tr = $(this).closest("tr");
                    var rowData = dtpr.row(tr).data();
                    deleteData(rowData);
                });
        },
    });
}
let isObject = {};

let dtprx = "";
function detaildata(rowData) {
    if (rowData.status != 1) {
        $("#content-paid").remove();
    }
    isObject = rowData;
    dtprx = $("#table-list-det").DataTable({
        ajax: {
            url: baseUrl + "/ajax-detbooking",
            type: "GET",
            data: { id: rowData.id },
            dataSrc: function (response) {
                if (response.code == 0) {
                    es = response.data;
                    console.log(es);
                    $("#form-booking-date").val(es[0].booking_date);
                    $("#form-no-booking").val(es[0].no_booking);
                    $("#form-discount").val(es[0].discount);
                    $("#form-total-price").val(es[0].total_price);
                    if (rowData.is_paid == 1) {
                        el = `<span class="badge badge-success">Paid</span>`;
                        $("#content-paid").hide();
                    } else {
                        $("#content-paid").show();
                        el = `<span class="badge badge-danger">Unpaid </span>`;
                    }
                    $("#form-pay").html(el);

                    $("#modal-data").modal("show");
                    return response.data;
                } else {
                    return response;
                }
            },
            complete: function () {
                // loaderPage(false);
            },
        },
        language: {
            oPaginate: {
                sFirst: "First",
                sLast: "Last",
                sNext: ">",
                sPrevious: "<",
            },
        },
        columns: [
            {
                data: "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            { data: "service_name" },
            { data: "employee_name" },
            { data: "is_finish" },
        ],
        columnDefs: [
            {
                mRender: function (data, type, row) {
                    // var $rowData = '<button class="btn btn-sm btn-icon isEdit i_update"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 text-info"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>';
                    // $rowData += `<button class="btn btn-sm btn-icon delete-record i_delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>`;
                    if (row.is_finish == 0) {
                        $rowData = ` <span class="badge badge-info">Idle</span>`;
                    } else if (row.is_finish == 1) {
                        $rowData = ` <span class="badge badge-success">Already Done</span>`;
                    } else {
                        $rowData = ` <span class="badge badge-danger">Canceled/Expired</span>`;
                    }

                    return $rowData;
                },
                visible: true,
                targets: 3,
                className: "text-center",
            },
        ],
    });
}

$("#pay-btn").on("click", function (e) {
    e.preventDefault();
    payData();
});

function saveData() {
    console.log(isObject);
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    if (isObject["id"] == null) {
        url = baseUrl + "/ajax-createcustomer";
    } else {
        url = baseUrl + "/ajax-updatecustomer";
    }

    $.ajax({
        url: url,
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

function payData() {
    console.log(isObject);
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    swal({
        title: "Are you sure to update paid ?",
        text: "You only update once !!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, paid it !!",
        cancelButtonText: "No, cancel it !!",
        closeOnConfirm: !1,
        closeOnCancel: !1,
    }).then(function (e) {
        console.log(e);
        if (e.value) {
            $.ajax({
                url: baseUrl + "/ajax-updatepaidbooking",
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
                        swal(
                            "Already Paid !",
                            response.message,
                            "success"
                        ).then(function () {
                            location.reload();
                        });
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
        } else {
            swal(
                "Cancelled !!",
                "Hey, your imaginary file is safe !!",
                "error"
            );
        }
    });
}
