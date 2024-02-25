<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && ($_COOKIE['loaiuser'] >= 98 || $_COOKIE['loaiuser'] == 0)) { ?>
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">Promotions</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-2">
                <div class="row">
                    <!-- Danh sách đơn hàng -->
                    <div class="col-3">
                        <div class="card-header py-3 card_header_donhang">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách CTKM</h6>
                            <div>
                                <img data-toggle="modal" data-target="#form_add_ctkm_header" src="vendor/img/add24.png" alt="Thêm mới CTKM" title="Thêm mới CTKM">

                            </div>
                        </div>
                        <div id="form_filter" style="padding: 10px;">
                            <div class="donhang_filter_div" style="display: flex; justify-content: space-between; align-items: center;">
                                <input id="tenctkm_search" onkeyup="load_header()" class="Input_Style" type="text" placeholder="Tên CTKM" autocomplete="FALSE">
                                <select style="margin-left: 5px; width: 100px;" id="tronghan_filter" onchange="load_header()" class="Input_Style">
                                    <option value="0">Trong hạn</option>
                                    <option value="1">Hết hạn</option>
                                </select>
                                <input id="songayhethan_filter" onkeyup="load_header()" class="Input_Style" type="text" placeholder="Số ngày hết hạn" autocomplete="FALSE">

                            </div>
                            <div style="display: flex;">
                                <select style="margin-left: 0px; width: 100px;" id="loai_filter" onchange="load_header()" class="Input_Style">
                                    <option value="">Loại KM</option>
                                    <option value="1">Giảm theo %</option>
                                    <option value="2">Tặng kèm sản phẩm</option>
                                </select>



                                <div id="datepicker_tungay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <input id="tungay" onchange="load_header()" class="form-control ctkm_tungay" placeholder="Từ ngày" value="<?= date('d/m/Y', strtotime('-30 day', strtotime(date('Y-m-d')))); ?>" type="text"> <span class="input-group-addon"></span>

                                </div>
                                <div id="datepicker_denngay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <input id="denngay" onchange="load_header()" class="form-control ctkm_denngay" placeholder="Đến Ngày" name="denngay" value="<?= date('d/m/Y'); ?>" type="text"> <span class="input-group-addon"></span>
                                </div>

                            </div>
                        </div>

                        <div class="card-body card_body_donhang">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên CTKM</th>

                                        </tr>
                                    </thead>
                                    <tbody id="donhang_table_header" class="promotions_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Chi tiết đơn hàng -->
                    <div class="col-9">
                        <div class="card-header py-3 card_header_donhang">
                            <h6 class="m-0 font-weight-bold text-primary">Chi tiết CTKM</h6>
                            <input type="hidden" id="chitiet_msctkm">
                            <input type="hidden" id="chitiet_ten_msctkm">
                            <input type="hidden" id="chitiet_loai_msctkm">

                            <div id="show_add_chitiet_ctkm" style="display: none;">
                                <img data-toggle="modal" data-target="#form_add_chitiet_ctkm" src="vendor/img/add24.png" alt="Thêm mới chi tiết CTKM" title="Thêm mới chi tiết CTKM">
                            </div>
                            <div id="show_add_chitiet_ctkm_theopt" style="display: none;">
                                <img data-toggle="modal" data-target="#form_add_chitiet_ctkm_theopt" src="vendor/img/add24.png" alt="Thêm mới chi tiết CTKM" title="Thêm mới chi tiết CTKM">
                            </div>
                        </div>
                        <div class="card-body card_body_donhang">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <tr>
                                            <th>#</th>
                                            <th>MSHH</th>
                                            <th>Tên hàng hóa</th>
                                            <th>% Giảm</th>
                                            <th>MSHH KM</th>
                                            <th>SL mua</th>
                                            <th>SL KM</th>
                                            <th>Từ ngày</th>
                                            <th>Đến ngày</th>
                                            <th>...</th>
                                            <th>...</th>
                                        </tr>
                                    </thead>
                                    <tbody id="chitiet_ctmk_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Form thêm mới CTKM -->
    <div class="modal fade" id="form_add_ctkm_header" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:green">Thêm mới CTKM</h4>
                </div>

                <div class="modal-body">
                    <div class="row" style="display: flex;">
                        <span class="col-4" style="color: #000;">Tên CTKM</span>
                        <input class=" col-8 form_input_right_add" id="ten_ctkm">

                    </div>
                    <div class="row" style="margin-top: 20px; display: flex;">
                        <span class="col-4" style="color: #000;">Loại khuyến mãi</span>
                        <select id="loai_ctkm" class="col-8 form_input_right_add">
                            <option value="1">Giảm giá theo %</option>
                            <option value="2">Sản phẩm tặng kèm</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="background-color: green; border: none ;" onclick="add_ctkm_header()">Thêm</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form thêm chi tiết CTKM -->
    <div class="modal fade" id="form_add_chitiet_ctkm" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:530px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:green">Thêm mới chi tiết CTKM</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="display: flex; margin-bottom: 15px;">
                        <span class="col-4" style="color: #000; text-align: end;">Tên HH</span>
                        <input hidden id="mshh_chitiet_ctkm_add">
                        <input onfocusout="find_hanghoa_tangkem(this, 'hh')" class=" col-8 form_input_right_add" id="tenhh_ctkm" placeholder="MSHH">

                    </div>
                    <div class="row" style="display: flex; margin-bottom: 15px;">
                        <span class="col-4" style="color: #000; text-align: end;">SL mua</span>
                        <input type='number' class=" col-8 form_input_right_add" id="sl_mua_ctkm">

                    </div>
                    <div class="row" style="display: flex; margin-bottom: 15px;">
                        <span class="col-4" style="color: #000; text-align: end;">Tên HH tặng kèm</span>
                        <input hidden id="mshh_tangkem_chitiet_ctkm_add">
                        <input onfocusout="find_hanghoa_tangkem(this, 'hhtangkem')" class=" col-8 form_input_right_add" id="tenhhtangkem_ctkm" placeholder="MSHH">

                    </div>
                    <div class="row" style="display: flex; margin-bottom: 15px;">
                        <span class="col-4" style="color: #000; text-align: end;">SL tặng kèm</span>
                        <input type='number' class=" col-8 form_input_right_add" id="sl_tangkem_ctkm">

                    </div>
                    <div class="row" style="display: flex; margin-bottom: 15px;">
                        <span class="col-4" style="color: #000; text-align: end;">% tặng kèm</span>
                        <input type='number' class=" col-8 form_input_right_add" id="pt_tangkem_ctkm">

                    </div>
                    <div class="row" style="display: flex; margin-bottom: 15px;">
                        <span class="col-4" style="color: #000; text-align: end;">Từ ngày</span>
                        <input id="tungay_add" class="  col-8 form_input_right_add txt_date" data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">


                    </div>
                    <div class="row" style="display: flex; margin-bottom: 15px;">
                        <span class="col-4" style="color: #000; text-align: end;">Đến ngày</span>
                        <input id="denngay_add" class=" col-8 form_input_right_add txt_date" data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="background-color: green; border: none ;" onclick="add_chitiet_ctkm()">Thêm</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form thêm chi tiết CTKM -->
    <div class="modal fade" id="form_add_chitiet_ctkm_theopt" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:530px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:green">Thêm mới chi tiết CTKM</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="display: flex; margin-bottom: 15px;">
                        <span class="col-4" style="color: #000; text-align: end;">Tên HH</span>
                        <input hidden id="mshh_chitiet_ctkm_add_theopt">
                        <input onfocusout="find_hanghoa_tangkem(this, 'hh_theopt')" class=" col-8 form_input_right_add" id="tenhh_ctkm_theopt">

                    </div>
                    <div class="row" style="display: flex; margin-bottom: 15px;">
                        <span class="col-4" style="color: #000; text-align: end;">% Giảm giá</span>
                        <input type='number' class=" col-8 form_input_right_add" id="pt_tangkem_ctkm_theopt">

                    </div>
                    <div class="row" style="display: flex; margin-bottom: 15px;">
                        <span class="col-4" style="color: #000; text-align: end;">Từ ngày</span>
                        <input id="tungay_add_theopt" class="  col-8 form_input_right_add txt_date" data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">


                    </div>
                    <div class="row" style="display: flex; margin-bottom: 15px;">
                        <span class="col-4" style="color: #000; text-align: end;">Đến ngày</span>
                        <input id="denngay_add_theopt" class=" col-8 form_input_right_add txt_date" data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="background-color: green; border: none ;" onclick="add_chitiet_ctkm_theopt()">Thêm</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form cảnh báo trùng -->
    <div class="modal fade" id="form_trung_ngay" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Hàng hóa đã có trong CTKM</h4>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="msctkm_delete">
                    <input type="hidden" id="rowid_delete">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form xác nhận hủy -->
    <div class="modal fade" id="form_delete_ctkm" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red" id="title_delete_ctkm"></h4>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="msctkm_delete">
                    <input type="hidden" id="rowid_delete">
                    <button type="button" class="btn btn-secondary" style="background-color: red; border: none ;" onclick="delete_CTKM()">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>


    <script>
        $(document).ready(function() {
            load_header()
        })
    </script>
    <script>
        jQuery(document).ready(function($) {
            $('.txt_date').inputmask({
                mask: "1/2/y",
                placeholder: "dd/mm/yyyy",
                leapday: "29/02/",
                separator: "/",
                alias: "dd/mm/yyyy",
            });
        });
    </script>
    <script src="vendor/js/promotions.js?v=<?= md5_file('vendor/js/promotions.js') ?>"></script>
<?php } ?>