<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && $_COOKIE['loaiuser'] >= 98) { ?>
    <!-- Main Content -->
    <div id="content" style="background-color: #e0e0e0;">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">BÁN HÀNG</h1>

            <div class="row">
                <div class="col-8 ">
                    <div class="nhapkho">
                        <div class="form_chitiethoadon " style="padding: 10px; display: flex; align-items: end;">
                            <label for="tenthuoc_add">
                                <p style="margin-bottom: 3px;">Tên thuốc</p>
                                <input hidden id='mshh_add'>
                                <input id="tenthuoc_add" onkeyup="find_hosohanghoa()" class="input_add" style="color:#000; width: 250px; text-align: start;" placeholder="Nhập tên thuốc">
                            </label>
                            <label for="dvt_add">
                                <p style="margin-bottom: 3px;">ĐVT</p>
                                <input id="dvt_add" class="input_add" style="color:#000; background-color: #ddd;" value="" readonly>

                            </label>
                            <label for="solo_add">
                                <p style="margin-bottom: 3px;">Tồn</p>
                                <input id="tonkho_add" class="input_add" style="color:#000; background-color: #ddd;" value="" readonly>
                            </label>
                            <label for="handung_add">
                                <p id="soluong_err" style="margin-bottom: 3px;">Số lượng</p>
                                <input id="soluong_add" onkeyup="find_soluong_hosohanghoa()" class="input_add" style="color:#000" value="1">
                            </label>
                            <label for="dongia_add">
                                <p style="margin-bottom: 3px;">Giá bán</p>
                                <input id="giaban_add" class="input_add" onkeyup="this.value = this.value.replace(/[^0-9\.\,]/g,'');_ChangeFormat(this)" style="color:#000;width: 100%;" value="0">
                            </label>
                            <label style='display: flex; justify-content: end; height: 30px;align-items: center;'>
                                <input hidden id="pttichluy_add">
                                <input hidden id="tenthuoc_add">
                                <input hidden id="dvt_add">
                                <input hidden id="rowid_tonkho_add">
                                <input hidden id="thuesuat_add">
                                <input hidden id="giagoc_add">
                                <input hidden id="ptgiam_add">
                                <input hidden id="msctkm_add">
                                <input hidden id="msnpp_add">
                                <input id="submit_add" onclick="add_xuatkho_line_seller()" type="submit" class="btn_chon" value="Chọn">
                            </label>
                        </div>

                        <div style="margin-top: 10px;">
                            <style>
                                #find_hosohanghoa.hidden {
                                    display: none;
                                }
                            </style>
                            <div id='find_hosohanghoa' class="hidden">
                                <table class="table table-bordered table-white ">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="color:green">#</th>
                                            <th scope="col" style="color:green">Tên thuốc</th>
                                            <th scope="col" style="color:green">Tên hoạt chất</th>
                                            <th scope="col" style="color:green">ĐVT</th>
                                        </tr>
                                    </thead>
                                    <tbody class='chitiet_hanghoa'>

                                    </tbody>
                                </table>
                            </div>

                            <table id='danhsach_nhapkho_line' class="table table-bordered table-white ">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên thuốc</th>
                                        <th scope="col">ĐVT</th>
                                        <th scope="col">Số lô</th>
                                        <th scope="col">Hạn dùng</th>
                                        <th scope="col">% KM</th>
                                        <th scope="col">Giá bán</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Thanh toán</th>
                                        <th scope="col">...</th>
                                    </tr>
                                </thead>
                                <tbody id='chitiet_xuatkho_line'>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-4 ">
                    <div class="nhapkho">
                        <div class="row">
                            <div class="col-12" style="display:flex; gap:10px;justify-content: end;">
                                <a onclick="open_huy_xuatkho()" id="huy_nhapkho">
                                    <button class="btn_huy">Hủy</button>
                                </a>
                                <button onclick="xuatkho_update()" class="btn_luuphieu">Xuất kho</button>
                            </div>
                            <div class="col-12 row" style="align-items: flex-end; margin-bottom: 20px; margin-top: 20px;">
                                <span id='kh_error' class="col-4">NVBH</span>
                                <select id="hoten_nhanvien_add" class="col-8 form_input_right_add" placeholder="SĐT, tên nhân viên">
                                </select>
                            </div>
                            <div class="col-12 row" style="align-items: flex-end; margin-bottom: 20px;">
                                <span id='kh_error' class="col-4">Khách hàng</span>
                                <input hidden id='mskh_add'>
                                <input id="hoten_khachang_add" onchange="load_khachhang()" class="col-8 form_input_right_add" placeholder="Nhập SĐT, tên">
                            </div>
                            <div class="col-12 row" style="align-items: flex-end; margin-bottom: 20px;">
                                <span id='dt_error' class="col-4">Điện thoại</span>
                                <input id="sodienthoai_add" class="col-8 form_input_right_add" placeholder="">
                            </div>
                            <div class="col-12 row" style="align-items: flex-end; margin-bottom: 20px;">
                                <span id='dc_error' class="col-4">Địa chỉ</span>
                                <input id="diachi_add" class="col-8 form_input_right_add" placeholder="">
                            </div>
                            <div class="col-12 row" style="align-items: flex-end; margin-bottom: 20px;">
                                <span id='tt_error' class="col-4" style="color:#000">Thành tiền</span>
                                <input id="thanhtien_add" class="col-8 form_input_right_add" placeholder="" readonly style="text-align: right;">
                            </div>
                            <div class="col-12 row" style="align-items: flex-end; margin-bottom: 20px;">
                                <span id='km_error' class="col-4" style="color:green">Khuyến mãi</span>
                                <input id="khuyemai_add" class="col-8 form_input_right_add" placeholder="" readonly style="text-align: right;">
                            </div>
                            <div class="col-12 row" style="align-items: flex-end; margin-bottom: 20px;">
                                <span id='thanhtoan_error' class="col-4" style="color:red">Thanh toán</span>
                                <input id="thanhtoan_add" class="col-8 form_input_right_add" placeholder="" readonly style="text-align: right;color: red;">
                            </div>
                            <div class="col-12 row" style="align-items: flex-end; margin-bottom: 20px;">
                                <span id='gc_error' class="col-4">Ghi chú</span>
                                <input id="ghichu_add" class="col-8 form_input_right_add" placeholder="">
                            </div>



                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Form thông báo không đủ tồn kho -->
    <div class="modal fade" id="form_thongbao_tonkho" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color:red">Tồn kho không đủ xuất</h5>
                </div>
                <div class="modal-body" style="display:flex;justify-content: center;">
                    <div id="title">
                        <h5 id="tensp_warning" style="display: flex; align-items: center; color:red"></h5>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form hủy xuất kho-->
    <div class="modal fade" id="form_huy_xuatkho" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color:red">Hủy xuất kho</h5>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="background-color: red;border: none;" onclick="huy_xuatkho()">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form delete Line -->
    <div class="modal fade" id="form_delete_line" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color:red">Đồng ý xóa</h5>
                </div>
                <div class="modal-body" style="display:flex;justify-content: center;">
                    <div id="title">
                        <h5 id="tensp_delete" style="display: flex; align-items: center;color:#000"></h5>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="rowid_delete">
                    <input type="hidden" id="mshh_delete">
                    <input type="hidden" id="msctkm_delete">
                    <button type="button" class="btn btn-secondary" style="background-color: red;border: none;" onclick="delete_xuatkho_line()">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form chưa đủ thông tin  -->
    <div class="modal fade" id="form_chuadu_thongtin" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color:red">Vui lòng kiểm tra khách hàng hoặc nhân viên</h5>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form xuất kho thành công -->
    <div class="modal fade" id="form_xuatkho_success" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color:green">Xuất kho thành công</h5>
                </div>
                <div class="modal-body" style="display:flex;justify-content: center;">
                    <img style="width: 100px;height: 100px;" src="./vendor/img/check_128.png">
                </div>

            </div>

        </div>
    </div>




    <script>
        $(document).ready(function() {
            load_xuatkho_line()
            load_nhanvien()
            tinh_tonkho()
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

    <script src="vendor/js/xuatkho.js?v=<?= md5_file('vendor/js/xuatkho.js') ?>"></script>
<?php } ?>