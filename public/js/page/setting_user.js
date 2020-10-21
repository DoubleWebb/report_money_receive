$(document).ready(function () {
    $(".preloader").fadeOut();
    // ใช้งาน Select ผ่าน Theme Page ได้เลย
    One.helpers(['select2', 'datepicker']);
    $("#setting_user_date_today").html(moment().format('DD/MM/YYYY'));
    // สร้าง Table
    Get_Table_User();
    // ดึงข้อมูล Select_Team
    Get_Select_Team();
});

var Get_Select_Team = function Get_Select_Team() {
    axios({
        method: 'GET',
        url: '/api/v1/get_select_team',
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(function (response) {
        // ดึงข้อมูลใส่ Select 
        var Data;
        var select_option_preview = '';
        $(response.data.data).each(function (index, value) {
            Data = '<option value="' + value.team_id + '">' + value.team_name + '</option>';

            select_option_preview += Data;
        });
        $("#create_view_show").html(select_option_preview);
        $("#edit_view_show").html(select_option_preview);
    })
    .catch(function (error) {
        console.log(error.response);
    })
}

var Open_Create_User = function Open_Create_User() {
    $("#modal_create_user").modal('show');

    $('#modal_create_user').on('hidden.bs.modal', function (e) {
        $("#create_name").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#create_username").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#create_password").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#create_type").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#create_view_show").removeClass('is-valid').removeClass('is-invalid').val('');
    })
}

var Save_Create_User = function Save_Create_User() {
    var Toast = Set_Toast();
    var Array_id = [
        'create_name',
        'create_username',
        'create_password',
        'create_type',
        'create_view_show'
    ];
    var Check_input = Check_null_input(Array_id);
    if (Check_input == true) {
        axios({
            method: 'POST',
            url: '/api/v1/save_create_user',
            data: {
                name: $("#create_name").val(),
                username: $("#create_username").val(),
                password: $("#create_password").val(),
                type: $("#create_type").val(),
                view_show: $("#create_view_show").val()
            }
        })
        .then(function (response) {
            $("#modal_create_user").modal('hide');
            $('#table_setting_user').DataTable().draw();
            Toast.fire({
                icon: 'success',
                title: response.data.message
            })
        })
        .catch(function (error) {
            console.log(error)
        })
    } else {
        Toast.fire({
            icon: 'error',
            title: 'ข้อมูลยังไม่ครบ'
        })
    }
}

var Open_Edit_User = function Open_Edit_User(e) {
    axios({
        method: 'POST',
        url: '/api/v1/get_user_data',
        data: {
            user_id: $(e).attr('user_id'),
        }
    })
    .then(function (response) {
        var view_show = response.data.data.view_show.split(',');
        $("#edit_name").val(response.data.data.name);
        $("#edit_username").val(response.data.data.username);
        $("#edit_type").val(response.data.data.type).trigger('change');
        $("#edit_view_show").val(view_show).trigger('change');

        $("#modal_edit_user").modal('show');
        $("#btn_save_edit_user").attr('user_id', $(e).attr('user_id'));
    })
    .catch(function (error) {
        console.log(error)
    })

    $('#modal_edit_user').on('hidden.bs.modal', function (e) {
        $("#edit_name").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#edit_username").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#edit_type").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#edit_view_show").removeClass('is-valid').removeClass('is-invalid').val('');
    })
}

var Save_Edit_User = function Save_Edit_User(e) {
    var Toast = Set_Toast();
    var Array_id = [
        'edit_name',
        'edit_username',
        'edit_type',
        'edit_view_show'
    ];
    var Check_input = Check_null_input(Array_id);
    if (Check_input == true) {
         axios({
            method: 'POST',
            url: '/api/v1/save_edit_user',
            data: {
                user_id: $(e).attr('user_id'),
                name: $("#edit_name").val(),
                type: $("#edit_type").val(),
                view_show: $("#edit_view_show").val()
            }
        })
        .then(function (response) {
            $("#modal_edit_user").modal('hide');
            $('#table_setting_user').DataTable().draw();
            Toast.fire({
                icon: 'success',
                title: response.data.message
            })
        })
        .catch(function (error) {
            console.log(error)
        })
    } else {
        Toast.fire({
            icon: 'error',
            title: 'ข้อมูลยังไม่ครบ'
        })
    }
}

var Get_Table_User = function Get_Table_User() {
    // Talbe 
    $('#table_setting_user').DataTable({
        "processing": true,
        "serverSide": true,
        "aLengthMenu": [
            [10, 25, -1],
            ["10", "25", "ทั้งหมด"]
        ],
        "ajax": {
            "url": '/api/v1/get_table_setting_user',
            "type": 'GET',
            "async": true,
            error: function (xhr, error, code) {
                $('#table_setting_user').DataTable().draw();
            }
        },
        "columns": [{
            "data": 'name',
            "name": 'name',
        }, {
            "data": 'username',
            "name": 'username',
        }, {
            "data": 'type',
            "name": 'type',
        }, {
            "data": 'view_show',
            "name": 'view_show',
        }, {
            "data": 'action',
            "name": 'action',
        }],
        "columnDefs": [{
                "className": 'text-left',
                "targets": []
            },
            {
                "className": 'text-center',
                "targets": [0, 1, 2, 4]
            },
            {
                "className": 'text-right',
                "targets": []
            },
        ],
        "language": {
            "url": Get_lang_data_table()
        },
        "search": {
            "regex": true
        },
        "order": [
            [0, "desc"]
        ]
    });

    function Get_lang_data_table() {
        var lang = $('html').attr('lang');
        if (lang == 'th') {
            var url = "//cdn.datatables.net/plug-ins/1.10.13/i18n/Thai.json";
        } else {
            var url = "//cdn.datatables.net/plug-ins/1.10.13/i18n/English.json";
        }
        return url;
    }
}

var Check_null_input = function Check_null_input(Array_id) {
    var success_rows = 0;
    var error_rows = 0;

    $(Array_id).each(function (index, value) {
        function Check_null_Input() {
            if ($("#" + value).val() == '') {
                $("#" + value).removeClass('is-valid').addClass('is-invalid');
                return false;
            } else {
                $("#" + value).removeClass('is-invalid').addClass('is-valid');
                return true;
            }
        }
        var Check_null_Input = Check_null_Input() == true ? success_rows++ : error_rows++;
    });
    var result = success_rows == Array_id.length ? true : false;
    return result;
}

var Set_Toast = function Set_Toast() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    return Toast
}