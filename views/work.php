<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && $_COOKIE['loaiuser'] >= 98) { ?>
    <!-- Main Content -->
    <div id="content" style="background-color: #e0e0e0;">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">Nhật kí công việc</h1>

            <div class="row">
                <div class="col-12 ">
                    <div class="nhapkho">
                        <div style="display: flex; justify-content: space-between; align-items: center ;">
                            <input id="_search" style="border:none;border-bottom: 1px solid #e4fae9; width: 350px;" onkeyup="load_work()" value="" placeholder="Tìm kiếm nội dung hoặc tên khách hàng, SĐT">
                            <input id="_search_ngaykt" style="border:none;border-bottom: 1px solid #e4fae9; width: 200px;" onkeyup="load_work()" value="" placeholder="Số ngày kết thúc">
                            <div>
                                <select id="nhom_loc" onchange="load_work(this)" class="form-control">
                                    <option selected value="">Nhóm</option>

                                </select>
                            </div>
                            <div>
                                <select id="nhanvien_loc" onchange="load_work()(this)" class="form-control">
                                    <option selected value="">Nhân viên</option>

                                </select>
                            </div>
                            <div>
                                <select id="trangthai_loc" onchange="load_work()" class="form-control">
                                    <option selected value="0">Hiện</option>
                                    <option value="1">Ẩn</option>
                                </select>
                            </div>

                            <div>
                                <img data-toggle="modal" onclick="open_form_add()" data-target="#form_add_congviec" src="vendor/img/add24.png" alt="">
                            </div>
                        </div>
                        <div style="margin-top: 20px; max-height: 600px; overflow-y: scroll;">
                            <table class="table table-bordered table-gre">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ngày</th>
                                        <th scope="col">Khách hàng</th>
                                        <th scope="col">Nội dung</th>
                                        <th scope="col">Điện thoại</th>
                                        <th scope="col">Ngày BĐ</th>
                                        <th scope="col">Ngày KT</th>
                                        <th scope="col">Ghi chú</th>
                                        <th scope="col">Nhóm</th>
                                        <th scope="col">Nhân viên</th>
                                        <th scope="col"> <img src="vendor/img/eye.png" title="Hiển thị"></th>
                                        <th scope="col">...</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_congviec">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Form add cong viêc -->
    <div class="modal fade" id="form_add_congviec" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Thêm mới nhật kí công việc</h4>
                </div>
                <div class="modal-body" style="margin-right: 10px;">
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="tenkh_add_err" class="col-4">Tên khách hàng</span>
                        <input id="tenkh_add" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="dienthoai_add_err" class="col-4">Điện thoại</span>
                        <input id="dienthoai_add" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="nd_add_err" class="col-4">Nội dung công việc</span>
                        <textarea id="nd_add" class='col-8 ' name="w3review" rows="4" cols="50"></textarea>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="ngaybd_add_err" class="col-4">Ngày bắt đầu</span>
                        <input id="ngaybd_add" class="col-8 form_input_right_add txt_date" value="" data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">

                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="ngaykt_add_err" class="col-4">Ngày kết thúc</span>
                        <input id="ngaykt_add" class="col-8 form_input_right_add txt_date" value="" data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">

                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="ghichu_add_err" class="col-4">Ghi chú</span>
                        <input id="ghichu_add" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="nhom_add_err" class="col-4">Nhóm</span>
                        <select id="nhom_add" class="col-7 form_input_right_add" type="text">
                            <option value='CPL'>Chưa phân loai</option>
                        </select>
                        <div class="col-1" data-target="#form_them_congviec" data-toggle="modal"><img src="./vendor/img/add.png"></div>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="nhanvien_add_err" class="col-4">Nhân viên</span>
                        <select id="nhanvien_add" class="col-7 form_input_right_add">
                            <option value="CPL">
                                Chưa phân loai</option>
                        </select>
                        <div class="col-1" data-target="#form_them_nhanvien" data-toggle="modal"><img src="./vendor/img/add.png"></div>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="trangthai_add_err" class="col-4">Trạng thái</span>
                        <select id="trangthai_add" class="col-7 form_input_right_add">
                            <option value="0">Hiện</option>
                            <option value="1">Ẩn</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="add_congviec(this)" class="btn btn-secondary" style="background-color: green; border: none ;">Thêm</button>
                    <button type="button" class="btn btn-secondary" style="border: none ;" data-dismiss="modal">Hủy</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form Chinh cong viêc -->
    <div class="modal fade" id="form_edit_congviec" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Chỉnh sửa nhật kí công việc</h4>
                </div>

                <div class="modal-body" style="margin-right: 10px;">
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="tenkh_edit_err" class="col-4">Tên khách hàng</span>
                        <input id="tenkh_edit" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="dienthoai_edit_err" class="col-4">Điện thoại</span>
                        <input id="dienthoai_edit" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="nd_edit_err" class="col-4">Nội dung công việc</span>
                        <textarea id="nd_edit" class='col-8 ' name="w3review" rows="4" cols="50"></textarea>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="ngaybd_edit_err" class="col-4">Ngày bắt đầu</span>
                        <input id="ngaybd_edit" class="col-8 form_input_right_add txt_date" value="" data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">

                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="ngaykt_edit_err" class="col-4">Ngày kết thúc</span>
                        <input id="ngaykt_edit" class="col-8 form_input_right_add txt_date" value="" data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">

                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="ghichu_edit_err" class="col-4">Ghi chú</span>
                        <input id="ghichu_edit" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="nhom_edit_err" class="col-4">Nhóm</span>
                        <select id="nhom_edit" class="col-7 form_input_right_add" type="text">
                            <option value=''>Chọn nhóm</option>
                        </select>
                        <div class="col-1" data-target="#form_them_congviec" data-toggle="modal"><img src="./vendor/img/add.png"></div>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="nhanvien_edit_err" class="col-4">Nhân viên</span>
                        <select id="nhanvien_edit" class="col-7 form_input_right_add">
                            <option value="">Chọn nhân viên</option>
                        </select>
                        <div class="col-1" data-target="#form_them_nhanvien" data-toggle="modal"><img src="./vendor/img/add.png"></div>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="trangthai_edit_err" class="col-4">Trạng thái</span>
                        <select id="trangthai_edit" class="col-7 form_input_right_add">
                            <option value="0">Hiện</option>
                            <option value="1">Ẩn</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="mscongviec_edit">
                    <button type="button" onclick="edit_congviec(this)" class="btn btn-secondary" style="background-color: green; border: none ;">Lưu</button>
                    <button type="button" class="btn btn-secondary" style="border: none ;" data-dismiss="modal">Hủy</button>
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


    <!-- Form thêm nhoms công việc -->
    <div class="modal fade" id="form_them_congviec" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px; margin-top: 100px; box-shadow: 0px 3px 10px 5px #888888;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Thêm Nhóm công việc</h4>
                </div>

                <div class="modal-body" style="text-align: center; margin-right: 10px;">

                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Tên nhóm công việc</span>
                        <input id="tencongviec_add" class="col-8 form_input_right_add" type="text">
                    </div>

                    <div>
                        <table class="table table-bordered table-gre">
                            <thead>
                                <tr>
                                    <th scope="col">Tên công việc</th>
                                    <th scope="col">...</th>
                                </tr>
                            </thead>
                            <tbody class="__chitiet_dscongviec">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="add_nhomcv()" class="btn btn-secondary" style="background-color: red; border: none ;">Thêm</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ; color: #000;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form thêm người nộp -->
    <div class="modal fade" id="form_them_nhanvien" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px; margin-top: 100px; box-shadow: 0px 3px 10px 5px #888888;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Thêm nhân viên</h4>
                </div>

                <div class="modal-body" style="text-align: center; margin-right: 10px;">
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Mã nhân viên</span>
                        <input id="manhanvien_add" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span class="col-4">Tên nhân viên</span>
                        <input id="tennhanvien_add" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div>
                        <table class="table table-bordered table-gre">
                            <thead>
                                <tr>
                                    <th scope="col">Mã nhân viên</th>
                                    <th scope="col">Tên nhân viên</th>
                                    <th scope="col">...</th>
                                </tr>
                            </thead>
                            <tbody class="__chitiet_nhanvien">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="add_nhanvien()" class="btn btn-secondary" style="background-color: red; border: none ;">Thêm</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ; color: #000;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>




    <script>
        $(document).ready(function() {
            load_work()
            load_nhomcv()
            load_nhanvien()
            $("#datepicker_tungay, #datepicker_denngay").datepicker({
                autoclose: true,
                todayHighlight: true,
            }).on('changeDate', function() {
                load_work()
            });
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
    <script src="vendor/js/work.js?v=<?= md5_file('vendor/js/work.js') ?>"></script>
<?php } ?>