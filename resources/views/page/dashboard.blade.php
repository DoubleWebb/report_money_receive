<!DOCTYPE html>
<html dir="ltr" lang="th">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} | Dashboard</title>
    <!-- APP CSS -->
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('dashmix/js/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ url('dashmix/css/oneui.css') }}" rel="stylesheet">
    <link href="{{ url('dashmix/js/plugins/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ url('dashmix/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link href="{{ url('dashmix/js/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Loader -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- From -->
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">
        @include('../component.head')
        <!-- Content -->
        <main id="main-container">
            <div class="bg-body-light">
                <div class="content content-full">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                        <h1 class="flex-sm-fill h3 my-2">
                            วันที่ <span id="dashboard_date_today"></span>
                        </h1>
                        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-alt">
                                <li class="breadcrumb-item">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Content -->
            <div class="content">
                <div class="row row-deck" id="emp_row_preview"></div>

            </div>
        </main>
        <!-- End Content -->
        @include('../component.footer')

        <!-- Modeal Salary -->
        <div class="modal fade" id="modal_salary" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modal_salary" aria-hidden="true">
            <div class="modal-dialog modal-dialog-popin modal-xl" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">รายละเอียดการมาทำงานของ พนักงาน</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="alert alert-primary d-flex align-items-center" role="alert">
                                        <div class="flex-fill ml-3">
                                            <p class="mb-0"><b><i class="fas fa-user-tie"></i> ชื่อพนักงาน | <span id="modal_salary_name_preview"></span></b> 
                                            | <span id="modal_salary_in_work"></span>
                                            </p>
                                        </div>
                                    </div>                            
                                </div>
                            </div>
                            <div class="block block-rounded">
                                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tab_1"><i class="fas fa-tachometer-alt"></i> หน้าหลัก</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab_2"><i class="fas fa-table"></i> เพิ่มลดค่าแรง</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab_3"><i class="fas fa-dove"></i> ลา ล่วงหน้า</a>
                                    </li>
                                    @if (Auth::user()->type == 'admin')
                                    <li class="nav-item ml-auto">
                                        <a class="nav-link" href="#tab_right"><i class="si si-settings"></i> ตั้งค่า</a>
                                    </li>
                                    @endif
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="tab_1" role="tabpanel">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="block block-rounded block-themed">
                                                    <div class="block-header">
                                                        <h3 class="block-title">สรุปเงินเดือนทั้งหมด <small>เดือนล่าสุด</small></h3>
                                                        <div class="block-options">
                                                            <select class="js-select2 form-control" id="select_modal_salary_tab_1" style="width: 100%;"></select>
                                                        </div>
                                                    </div>
                                                    <div class="block-content shadow">  
                                                        <div class="row">
                                                            <div class="col-12 col-md-3">
                                                                <div class="block block-bordered block-themed">
                                                                    <div class="block-header text-center bg-success">
                                                                        <h3 class="block-title">จำนวนวันที่มาทำงาน</h3>
                                                                    </div>
                                                                    <div class="block-content text-center">
                                                                        <dt class="font-size-h2 font-w700 mb-3"><span class="badge badge-success" id="show_block_1"></span></dt>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                                <div class="block block-bordered block-themed">
                                                                    <div class="block-header text-center bg-danger">
                                                                        <h3 class="block-title">จำนวนวันที่ขาดงาน</h3>
                                                                    </div>
                                                                    <div class="block-content text-center">
                                                                        <dt class="font-size-h2 font-w700 mb-3"><span class="badge badge-danger" id="show_block_2"></span></dt>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                                <div class="block block-bordered block-themed">
                                                                    <div class="block-header text-center bg-dark">
                                                                        <h3 class="block-title">จำนวนวัน OT</h3>
                                                                    </div>
                                                                    <div class="block-content text-center">
                                                                        <dt class="font-size-h2 font-w700 mb-3"><span class="badge badge-dark" id="show_block_3"></span></dt>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                                <div class="block block-bordered block-themed">
                                                                    <div class="block-header text-center bg-info">
                                                                        <h3 class="block-title">เงินที่ได้รับทั้งหมด</h3>
                                                                    </div>
                                                                    <div class="block-content text-center">
                                                                        <dt class="font-size-h2 font-w700 mb-3"><span class="badge badge-info" id="show_block_4"></span></dt>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_2" role="tabpanel">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="block block-rounded block-themed">
                                                    <div class="block-header">
                                                        <h3 class="block-title">ตารางเพิ่มลดค่าแรง <small>เดือนล่าสุด</small></h3>
                                                        <div class="block-options">
                                                            <select class="js-select2 form-control" id="select_modal_salary_tab_2" style="width: 100%;"></select>
                                                        </div>
                                                    </div>
                                                    <div class="block-content shadow">
                                                        <div class="table-responsive">
                                                            <table class="table table-sm table-bordered table-striped table-vcenter js-dataTable-full dataTable" style="width:100%" id="table_employee_work" role="grid">
                                                                <thead>
                                                                    <tr role="row" class="text-center">
                                                                        <th>วันที่</th>
                                                                        <th>เวลาเข้างาน</th>
                                                                        <th>เวลาออกงาน</th>
                                                                        <th>สถานะ</th>
                                                                        <th>เงินรายวัน</th>
                                                                        <th>เครื่องมือ</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_3" role="tabpanel">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="block block-rounded block-themed">
                                                    <div class="block-header">
                                                        <h3 class="block-title">วันลาล่วงหน้า <small>ทั้งหมด</small></h3>
                                                        <div class="block-options">
                                                            <button class="btn btn-sm btn-success" onclick="Open_Holiday_In_Advance();"><i class="fas fa-plus"></i> เพิ่มวันลาล่วงหน้า</button>
                                                        </div>
                                                    </div>
                                                    <div class="block-content shadow">  
                                                        <div class="table-responsive">
                                                            <table class="table table-sm table-bordered table-striped table-vcenter js-dataTable-full dataTable" style="width:100%" id="table_holiday_in_advance" role="grid">
                                                                <thead>
                                                                    <tr role="row" class="text-center">
                                                                        <th>วันที่ลาล่วงหน้า</th>
                                                                        <th>หมายเหตุ</th>
                                                                        <th>สถานะ</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_right" role="tabpanel">
                                        <div class="block block-rounded block-themed">
                                            <div class="block-header">
                                                <h3 class="block-title">ตั้งค่าของพนักงาน</h3>
                                            </div>
                                            <div class="block-content shadow">
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="input_emp_salary"><i class="fas fa-money-bill-wave-alt"></i> เงินเดือน</label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" id="input_emp_salary" placeholder="เงินเดือนของพนักงาน">
                                                                <div class="input-group-append">
                                                                    <button type="button" class="btn btn-success" id="btn_input_emp_salary" onclick="Change_The_Amount(this)"><i class="fas fa-save"></i> ยืนยัน</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <!-- ขวามือ -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-right border-top">
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-sm btn-block btn-danger mr-1" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modeal Change The Amount -->
        <div class="modal fade" id="modal_choose_a_reduction" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
            <div class="modal-dialog modal-dialog-popin" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title"><i class="fas fa-exchange-alt"></i> เปลี่ยนจำนวนเงิน</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm">
                            <div class="form-group">
                                <label for="select_choose_a_reduction">เลือกประเภท</label>
                                <select class="js-select2 form-control" id="select_choose_a_reduction" style="width: 100%;">
                                    <option value="2">วันหยุดล่วงหน้า</option>
                                    <option value="3">ลา</option>
                                    <option value="4">หักเงิน 75%</option>
                                    <option value="5">หักเงิน 50%</option>
                                    <option value="6">หักเงิน 25%</option>
                                </select>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-right border-top">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-block btn-danger mr-1" data-dismiss="modal"><i class="fas fa-times"></i> ยกเลิก</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-block btn-success" id="btn_choose_a_reduction" onclick="Save_Choose_A_Reduction(this)"><i class="fas fa-save"></i> ยืนยัน</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modeal Change The Amount -->
        <div class="modal fade" id="modal_holiday_in_advance" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
            <div class="modal-dialog modal-dialog-popin" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title"><i class="fas fa-dove"></i> เลือก วันลาล่วงหน้า</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm">
                            <div class="form-group">
                                <label for="holiday_in_advance_date">เลือก ระหว่างวันที่ เริ่มต้น - สิ้นสุด</label>
                                <input type="text" class="js-flatpickr form-control bg-white" id="holiday_in_advance_date" placeholder="เลือก ระหว่างวันที่ เริ่มต้น - สิ้นสุด" data-mode="range" locale="th" data-min-date="today">
                            </div>
                            <div class="form-group">
                                <label for="holiday_in_advance_remark">หมายเหตุ</label>
                                <textarea class="form-control" id="holiday_in_advance_remark" rows="3" placeholder="หมายเหตุของการลาล่วงหน้า"></textarea>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-right border-top">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-block btn-danger mr-1" data-dismiss="modal"><i class="fas fa-times"></i> ยกเลิก</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-block btn-success" id="btn_holiday_in_advance" onclick="Save_Holiday_In_Advance(this)"><i class="fas fa-save"></i> ยืนยัน</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
    <!-- APP JS -->
    <script src="{{ url('js/app.js') }}"></script>
    <script src="{{ url('dashmix/js/oneui.app.min.js') }}"></script>
    <script src="{{ url('dashmix/js/oneui.core.min.js') }}"></script>
    <script src="{{ url('dashmix/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('dashmix/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('dashmix/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('dashmix/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ url('dashmix/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ url('dashmix/js/plugins/flatpickr/l10n/th.js') }}"></script>
    <script src="{{ url('js/page/dashboard.js?t=1') }}"></script>
</html>