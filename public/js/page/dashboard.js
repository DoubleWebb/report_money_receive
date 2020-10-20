$(document).ready(function () {
    // ใช้งาน Select ผ่าน Theme Page ได้เลย
    One.helpers(['select2']);
    $("#dashboard_date_today").html(moment().format('DD/MM/YYYY'));
    // ใช้งาน ฟังชั่น
    Get_Employee();
    // Table
    Get_Table_Emplyee_Work();

    // ตั้งค่า Modal ซ้อนกันได้
    $(document).on('show.bs.modal', '.modal', function (event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function () {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });

    // Table select_modal_salary_tab_2 เวลามีการเปลี่ยนวันที่ 
    $.fn.dataTable.ext.errMode = 'none';
    $(document).on('change', '#select_modal_salary_tab_2', function () {
        $('#table_employee_work').DataTable().ajax.url('/api/v1/get_table_emplyee_work?emp_code=' + $(this).attr('emp_code') + '&emp_team=' + $(this).attr('emp_team') + '&select_month=' + $(this).val()).load();
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
            Data += 'ทีม '+ team.team_name;
            Data += '</div></div>';
            $(response.data.data_emp).each(function (index, value) {
                var emp_firstname = value.emp_firstname != null ? value.emp_firstname : '';
                var emp_lastname = value.emp_lastname != null ? value.emp_lastname : '';
                if (value.emp_team == team.team_id) {
                    Data += '<div class="col-sm-6 col-xl-3">'
                    Data += '<div class="block block-rounded d-flex flex-column">'
                    Data += '<div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">'
                    Data += '<dl class="mb-0">'
                    Data += '<dt class="text-muted mb-0">ล่าสุด : <span class="text-success">' + moment(value.emp_work_last).format('HH:mm:ss DD/MM/YYYY') + '</span></dt>'
                    Data += '<dd class="text-muted mb-0">' + emp_firstname + ' ' + emp_lastname + '</dd>'
                    Data += '</dl>'
                    Data += '<div class="item item-rounded bg-body">'
                    Data += '<i class="fas fa-users font-size-h3 text-primary"></i>'
                    Data += '</div>'
                    Data += '</div>'
                    Data += '<div class="block-content block-content-full block-content-sm bg-body-light font-size-sm text-center">'
                    Data += '<a class="font-w500 d-flex align-items-center" emp_code="' + value.emp_code + '" emp_team="' + value.emp_team + '" firstname="' + value.emp_firstname + '" lastname="' + value.emp_lastname + '" onclick="Open_Modl_Salary(this)" href="javascript:void(0)">'
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
        $("#emp_row_preview").html(emp_row_preview);
    })
    .catch(function (error) {
        $(".preloader").fadeOut();
        console.log(error.response);
    })
}

var Open_Modl_Salary = function Open_Modl_Salary(e) {
    var emp_code = $(e).attr('emp_code');
    var emp_team = $(e).attr('emp_team');
    $("#modal_salary").modal('show');
    var firstname = $(e).attr('firstname') != null ? $(e).attr('firstname') : '';
    var lastname = $(e).attr('lastname') != null ? $(e).attr('lastname') : '';
    $("#modal_salary_name_preview").html(firstname + ' ' + lastname);
    
    // เปิดการโหลดข้อมูลสำหรับการแสดง
    Load_Empolyee_Data(emp_code, emp_team);
    // โหลดข้อมูล พนักงาน
    Load_Select_Empolyee(emp_code, emp_team);
    // โหลด Dashboard โดยรวม
    Load_Dashboard_Data(emp_code, emp_team,$("#select_modal_salary_tab_1").val());

    $('#modal_salary').on('hidden.bs.modal', function (e) {
        $("#modal_salary_name_preview").html('');
        $("#input_emp_salary").val('');
    });
}

var Load_Select_Empolyee = function Load_Select_Empolyee(emp_code, emp_team) {
    axios({
        method: 'POST',
        url: '/api/v1/load_select_empolyee',
        headers: {
            "Content-Type": "application/json"
        },
        data: {
            emp_code: emp_code,
            emp_team: emp_team
        }
    })
    .then(function (response) {
        var Data;
        var select_option_preview = '';
        var emp_code;
        $(response.data).each(function (index, value) {
            if (index == 0) {
                Data = '<option value="' + value.select_month_value + '" selected>' + value.select_month_show + '</option>';
            } else {
                Data = '<option value="' + value.select_month_value + '">' + value.select_month_show + '</option>';
            }
            select_option_preview += Data;
            emp_code = value.emp_code;
        });
        $("#select_modal_salary_tab_1").html(select_option_preview).attr("emp_code", emp_code).attr('emp_team', emp_team).trigger('change');
        $("#select_modal_salary_tab_2").html(select_option_preview).attr("emp_code", emp_code).attr('emp_team', emp_team).trigger('change');
    })
    .catch(function (error) {
        console.log(error.response);
    })
}

var Load_Empolyee_Data = function Load_Empolyee_Data(emp_code, emp_team) {
    axios({
        method: 'POST',
        url: '/api/v1/load_empolyee_data',
        headers: {
            "Content-Type": "application/json"
        },
        data: {
            emp_code: emp_code,
            emp_team: emp_team
        }
    })
    .then(function (response) {
        $("#input_emp_salary").val(response.data.emp_salary);
        $("#btn_input_emp_salary").attr('emp_code', response.data.emp_code);
        $("#btn_input_emp_salary").attr('emp_team', response.data.emp_team);
    })
    .catch(function (error) {
        console.log(error.response);
    })
}

var Load_Dashboard_Data = function Load_Dashboard_Data(emp_code, emp_team, select_month) {
    axios({
        method: 'POST',
        url: '/api/v1/load_dashboard_data',
        headers: {
            "Content-Type": "application/json"
        },
        data: {
            emp_code: emp_code,
            emp_team: emp_team,
            select_month: select_month
        }
    })
    .then(function (response) {
        $("#show_block_1").html(response.data.data.bloack_1);
        $("#show_block_2").html(response.data.data.block_2);
        $("#show_block_3").html(response.data.data.block_3);
        $("#show_block_4").html(response.data.data.block_4);
    })
    .catch(function (error) {
        console.log(error.response);
    })
}

var Get_Table_Emplyee_Work = function Get_Table_Emplyee_Work() {
    // Talbe 
    $('#table_employee_work').DataTable({
        "processing": true,
        "serverSide": true,
        "aLengthMenu": [
            [10, 25, -1],
            ["10", "25", "ทั้งหมด"]
        ],
        "ajax": {
            "url": '/api/v1/get_table_emplyee_work?emp_pin=0&emp_team=0&select_month=0000-00-00',
            "type": 'GET',
            "async": true,
            error: function (xhr, error, code) {
                $('#table_employee_work').DataTable().draw();
            }
        },
        "columns": [{
            "data": 'date_work',
            "name": 'date_work',
        }, {
            "data": 'punch_time_in',
            "name": 'punch_time_in',
        }, {
            "data": 'punch_time_out',
            "name": 'punch_time_out',
        }, {
            "data": 'work_text_status',
            "name": 'work_text_status',
        }, {
            "data": 'work_day_money',
            "name": 'work_day_money',
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
                "targets": [0, 1, 2, 3, 4]
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

var Change_The_Amount = function Change_The_Amount(e) {
    axios({
        method: 'POST',
        url: '/api/v1/change_the_amount',
        headers: {
            "Content-Type": "application/json"
        },
        data: {
            emp_code: $(e).attr('emp_code'),
            emp_team: $(e).attr('emp_team'),
            emp_salary: $("#input_emp_salary").val()
        }
    })
    .then(function (response) {
        $('#table_employee_work').DataTable().draw();
    })
    .catch(function (error) {
        console.log(error.response);
    })
}

var Choose_A_Reduction = function Choose_A_Reduction(e) {
    $("#modal_choose_a_reduction").modal('show');
    $("#btn_choose_a_reduction").attr('work_id', $(e).attr('work_id'));
}

var Save_Choose_A_Reduction = function Save_Choose_A_Reduction(e) {
    axios({
        method: 'POST',
        url: '/api/v1/save_choose_a_reduction',
        headers: {
            "Content-Type": "application/json"
        },
        data: {
            work_id: $(e).attr('work_id'),
            choose_a_reduction: $("#select_choose_a_reduction").val()
        }
    })
    .then(function (response) {
        $("#modal_choose_a_reduction").modal('hide');
        $('#table_employee_work').DataTable().draw();
    })
    .catch(function (error) {
        console.log(error.response);
    })
}