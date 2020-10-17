<!DOCTYPE html>
<html dir="ltr" lang="th">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} | Setting Special Days</title>
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
                            วันที่ <span id="setting_special_day_date_today"></span>
                        </h1>
                        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-alt">
                                <li class="breadcrumb-item">Setting Special Days</li>
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
                                <h3 class="block-title"><i class="fa fa-table"></i> รายการ วันที่เพิ่ม OT</h3>
                                <div class="block-options">
                                    <button class="btn btn-sm btn-success" onclick="Open_Create_Special_Day();"><i class="fa fa-plus"></i> เพิ่มวัน OT</button>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-striped table-vcenter js-dataTable-full dataTable" style="width:100%" id="setting_special_day_table" role="grid">
                                        <thead>
                                            <tr role="row" class="text-center">
                                                <th>วันที่</th>
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
        </main>
        <!-- End Content -->
        @include('../component.footer')
    </div>

    <!-- Modeal Create -->
    <div class="modal fade" id="modal_create_special_day" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title"><i class="fa fa-plus"></i> เพิ่มวัน OT</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <div class="form-group">
                            <label for="input_special_day_remark">เลือกวันที่ จะเพิ่ม OT</label>
                            <input type="text" class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input active" id="input_special_day_date" placeholder="เลือกวันที่" data-min-date="today">
                        </div>
                        <div class="form-group">
                            <label for="input_special_day_remark">Remark วันหยุด OT</label>
                            <input type="text" class="form-control" id="input_special_day_remark" placeholder="กรอก หมายเหตุ วันหยุด OT">
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-block btn-danger mr-1" data-dismiss="modal"><i class="fas fa-times"></i> ยกเลิก</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-block btn-success" id="btn_choose_a_reduction" onclick="Save_Create_Special_Day()"><i class="fas fa-save"></i> ยืนยัน</button>
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
    <script src="{{ url('js/page/setting_special_day.js') }}"></script>
</html>