<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && ($_COOKIE['loaiuser'] >= 98 || $_COOKIE['loaiuser'] == 1)) { ?>
    <!-- Main Content -->
    <div id="content" style="background-color: #e0e0e0;">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">Accounting</h1>

            <div class="row">
                <div class="col-12 ">
                    <div class="nhapkho">
                        <div style="display: flex; justify-content: space-between;">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách thu chi</h6>
                            <input id="_search" style="border:none;border-bottom: 1px solid #e4fae9; width: 300px;" onkeyup="load_thuchi()" value="" placeholder="Tìm kiếm nội dung hoặc tên khách hàng">
                            <div style="display: flex;  border-radius: 5px; background-color: #e4fae9;">
                                <div id="datepicker_tungay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <span style="color:#000">Từ ngày</span>
                                    <input style="background-color: #e4fae9; color: #000; border: none" id="tungay" onchange="load_thuchi()" class="form-control donhang_tungay" placeholder="Từ ngày" value="<?= date('d/m/Y', strtotime('-30 day', strtotime(date('Y-m-d')))); ?>" type="text"> <span class="input-group-addon"></span>

                                </div>
                                <div id="datepicker_denngay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <span style="color:#000">Đến ngày</span>
                                    <input style="background-color: #e4fae9; color: #000; border: none;" id="denngay" onchange="load_thuchi()" class="form-control donhang_denngay" placeholder="Đến Ngày" name="denngay" value="<?= date('d/m/Y'); ?>" type="text"> <span class="input-group-addon"></span>
                                </div>
                            </div>
                            <div>
                                <select id="trangthai_loc" onchange="load_thuchi(this), load_chitietkhoanmuc(this)" class="form-control">
                                    <option selected value="">Tất cả thu chi</option>
                                    <option value="1">Chi</option>
                                    <option value="0">Thu</option>
                                </select>
                            </div>
                            <div>
                                <select id="khoanmuc_loc" onchange="load_thuchi(this)" class="form-control">
                                </select>
                            </div>
                            <div>
                                <button type="button" onclick="open_add_thu()" class="btn btn-success" style="background-color: green; border: none ; padding: 5px 10px;" data-target="#form_add_thu" data-toggle="modal">Tạo phiếu thu</button>
                                <button type="button" onclick="open_add_chi()" class="btn btn-success" style="background-color: orange; border: none ; padding: 5px 10px;" data-target="#form_add_chi" data-toggle="modal">Tạo phiếu chi</button>
                            </div>
                        </div>
                        <div style="margin-top: 20px; max-height: 600px; overflow-y: scroll;">
                            <table class="table table-bordered table-gre">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Cập nhật lần cuối</th>
                                        <th scope="col">Ngày</th>
                                        <th scope="col">Nội dung</th>
                                        <th scope="col">Số tiền</th>
                                        <th scope="col">Tên khách hàng</th>
                                        <th scope="col">Khoản</th>
                                        <th scope="col">Người thu</th>
                                        <th scope="col">Người (Nộp/Nhận)</th>
                                        <th scope="col">...</th>
                                        <th scope="col">...</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_thuchi">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Form thu -->
    <div class="modal fade" id="form_add_thu" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Thêm mới phiếu thu</h4>
                </div>

                <div class="modal-body" style="margin-right: 10px;">
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="ngaythu_err" class="col-4">Ngày</span>
                        <input id="ngaythu_add" class="col-8 form_input_right_add txt_date" value='<?= date('d/m/Y'); ?>' data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="khoanmucthu_err" class="col-4">Khoản mục</span>
                        <select id="khoangmucthu_add" class="col-7 form_input_right_add" type="text">
                            <option value=''>Chọn khoản mục</option>
                        </select>
                        <div class="col-1" data-target="#form_them_khoanmuc" onclick="open_add_khoanmuc()" data-toggle="modal"><img src="./vendor/img/add.png"></div>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="sotienthu_err" class="col-4">Số tiền</span>
                        <input id="sotienthu_add" onkeyup="_ChangeFormat(this)" class="col-8 form_input_right_add" type="text" placeholder="0">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="noidungthu_err" class="col-4">Nội dung</span>
                        <input id="noidungthu_add" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="nguoinop_err" class="col-4">Người nộp</span>
                        <select id="nguoinop_add" class="col-7 form_input_right_add">
                            <option value="">Chọn người nộp</option>
                        </select>
                        <div class="col-1" data-target="#form_them_nguoinop" data-toggle="modal"><img src="./vendor/img/add.png"></div>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="nganquythu_err" class="col-4">Ngân quỹ</span>
                        <select id="nganquythu_add" class="col-8 form_input_right_add">
                            <option value="TM">Tiền mặt</option>
                            <option value="NH">Ngân hàng</option>
                        </select>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="add_thu(this)" class="btn btn-secondary" style="background-color: green; border: none ;">Thêm</button>
                    <button type="button" class="btn btn-secondary" style="border: none ;" data-dismiss="modal">Hủy</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form chi -->
    <div class="modal fade" id="form_add_chi" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Thêm mới phiếu chi</h4>
                </div>

                <div class="modal-body" style="margin-right: 10px;">
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="ngaychi_err" class="col-4">Ngày</span>
                        <input id="ngaychi_add" class="col-8 form_input_right_add txt_date" data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" value='<?= date('d/m/Y'); ?>' data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="khoanmucchi_err" class="col-4">Khoản mục</span>
                        <select id="khoangmucchi_add" class="col-7 form_input_right_add" type="text">
                            <option value=''>Chọn khoản mục</option>
                        </select>
                        <div class="col-1" data-target="#form_them_khoanmuc" onclick="open_add_khoanmuc()" data-toggle="modal"><img src="./vendor/img/add.png"></div>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="sotienchi_err" class="col-4">Số tiền</span>
                        <input id="sotienchi_add" onkeyup="_ChangeFormat(this)" class="col-8 form_input_right_add" type="text" placeholder="0">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="noidungchi_err" class="col-4">Nội dung</span>
                        <input id="noidungchi_add" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id='nguoinhan_err' class="col-4">Người nhận</span>
                        <select id="nguoinhan_add" class="col-7 form_input_right_add">
                            <option value="">Chọn người nhận</option>
                        </select>
                        <div class="col-1" data-target="#form_them_nguoinop" data-toggle="modal"><img src="./vendor/img/add.png"></div>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Ngân quỹ</span>
                        <select id="nganquychi_add" class="col-8 form_input_right_add">
                            <option value="TM">Tiền mặt</option>
                            <option value="NH">Ngân hàng</option>
                        </select>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="add_chi(this)" class="btn btn-secondary" style="background-color: green; border: none ;">Thêm</button>
                    <button type="button" class="btn btn-secondary" style="border: none ;" data-dismiss="modal">Hủy</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form Edit chi -->
    <div class="modal fade" id="form_edit_chi" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:orangered">Chỉnh sửa chi</h4>
                </div>

                <div class="modal-body" style="text-align: center;  margin-right: 10px;">
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Ngày</span>
                        <input id="ngaychi_edit" class="col-8 form_input_right_add txt_date" data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Khoản mục</span>
                        <select id="khoanmucchi_edit" class=" col-7 form_input_right_add" type="text">
                            <option value=''>Chọn khoản mục</option>
                        </select>
                        <div class="col-1" data-target="#form_them_khoanmuc" onclick="open_add_khoanmuc()" data-toggle="modal"><img src="./vendor/img/add.png"></div>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Số tiền</span>
                        <input id="sotienchi_edit" onkeyup="_ChangeFormat(this)" class="col-8 form_input_right_add" type="text" placeholder="0">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Nội dung</span>
                        <input id="noidungchi_edit" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Người nhận</span>
                        <select id="nguoinopchi_edit" class="col-7 form_input_right_add">
                            <option value="">Chọn người nhận</option>
                        </select>
                        <div class="col-1" data-target="#form_them_nguoinop" data-toggle="modal"><img src="./vendor/img/add.png"></div>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Ngân quỹ</span>
                        <select id="nganquychi_edit" class="col-8 form_input_right_add">
                            <option value="TM">Tiền mặt</option>
                            <option value="NH">Ngân hàng</option>
                        </select>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soctchi_edit">
                    <button type="button" onclick="edit_chi(this)" class="btn btn-secondary" style="background-color: orangered; border: none ;" data-dismiss="modal">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ; color: #000;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form Edit thu -->
    <div class="modal fade" id="form_edit_thu" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:orangered">Chỉnh sửa thu</h4>
                </div>

                <div class="modal-body" style="text-align: center;  margin-right: 10px;">
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Ngày</span>
                        <input id="ngay_edit" class="col-8 form_input_right_add txt_date" data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Khoản mục</span>
                        <select id="khoanmuc_edit" class=" col-7 form_input_right_add" type="text">
                            <option value=''>Chọn khoản mục</option>
                        </select>
                        <div class="col-1" data-target="#form_them_khoanmuc" onclick="open_add_khoanmuc()" data-toggle="modal"><img src="./vendor/img/add.png"></div>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Số tiền</span>
                        <input id="sotien_edit" onkeyup="_ChangeFormat(this)" class="col-8 form_input_right_add" type="text" placeholder="0">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Nội dung</span>
                        <input id="noidung_edit" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Người nộp</span>
                        <select id="nguoinop_edit" class="col-7 form_input_right_add">
                            <option value="">Chọn người nộp</option>
                        </select>
                        <div class="col-1" data-target="#form_them_nguoinop" data-toggle="modal"><img src="./vendor/img/add.png"></div>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Ngân quỹ</span>
                        <select id="nganquy_edit" class="col-8 form_input_right_add">
                            <option value="TM">Tiền mặt</option>
                            <option value="NH">Ngân hàng</option>
                        </select>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soct_edit">
                    <button type="button" onclick="edit_thu(this)" class="btn btn-secondary" style="background-color: orangered; border: none ;" data-dismiss="modal">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ; color: #000;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form delete nhập kho header -->
    <div class="modal fade" id="form_delete_thuchi" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Đồng ý xóa</h4>
                </div>

                <div class="modal-body" style="text-align: center; margin-right: 10px;">
                    <h4 id="title_xoathuchi"></h4>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soct_delete">
                    <input type="hidden" id="loaithuchi_delete">
                    <input type="hidden" id="sotienthuchi_delete">
                    <input type="hidden" id="soct_dh_thuchi_delete">
                    <button type="button" onclick="delete_thuchi(this)" class="btn btn-secondary" style="background-color: red; border: none ;" data-dismiss="modal">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ; color: #000;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form thong bao khong the xoa thu-->
    <div class="modal fade" id="form_thongbaothu" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Không thể chỉnh</h4>
                </div>

                <div class="modal-body" style="text-align: center; margin-right: 10px;">
                    <h5 style="color:red">Vui lòng xóa rồi thu lại</h5>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soct_delete">
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ; color: #000;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form thong bao khong the xoa chi-->
    <div class="modal fade" id="form_thongbaochi" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Không thể chỉnh</h4>
                </div>

                <div class="modal-body" style="text-align: center; margin-right: 10px;">
                    <h5 style="color:red">Vui lòng xóa rồi chi lại</h5>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soct_delete">
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ; color: #000;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form thêm khoản mục -->
    <div class="modal fade" id="form_them_khoanmuc" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px; margin-top: 100px; box-shadow: 0px 3px 10px 5px #888888;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Thêm khoản mục</h4>
                </div>

                <div class="modal-body" style="text-align: center; margin-right: 10px;">

                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Tên khoản mục</span>
                        <input id="tenkhoanmuc_add" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Loại khoản mục</span>
                        <select id="loai_khoanmuc_add" class="col-7 form_input_right_add">
                            <option value="">Chọn khoản mục</option>
                            <option value="CHI">Chi</option>
                            <option value="THU">Thu</option>
                        </select>
                    </div>
                    <div>
                        <table class="table table-bordered table-gre">
                            <thead>
                                <tr>
                                    <th scope="col">Tên khoản mục</th>
                                    <th scope="col">Loại</th>
                                    <th scope="col">...</th>
                                </tr>
                            </thead>
                            <tbody class="__chitiet_khoanmuc">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soct_delete">
                    <button type="button" onclick="add_khoanmuc()" class="btn btn-secondary" style="background-color: red; border: none ;">Thêm</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ; color: #000;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>


    <!-- Form thêm người nộp -->
    <div class="modal fade" id="form_them_nguoinop" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px; margin-top: 100px; box-shadow: 0px 3px 10px 5px #888888;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Thêm người nộp</h4>
                </div>

                <div class="modal-body" style="text-align: center; margin-right: 10px;">
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Mã người nộp</span>
                        <input id="manguoinop_add" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Tên người nộp</span>
                        <input id="tennguoinop_add" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div>
                        <table class="table table-bordered table-gre">
                            <thead>
                                <tr>
                                    <th scope="col">Mã người nộp</th>
                                    <th scope="col">Tên người nộp</th>
                                    <th scope="col">...</th>
                                </tr>
                            </thead>
                            <tbody class="__chitiet_nguoinop">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="add_nguoinop()" class="btn btn-secondary" style="background-color: red; border: none ;">Thêm</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ; color: #000;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>




    <script>
        $(document).ready(function() {
            load_nhanvien()
            $("#datepicker_tungay, #datepicker_denngay").datepicker({
                autoclose: true,
                todayHighlight: true,
            }).on('changeDate', function() {
                load_thuchi()
            });
            load_khoanmuc()
            load_khoanmuc_filter()
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
    <script src="vendor/js/thuchi.js?v=<?= md5_file('vendor/js/thuchi.js') ?>"></script>
<?php } ?>