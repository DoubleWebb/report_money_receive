$(document).ready(function () {
    $(".preloader").fadeOut();
    // ใช้งาน Select ผ่าน Theme Page ได้เลย
    One.helpers(['select2', 'datepicker']);
    $("#setting_special_day_date_today").html(moment().format('DD/MM/YYYY'));

    $("#input_special_day_date").flatpickr({
        "locale": "th"
    });

    // ตั้งค่า Modal ซ้อนกันได้
    $(document).on('show.bs.modal', '.modal', function (event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function () {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });
});

// Talbe 
$('#setting_special_day_table').DataTable({
    "processing": true,
    "serverSide": true,
    "aLengthMenu": [
        [10, 25, -1],
        ["10", "25", "ทั้งหมด"]
    ],
    "ajax": {
        "url": '/api/v1/get_table_setting_special_days',
        "type": 'GET',
        "async": true,
        error: function (xhr, error, code) {
            $('#setting_special_day_table').DataTable().draw();
        }
    },
    "columns": [{
        "data": 'special_day_date',
        "name": 'special_day_date',
    }, {
        "data": 'special_day_remark',
        "name": 'special_day_remark',
    }, {
        "data": 'special_day_status',
        "name": 'special_day_status',
    }],
    "columnDefs": [{
            "className": 'text-left',
            "targets": []
        },
        {
            "className": 'text-center',
            "targets": [0, 2]
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

var Open_Create_Special_Day = function Open_Create_Special_Day() {
    $("#modal_create_special_day").modal('show');

    $('#modal_create_special_day').on('hidden.bs.modal', function (e) {
        $("#input_special_day_date").removeClass('is-valid').removeClass('is-invalid');
        $("#input_special_day_remark").removeClass('is-valid').removeClass('is-invalid');
    })
}

var Save_Create_Special_Day = function Save_Create_Special_Day() {
    var Toast = Set_Toast();
    var Array_id = [
        'input_special_day_date',
        'input_special_day_remark'
    ];
    var Check_input = Check_null_input(Array_id);
    if (Check_input == true) {
        axios({
            method: 'POST',
            url: '/api/v1/save_create_special_day',
            data: {
                special_day_date: $("#input_special_day_date").val(),
                special_day_remark: $("#input_special_day_remark").val()
            }
        })
        .then(function (response) {
            $("#modal_create_special_day").modal('hide');
            $('#setting_special_day_table').DataTable().draw();
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