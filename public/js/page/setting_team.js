$(document).ready(function () {
    // ใช้งาน Select ผ่าน Theme Page ได้เลย
    One.helpers(['select2', 'flatpickr', 'datepicker']);
    $("#setting_team_date_today").html(moment().format('DD/MM/YYYY'));
    // GetTeam
    GetTeam($("#input_team_id").val());
    // ตั้งค่า Modal ซ้อนกันได้
    $(document).on('show.bs.modal', '.modal', function (event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function () {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });
});

var GetTeam = function GetTeam(e) {
    axios({
        method: 'POST',
        url: '/api/v1/get_card_setting_team',
        data: {
            team_id: $("#input_team_id").val()
        }
    })
    .then(function (response) {
        // ปิดการโหลดข้อมูล
        $(".preloader").fadeOut();
        var Html;
        var show_setting_team = '';
        $(response.data.data_team).each(function (index, team) {
            // ตั้งค่า HTML 
            Html  = '<div class="col-12 col-md-4">'
            Html += '<div class="card" style="width: 100%;">'
            Html += '<div class="card-header text-center bg-primary text-light">'
            Html += '<b>ตั้งค่า ' + team.team_name + '</b>'
            Html += '</div>'
            Html += '<div class="card-body">'
            Html += '<div class="row">'
            Html += '<div class="col-12 col-md-12">'
            Html += '<div class="form-group">'
            Html += '<label for="team_name">ชื่อ ทีม</label>'
            Html += '<input type="text" class="form-control" id="team_name_' + team.team_id + '" placeholder="ชื่อ ทีม">'
            Html += '</div>'
            Html += '<div class="form-group">'
            Html += '<label for="tean_location">สถานที่ ทีม</label>'
            Html += '<input type="text" class="form-control" id="tean_location_' + team.team_id + '" placeholder="สถานที่ ทีม">'
            Html += '</div>'
            Html += '<div class="form-group">'
            Html += '<label for="team_day_off">เลือกวันหยุด</label>'
            Html += '<select class="js-select2 form-control" id="team_day_off_' + team.team_id + '" style="width: 100%;" data-placeholder="เลือกวันหยุด" multiple>'
            Html += '<option value="0">วันอาทิตย์</option>'
            Html += '<option value="1">วันจันทร์</option>'
            Html += '<option value="2">วันอังคาร</option>'
            Html += '<option value="3">วันพุธ</option>'
            Html += '<option value="4">วันพฤหัสบดี</option>'
            Html += '<option value="5">วันศุกร์</option>'
            Html += '<option value="6">วันเสาร์</option>'
            Html += '</select>'
            Html += '</div>'
            Html += '<div class="form-group">'
            Html += '<label for="team_late_of_work">ปรับเวลามาสาย</label>'
            Html += '<input type="text" class="js-flatpickr form-control bg-white" id="team_late_of_work_' + team.team_id + '" placeholder="สถานที่ ทีม" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" data-time_24hr="true">'
            Html += '</div>'
            Html += '</div>'
            Html += '</div>'
            Html += '<div class="col-12 col-md-12 text-center">'
            Html += '<button class="btn btn-sm btn-success" save_team_id="' + team.team_id + '" onclick="Save_Team(this)">บันทึกข้อมูล</button>'
            Html += '</div>'
            Html += '</div>'
            Html += '</div>'
            Html += '</div>';

            show_setting_team += Html;
        });
        // แสดงข้อมูล HTML
        $("#show_setting_team").html(show_setting_team);
        // ตั้งค่า Select เป็น select2
        $(".js-select2").select2();
        $(".js-flatpickr").flatpickr();
        // ตั้งค่า Value
        $(response.data.data_team).each(function (index, team) {
            var team_day_off = team.team_day_off.split(',');
            $("#team_name_" + team.team_id).val(team.team_name);
            $("#tean_location_" + team.team_id).val(team.team_location);
            $("#team_day_off_" + team.team_id).val(team_day_off).trigger('change');
            $("#team_late_of_work_" + team.team_id).val(team.team_late_of_work);
        });
    })
    .catch(function (error) {
        console.log(error)
    })
}

var Save_Team = function Save_Team(e) {
    var Toast = Set_Toast();
    axios({
        method: 'POST',
        url: '/api/v1/save_setting_team',
        headers: {
            "Content-Type": "application/json"
        },
        data: {
            team_id: $(e).attr('save_team_id'),
            team_name: $("#team_name_" + $(e).attr('save_team_id')).val(),
            tean_location: $("#tean_location_" + $(e).attr('save_team_id')).val(),
            team_day_off: $("#team_day_off_" + $(e).attr('save_team_id')).val(),
            team_late_of_work: $("#team_late_of_work_" + $(e).attr('save_team_id')).val(),
        }
    })
    .then(function (response) {
        Toast.fire({
            icon: 'success',
            title: response.data.message
        })
    })
    .catch(function (error) {
        console.log(error.response);
    })
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