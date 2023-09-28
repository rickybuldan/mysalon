var baseUrl = window.location.origin;
var dtpr = "";

getListData();

function getListData() {
    var now = moment().format("YYYY-MM-DD");
    // console.log(now);
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
    dtpr = $("#table-list").DataTable({
        ajax: {
            url: baseUrl + "/ajax-listbookings",
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
        dom: "Bfrtip",
        buttons: [
            // {
            //     extend: "excel",
            //     text: "Export Excel",
            //     className: "btn btn-success btn-xxs ",
            //     filename: "Service-Report-" + now,
            //     customize: function (xlsx) {
            //         var sheet = xlsx.xl.worksheets["sheet1.xml"];
            //         $('sheetData row c[r^="A"]', sheet).each(function (index) {
            //             if (index === 0) {
            //                 $(this).attr("s", "2");
            //                 var cell = $("is t", this);
            //                 cell.text("Daily Service Bookings Report"); // Ganti dengan judul yang diinginkan
            //             }
            //         });
            //     },
            // },
            {
                extend: "excelHtml5",
                text: "Export Excel",
                className: "btn btn-success btn-xxs",
                filename: "Service-Report-" + now,
                title: "Laporan Harian Service Pointcut",
                customize: function (xlsx) {
                    var sheet = xlsx.xl.worksheets["sheet1.xml"];
                    var headerRow = $("row", sheet).eq(0);
                    $("c", headerRow).each(function () {
                        var cell = $(this);
                        cell.attr("s", "2"); // Menjadikan teks header menjadi tebal
                        cell.find("font").attr("color", "#000000"); // Mengubah warna teks header menjadi hitam
                    });
                },
                customizeData: function (data) {
                    for (var i = 0; i < data.body.length; i++) {
                        for (var j = 0; j < data.body[i].length; j++) {
                            if (i === 0) {
                                data.body[i][j].filter = true; // Menambahkan filter di header
                            }
                        }
                    }
                },
            },

            {
                extend: "pdfHtml5",
                text: "Export PDF",
                className: "btn btn-danger btn-xxs",
                filename: "Service-Report-" + now,
                title: "Laporan Harian Service Pointcut",
                customize: function (doc) {
                    // Tambahkan header di sini
                    var now = new Date().toISOString().slice(0, 10);
                    var header = {
                        columns: [
                            {
                                image: imagebase64, // Ganti dengan path gambar Anda
                                width: 90,
                                height: 48, // Lebar gambar
                                alignment: "left", // Tambahkan alignment left
                                valign: "middle",
                            },
                            {
                                text: "POINTCUT SALON\nMAKE UP AND HAIR STUDIO",
                                style: "headerStyle",
                                fontSize: 18,
                                alignment: "center", // Posisi teks di tengah secara horizontal
                                valign: "middle", // Mengatur rata tengah secara vertikal pada teks
                                // margin: [10, 0, 0, 0],
                            },
                        ],
                        columnGap: 10, // Jarak antara gambar dan teks
                        // margin: [10, 10], // Jarak atas header
                    };
                    doc.content.unshift(header);

                    // Setiap halaman
                    for (var i = 0; i < doc.content.length; i++) {
                        var table = doc.content[i];
                        if (table.hasOwnProperty("table")) {
                            // Setiap tabel
                            var body = table.table.body;
                            for (var row = 0; row < body.length; row++) {
                                var rowCells = body[row];
                                for (
                                    var col = 0;
                                    col < rowCells.length;
                                    col++
                                ) {
                                    // Setiap sel
                                    var cell = rowCells[col];
                                    cell.alignment = "center"; // Mengatur rata tengah pada sel
                                    cell.valign = "middle"; // Mengatur rata tengah secara vertikal pada sel
                                }
                            }
                        }
                    }

                    var footer = {
                        columns: [
                            {
                                text:
                                    "\n\n\n\nBandung," +
                                    now +
                                    ", " +
                                    "\nPenanggung Jawab\n\n\n\n\nKasir", // Ganti dengan nama kasir yang sesuai
                                style: "footerStyle",
                                alignment: "right", // Posisi teks di pojok kanan bawah
                                margin: [50, 0, 0, 0],
                            },
                        ],
                        columnGap: 10, // Jarak antara teks
                        margin: [0, 0, 0, 0], // Jarak atas dan kanan footer
                    };
                    doc.content.push(footer);
                },
            },
        ],
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
            { data: "total_duration", class: "text-center" },
            { data: "total_price", class: "text-center" },
            // { data: "discount" },
            // { data: "total_price" },
            // { data: "id" },
        ],
        // order: [[0, "created_at"]],
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
            {
                mRender: function (data, type, row) {
                    var $rowData = `<button type="button" class="btn btn-primary btn-icon-sm mx-2 detail-btn"><i class="bi bi-eye"></i></button>`;
                    return $rowData;
                },
                width: "95px",
                visible: true,
                targets: 8,
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

                    // console.log(rowData);
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

function detaildata(rowData) {
    isObject = rowData;
    dtprx = $("#table-list-det").DataTable({
        ajax: {
            url: baseUrl + "/ajax-detbooking",
            type: "GET",
            data: { id: rowData.id },
            beforeSend: function () {
                Swal.fire({
                    title: "Loading...",
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    },
                });
            },
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
                    } else {
                        el = `<span class="badge badge-danger">Unpaid </span>`;
                    }
                    $("#form-pay").html(el);

                    return response.data;
                } else {
                    return response;
                }
            },
            complete: function () {
                // loaderPage(false);
                Swal.close();
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
    dtprx2 = $("#table-det-product").DataTable({
        ajax: {
            url: baseUrl + "/ajax-getdetbookingproduct",
            type: "GET",
            data: { id: rowData.id },
            dataSrc: function (response) {
                if (response.code == 0) {
                    console.log(response);
                    return response.data;
                } else {
                    return response;
                }
            },
            beforeSend: function () {
                Swal.fire({
                    title: "Loading...",
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    },
                });
            },
            complete: function () {
                // loaderPage(false);
                Swal.close();
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
            { data: "name_product" },
            { data: "quantity" },
        ],
        columnDefs: [],
    });
    $("#modal-data").modal("show");
}

function exportExcel() {
    var originalExportAction =
        $.fn.dataTable.Buttons.defaults.exportOptions.modifier.page;

    // Menyimpan fungsi asli untuk mengatur judul
    $.fn.dataTable.Buttons.defaults.exportOptions.modifier.page = function (
        opts,
        searchData,
        action
    ) {
        var title = "Judul Laporan"; // Ganti dengan judul yang diinginkan
        var newOptions = originalExportAction(opts, searchData, action);
        newOptions.title = title;
        return newOptions;
    };

    // Panggil fungsi ekspor Excel bawaan DataTables
    dtpr.DataTable().button(".buttons-excel").trigger();

    // Mengembalikan fungsi asli setelah ekspor selesai
    $.fn.dataTable.Buttons.defaults.exportOptions.modifier.page =
        originalExportAction;
}

var imageUrl = baseUrl + "/template/admin/images/logoapps.png";

// Fungsi untuk mengambil gambar dan mengonversi ke base64
function getBase64Image(imageUrl, callback) {
    var img = new Image();
    img.crossOrigin = "Anonymous"; // Mengatasi masalah kebijakan cross-origin
    img.onload = function () {
        var canvas = document.createElement("canvas");
        canvas.width = img.width;
        canvas.height = img.height;

        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0);

        var dataURL = canvas.toDataURL("image/jpeg"); // Anda bisa mengganti "image/jpeg" dengan format yang sesuai

        callback(dataURL);
    };
    img.src = imageUrl;
}

// Panggil fungsi untuk mengambil gambar dan menyimpan dalam variabel imagebase64
var imagebase64;
getBase64Image(imageUrl, function (base64) {
    imagebase64 = base64;
    console.log(imagebase64); // Tampilkan dalam konsol untuk pemeriksaan
    // Lakukan apa pun yang Anda inginkan dengan data base64 ini
});
