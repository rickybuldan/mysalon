var baseUrl = window.location.origin;
var role = "";
var roletext = "";

// $(document).ready(function () {
//     loadRole();
// });

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
            url: baseUrl + "/ajax-listproducts",
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
            { data: "name" },
            { data: "price" },
            { data: "stock" },
            { data: "id" },
        ],
        columnDefs: [
            {
                mRender: function (data, type, row) {
                    var $rowData = `<button type="button" class="btn btn-primary btn-icon-sm mx-2 edit-btn"><i class="bi bi-pencil-square"></i></button>`;
                    $rowData += `<button type="button" class="btn btn-danger btn-icon-sm delete-btn"><i class="bi bi-x-square"></i></button>`;
                    return $rowData;
                },
                visible: true,
                targets: 4,
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
                .find(".delete-btn")
                .on("click", function () {
                    var tr = $(this).closest("tr");
                    var rowData = dtpr.row(tr).data();
                    deleteData(rowData);
                });
        },
    });
}
let isObject = {};
function editdata(rowData) {
    isObject = rowData;
    console.log(isObject);
    $("#form-price").val(rowData.price);
    $("#form-stock").val(rowData.stock);
    $("#form-name").val(rowData.name);
    // $("#form-role").val(rowData.id_role).trigger("change");

    // let $el = $("input:radio[name=form-status]");

    // $el.filter("[value=" + rowData.is_active + "]").prop("checked", true);

    $("#modal-data").modal("show");
}

$("#add-btn").on("click", function (e) {
    e.preventDefault();

    isObject = {};
    isObject["id"] = null;
    $("#form-price").val("");
    $("#form-stock").val("");
    $("#form-name").val("");
    // $("#form-role").val("").trigger("change");
    // $("input:radio[name=form-status]").prop("checked", false);
    $("#modal-data").modal("show");
});

$("#save-btn").on("click", function (e) {
    e.preventDefault();
    checkValidation();
});

function saveData() {
    console.log(isObject);
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    if (isObject["id"] == null) {
        url = baseUrl + "/ajax-createproduct";
    } else {
        url = baseUrl + "/ajax-updateproduct";
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

function checkValidation() {
    let $el = $("input:radio[name=form-status]:checked").val();
    // console.log($el);
    if (
        validationSwalFailed(
            (isObject["name"] = $("#form-name").val()),
            "Name field cannot be empty."
        )
    )
        return false;
    if (
        validationSwalFailed(
            (isObject["price"] = $("#form-price").val()),
            "Price field cannot be empty."
        )
    )
        return false;
    if (
        validationSwalFailed(
            (isObject["stock"] = $("#form-stock").val()),
            "Stock field cannot be empty."
        )
    )
        return false;
    // isObject["password"] = $("#form-password").val();
    saveData();
}

function validationSwalFailed(param, isText) {
    // console.log(param);
    if (param == "" || param == null) {
        sweetAlert("Oops...", isText, "warning");

        return 1;
    }
}

function deleteData(data) {
    console.log(data);
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    swal({
        title: "Are you sure to delete ?",
        text: "You will not be able to recover this imaginary file !!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it !!",
        cancelButtonText: "No, cancel it !!",
        closeOnConfirm: !1,
        closeOnCancel: !1,
    }).then(function (e) {
        console.log(e);
        if (e.value) {
            $.ajax({
                url: baseUrl + "/ajax-deleteproduct",
                type: "DELETE",
                data: JSON.stringify({ id: data.id }),
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
                        swal("Deleted !", response.message, "success").then(
                            function () {
                                location.reload();
                            }
                        );
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
