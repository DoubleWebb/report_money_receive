<!DOCTYPE html>
<html dir="ltr" lang="th">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} | Setting Team</title>
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
        <input type="hidden" id="input_team_id" value="{{ Auth::user()->view_show }}">
        @include('../component.head')
        <!-- Content -->
        <main id="main-container">
            <div class="bg-body-light">
                <div class="content content-full">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                        <h1 class="flex-sm-fill h3 my-2">
                            วันที่ <span id="setting_team_date_today"></span>
                            <button class="btn btn-sm btn-success" style="margin-left:5px;" onclick="Open_Create_Team()"><i class="fas fa-plus"></i> เพิ่ม Team</button>
                        </h1>
                        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-alt">
                                <li class="breadcrumb-item">Setting Team</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Content -->
            <div class="content">
                <!-- Overview -->
                <div class="row row-deck" id="show_setting_team">
                </div>
            </div>

            <!-- Modal_Create_User -->
            <div class="modal fade" id="modal_create_team" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
                <div class="modal-dialog modal-dialog-popin" role="document">
                    <div class="modal-content">
                        <div class="block block-rounded block-themed block-transparent mb-0">
                            <div class="block-header bg-success">
                                <h3 class="block-title"><i class="fas fa-plus"></i> เพิ่ม Team</h3>
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
                                            <label for="create_team_name">ชื่อ ทีม</label>
                                            <input type="text" class="form-control" id="create_team_name" placeholder="ชื่อ ทีม">
                                        </div>
                                        <div class="form-group">
                                            <label for="create_team_location">สถานที่</label>
                                            <input type="text" class="form-control" id="create_team_location" placeholder="สถานที่">
                                        </div>
                                        <div class="form-group">
                                            <label for="create_team_day_off">วันหยุด</label>
                                            <select class="js-select2 form-control" id="create_team_day_off" style="width: 100%;" data-placeholder="เลือกวันหยุด" multiple>
                                                <option value="0">วันอาทิตย์</option>
                                                <option value="1">วันจันทร์</option>
                                                <option value="2">วันอังคาร</option>
                                                <option value="3">วันพุธ</option>
                                                <option value="4">วันพฤหัสบดี</option>
                                                <option value="5">วันศุกร์</option>
                                                <option value="6">วันเสาร์</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="create_team_late_of_work">เวลามาสาย</label>
                                            <input type="text" class="js-flatpickr form-control bg-white" id="create_team_late_of_work" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" data-time_24hr="true">
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
                                        <button type="button" class="btn btn-sm btn-block btn-primary" onclick="Save_Create_Team()"><i class="fas fa-save"></i> บันทึก</button>
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
    <script src="{{ url('js/page/setting_team.js') }}"></script>
</html>