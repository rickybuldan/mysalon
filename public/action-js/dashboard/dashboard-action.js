var baseUrl = window.location.origin;
$(document).ready(function () {});

getListData();
function getListData() {
    let dtpr = $("#table-top-booked").DataTable({
        paging: false, // Menghilangkan pagination
        searching: false, // Menghilangkan search
        info: false,
        ordering: false,
        ajax: {
            url: baseUrl + "/ajax-gettopservice",
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
            { data: "service_name" },
            { data: "total_bookings", class: "text-center" },
        ],
    });
}

getTotalTable();
function getTotalTable() {
    $.ajax({
        url: baseUrl + "/ajax-gettotaltable",
        method: "GET",
        data: {},
        beforeSend: function () {},
        complete: function () {},
        success: function (response) {
            // Handle response sukses
            res = response.data;
            console.log(res);
            if (response.code == 0) {
                for (var i = 0; i < res.length; i++) {
                    var row = res[i];
                    var html = row.total_records;
                    $("#form-tot-" + row.table_name).html(html);
                }
            } else {
                $("#form-tot-employee").html(0);
                $("#form-tot-booking").html(0);
                $("#form-tot-users").html(0);
                $("#form-tot-revenue").html(0);
            }
        },
        error: function (xhr, status, error) {
            // Handle error response
            // console.log(xhr.responseText);
            sweetAlert("Oops...", xhr.responseText, "error");
        },
    });
}
getListData2();
function getListData2() {
    let dtpr = $("#table-latest-booked").DataTable({
        paging: false, // Menghilangkan pagination
        searching: false, // Menghilangkan search
        info: false,
        ordering: false,
        ajax: {
            url: baseUrl + "/ajax-getrecentbookings",
            type: "GET",
            dataSrc: function (response) {
                if (response.code == 0) {
                    es = response.data;
                    console.log(es);

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
            { data: "no_booking" },
            { data: "status", class: "text-center" },
            { data: "is_paid", class: "text-center" },
        ],
        columnDefs: [
            {
                mRender: function (data, type, row) {
                    // var $rowData = '<button class="btn btn-sm btn-icon isEdit i_update"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 text-info"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>';
                    // $rowData += `<button class="btn btn-sm btn-icon delete-record i_delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>`;
                    if (row.status == 0) {
                        $rowData = ` <span class="badge badge-info">Idle</span>`;
                    } else if (row.status == 1) {
                        $rowData = ` <span class="badge badge-success">Already Done</span>`;
                    } else {
                        $rowData = ` <span class="badge badge-danger">Canceled/Expired</span>`;
                    }

                    return $rowData;
                },
                visible: true,
                targets: 2,
                className: "text-center",
            },
            {
                mRender: function (data, type, row) {
                    // var $rowData = '<button class="btn btn-sm btn-icon isEdit i_update"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 text-info"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>';
                    // $rowData += `<button class="btn btn-sm btn-icon delete-record i_delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>`;
                    if (row.is_paid == 1) {
                        $rowData = ` <span class="badge badge-success">Paid</span>`;
                    } else {
                        $rowData = ` <span class="badge badge-warning">Unpaid</span>`;
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
