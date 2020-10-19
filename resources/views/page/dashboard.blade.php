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
        <div class="modal fade" id="modal_salary" tabindex="-1" role="dialog" aria-labelledby="modal_salary" aria-hidden="true">
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
                                            <p class="mb-0"><b><i class="fas fa-user-tie"></i> ชื่อพนักงาน | <span id="modal_salary_name_preview"></span></b></p>
                                        </div>
                                    </div>                            
                                </div>
                            </div>
                            <div class="block block-rounded">
                                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#btabs-alt-static-home"><i class="fas fa-tachometer-alt"></i> หน้าหลัก</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#btabs-alt-static-profile"><i class="fas fa-table"></i> เพิ่มลดค่าแรง</a>
                                    </li>
                                    <li class="nav-item ml-auto">
                                        <a class="nav-link" href="#btabs-alt-static-settings"><i class="si si-settings"></i> ตั้งค่า</a>
                                    </li>
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="btabs-alt-static-home" role="tabpanel">
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
                                    <div class="tab-pane" id="btabs-alt-static-profile" role="tabpanel">
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
                                    <div class="tab-pane" id="btabs-alt-static-settings" role="tabpanel">
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
    <script src="{{ url('js/page/dashboard.js') }}"></script>
</html>