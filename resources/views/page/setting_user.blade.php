<!DOCTYPE html>
<html dir="ltr" lang="th">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} | Setting User</title>
    <!-- APP CSS -->
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('dashmix/js/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ url('dashmix/css/oneui.css') }}" rel="stylesheet">
    <link href="{{ url('dashmix/js/plugins/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ url('dashmix/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ url('dashmix/js/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
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
                            วันที่ <span id="setting_user_date_today"></span>
                        </h1>
                        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-alt">
                                <li class="breadcrumb-item">Setting User</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Content -->
            <div class="content">
                <!-- Overview -->
                <div class="row row-deck">
                    <div class="col-md-12 col-xl-12">
                        <div class="block" id="block_game_list_table">
                            <div class="block-header block-header-default">
                                <h3 class="block-title"><i class="fa fa-table"></i> รายการ User ทั้งหมด</h3>
                                <div class="block-options">
                                    <button class="btn btn-sm btn-success" onclick="Open_Create_User();"><i class="fa fa-plus"></i> เพิ่ม User</button>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-striped table-vcenter js-dataTable-full dataTable" style="width:100%" id="table_setting_user" role="grid">
                                        <thead>
                                            <tr role="row" class="text-center">
                                                <th>ชื่อ นามสกุล</th>
                                                <th>Username</th>
                                                <th>ประเภท</th>
                                                <th>สถานที่ดูแล</th>
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

            <!-- Modal_Create_User -->
            <div class="modal fade" id="modal_create_user" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
                <div class="modal-dialog modal-dialog-popin" role="document">
                    <div class="modal-content">
                        <div class="block block-rounded block-themed block-transparent mb-0">
                            <div class="block-header bg-success">
                                <h3 class="block-title"><i class="fas fa-plus"></i> เพิ่ม User</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content font-size-sm">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="create_name">ชื่อ นามสกุล</label>
                                            <input type="text" class="form-control" id="create_name" placeholder="ชื่อ นามสกุล">
                                        </div>
                                        <div class="form-group">
                                            <label for="create_username">Username</label>
                                            <input type="text" class="form-control" id="create_username" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <label for="create_password">Password</label>
                                            <input type="password" class="form-control" id="create_password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="create_type">ประเภท</label>
                                            <select class="js-select2 form-control" id="create_type" style="width: 100%;" data-placeholder="เลือก ประเภท">
                                                <option value="user">User</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="create_view_show">สถานที่ดูแล</label>
                                            <select class="js-select2 form-control" id="create_view_show" style="width: 100%;" data-placeholder="เลือก สถานที่ดูแล" multiple></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content block-content-full text-right border-top">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm btn-block btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm btn-block btn-primary" onclick="Save_Create_User()"><i class="fas fa-save"></i> บันทึก</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal_Edit_User -->
            <div class="modal fade" id="modal_edit_user" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
                <div class="modal-dialog modal-dialog-popin" role="document">
                    <div class="modal-content">
                        <div class="block block-rounded block-themed block-transparent mb-0">
                            <div class="block-header bg-warning">
                                <h3 class="block-title"><i class="fas fa-edit"></i> แก้ไขข้อมูล User</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content font-size-sm">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="edit_name">ชื่อ นามสกุล</label>
                                            <input type="text" class="form-control" id="edit_name" placeholder="ชื่อ นามสกุล">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_username">Username</label>
                                            <input type="text" class="form-control" id="edit_username" placeholder="Username" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_type">ประเภท</label>
                                            <select class="js-select2 form-control" id="edit_type" style="width: 100%;" data-placeholder="เลือก ประเภท">
                                                <option value="user">User</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_view_show">สถานที่ดูแล</label>
                                            <select class="js-select2 form-control" id="edit_view_show" style="width: 100%;" data-placeholder="เลือก สถานที่ดูแล" multiple></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content block-content-full text-right border-top">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm btn-block btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm btn-block btn-primary" id="btn_save_edit_user" onclick="Save_Edit_User(this)"><i class="fas fa-save"></i> บันทึก</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- End Content -->
        @include('../component.footer')
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
    <script src="{{ url('js/page/setting_user.js') }}"></script>
</html>