$(document).ready(function () {
    // ใช้งาน Select ผ่าน Theme Page ได้เลย
    One.helpers(['select2']);
    $("#dashboard_date_today").html(moment().format('DD/MM/YYYY'));
    // ใช้งาน ฟังชั่น
    Get_Employee();

    // ตั้งค่า Modal ซ้อนกันได้
    $(document).on('show.bs.modal', '.modal', function (event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function () {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });
});

var Get_Employee = function Get_Employee() {
    axios({
        method: 'GET',
        url: '/api/v1/get_employee_all',
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(function (response) {
        $(".preloader").fadeOut();
        // Get Data To Dashbaord
        var Data;
        var emp_row_preview = '';
        $(response.data.data_team).each(function (index, team) {
            Data  = '<div class="col-12"><div class="alert alert-primary text-center" style="width:100%" role="alert">';
            Data += team.team_name;
            Data += '</div></div>';
            $(response.data.data_emp).each(function (index, value) {
                if (value.emp_team == team.team_id) {
                    Data += '<div class="col-sm-6 col-xl-3">'
                    Data += '<div class="block block-rounded d-flex flex-column">'
                    Data += '<div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">'
                    Data += '<dl class="mb-0">'
                    Data += '<dt class="text-muted mb-0">ล่าสุด : <span class="text-success">' + moment(value.emp_work_last).format('HH:mm:ss DD/MM/YYYY') + '</span></dt>'
                    Data += '<dd class="text-muted mb-0">' + value.emp_firstname + ' ' + value.emp_lastname + '</dd>'
                    Data += '</dl>'
                    Data += '<div class="item item-rounded bg-body">'
                    Data += '<i class="fas fa-users font-size-h3 text-primary"></i>'
                    Data += '</div>'
                    Data += '</div>'
                    Data += '<div class="block-content block-content-full block-content-sm bg-body-light font-size-sm text-center">'
                    Data += '<a class="font-w500 d-flex align-items-center" emp_pin="' + value.emp_code + '" firstname="' + value.emp_firstname + '" lastname="' + value.emp_lastname + '" onclick="Open_Modl_Salary(this)" href="javascript:void(0)">'
                    Data += '<b>ดูข้อมูลเพิ่มเติม</b>'
                    Data += '<i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>'
                    Data += '</a>'
                    Data += '</div>'
                    Data += '</div>'
                    Data += '</div>';
                }
            });
            emp_row_preview += Data;
        });

        console.log(emp_row_preview);
        /*
        $(response.data).each(function (index, value) {

            Data = '<div class="col-sm-6 col-xl-3">'
            Data += '<div class="block block-rounded d-flex flex-column">'
            Data += '<div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">'
            Data += '<dl class="mb-0">'
            Data += '<dt class="text-muted mb-0">ล่าสุด : <span class="text-success">' + moment(value.emp_last_day).format('HH:mm:ss DD/MM/YYYY') + '</span></dt>'
            Data += '<dd class="text-muted mb-0">' + value.emp_firstname + ' ' + value.emp_lastname + '</dd>'
            Data += '</dl>'
            Data += '<div class="item item-rounded bg-body">'
            Data += '<i class="fas fa-users font-size-h3 text-primary"></i>'
            Data += '</div>'
            Data += '</div>'
            Data += '<div class="block-content block-content-full block-content-sm bg-body-light font-size-sm text-center">'
            Data += '<a class="font-w500 d-flex align-items-center" emp_pin="' + value.emp_pin + '" firstname="' + value.emp_firstname + '" lastname="' + value.emp_lastname + '" onclick="Open_Modl_Salary(this)" href="javascript:void(0)">'
            Data += '<b>ดูข้อมูลเพิ่มเติม</b>'
            Data += '<i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>'
            Data += '</a>'
            Data += '</div>'
            Data += '</div>'
            Data += '</div>';
            emp_row_preview += Data;
        });
        */
        $("#emp_row_preview").html(emp_row_preview);
    })
    .catch(function (error) {
        $(".preloader").fadeOut();
        console.log(error.response);
    })
}