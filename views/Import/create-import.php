<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && $_COOKIE['loaiuser'] >= 98) { ?>
    <!-- Main Content -->
    <div id="content" style="background-color: #e0e0e0;">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">TẠO PHIẾU NHẬP</h1>

            <div class="row">
                <div class="col-12 ">
                    <div class="nhapkho">
                        <div class="row">
                            <div class="col-5">
                                <p id='ncc_error' style="display: none; color: red;margin-bottom: 0;">Chưa chọn nhà cung cấp</p>
                                <div class="filter_date" style="margin-top: 0;">
                                    <select id="nhacc_add" class="select_add">

                                    </select>
                                    <div data-target="#form_add_ncc" data-toggle="modal">
                                        <img src="./vendor/img/add24.png">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <p id='sohd_error' style="display: none; color: red;margin-bottom: 0;">Chưa nhập số hóa đơn</p>
                                <input id="sohoadon_add" class="form_input_right_add" placeholder="Số hóa đơn">
                            </div>

                            <div class="col-1">
                                <p id='ngayhd_error' style="display: none; color: red;margin-bottom: 0;">Chưa chọn ngày hóa đơn</p>
                                <input id="ngayhd_add" class="form_input_right_add txt_date" data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">
                            </div>
                            <div class="col-2">
                                <div class="row input_right">
                                    <p class="col-5" style="margin: 0;">Tổng cộng</p>
                                    <input id='tongcong_add' class="form_input_right_add  col-6" style="text-align: end;" type="text" value="0">
                                </div>
                            </div>
                            <div class="col-2" style="display:flex; gap:10px;justify-content: end;">
                                <a onclick="huy_nhapkho()" id="huy_nhapkho">
                                    <button class="btn_huy">Hủy</button>
                                </a>
                                <button onclick="nhapkho_update_header()" class="btn_luuphieu">Lưu phiếu</button>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 " style="margin-top:30px">
                    <div class="nhapkho">
                        <div class="form_chitiethoadon " style="padding: 10px; display: flex;">
                            <label for="tenthuoc_add">
                                <p style="margin-bottom: 3px;">Tên thuốc</p>
                                <input hidden id='mshh_add'>
                                <input id="tenthuoc_add" onkeyup="load_hosohanghoa(this)" class="input_add" style="color:#000; width: 500px; text-align: start;" placeholder="Nhập tên thuốc">
                            </label>
                            <label for="dvt_add">
                                <p style="margin-bottom: 3px;">ĐVT</p>
                                <input id="dvt_add" class="input_add" style="color:#000; background-color: #ddd;" value="" readonly>

                            </label>
                            <label for="solo_add">
                                <p style="margin-bottom: 3px;">Số lô</p>
                                <input id="solo_add" class="input_add" style="color:#000" value="">
                            </label>
                            <label for="handung_add">
                                <p style="margin-bottom: 3px;">Hạn dùng</p>
                                <input id="handung_add" class="input_add txt_date" value="" data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">
                            </label>
                            <label for="dongia_add">
                                <p style="margin-bottom: 3px;">Giá nhập</p>
                                <input id="gianhap_add" class="input_add" onkeyup="tinh_gianhapcothue();this.value = this.value.replace(/[^0-9\.\,]/g,'');_ChangeFormat(this)" style="color:#000;width: 100%;" value="0">
                            </label>
                        </div>
                        <div class="form_chitiethoadon " style="padding: 10px;display: flex; align-items: end; gap: 20px;">
                            <label>
                                <div style="display: flex; flex-direction: column;">
                                    <select class="select_chietkhau" onchange="tinh_gianhapcothue()" id="select_chietkhau" style="border: none; outline: none;">
                                        <option value="ptchietkhau" checked>
                                            <p style="margin-bottom: 3px;">Chiết khấu(%)</p>
                                        </option>
                                        <option value="vndchietkhau">
                                            <p style="margin-bottom: 3px;">Chiết khấu(VND)</p>
                                        </option>
                                        <option value="tongchietkhau">
                                            <p style="margin-bottom: 3px;">Chiết khấu tổng</p>
                                        </option>
                                    </select>
                                    <input hidden id='tienchietkhau_add'>
                                    <input id="chietkhau_add" onkeyup="tinh_gianhapcothue();_ChangeFormat(this)" class="input_add" style="color:#000;" value="0">

                                </div>
                            </label>
                            <label for="vat_add">
                                <p style="margin-bottom: 3px;">VAT</p>
                                <input hidden id='gianhapchuathue_add'>
                                <input hidden id='tienthue_add'>
                                <input id="vat_add" onkeyup="tinh_gianhapcothue()" class="input_add" style="color:#000;width: 100px;" value="0">
                            </label>
                            <label for="soluong_add">
                                <p style="margin-bottom: 3px;">Số lượng</p>
                                <input id="soluong_add" onkeyup="tinh_gianhapcothue()" class="input_add" style="color:#000;" value="1">
                            </label>
                            <label for="gianhapcothue_add">
                                <p style="margin-bottom: 3px;">Giá nhập VAT</p>
                                <input id="gianhapcothue_add" class="input_add" style="color:#000; background-color: #ddd;" value="0" readonly>
                            </label>
                            <label for="ptgianban_add">
                                <p style="margin-bottom: 3px;">PT giá bán(%)</p>
                                <input id="ptgianban_add" onkeyup="tinh_ptgiaban()" class="input_add" style="color:red" value="0">
                            </label>
                            <label for="gianban_add">
                                <p style="margin-bottom: 3px;">Giá bán(VNĐ)</p>
                                <input id="gianban_add" class="input_add" style="color:red" value="0">
                            </label>
                            <label style='display: flex; justify-content: end;'>
                                <input id="submit_add" onclick="nhapkho_add_line()" type="submit" class="btn_chon" value="Chọn">
                            </label>
                        </div>
                        <div style="margin-top: 10px;">
                            <table id='load_hosohanghoa' class="table table-bordered table-white ">

                            </table>
                            <table id='danhsach_nhapkho_line' class="table table-bordered table-white ">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên thuốc</th>
                                        <th scope="col">ĐVT</th>
                                        <th scope="col">Số lô</th>
                                        <th scope="col">Hạn dùng</th>
                                        <th scope="col">Giá nhập</th>
                                        <th scope="col">CK</th>
                                        <th scope="col">Tiền CK</th>
                                        <th scope="col">VAT</th>
                                        <th scope="col">Giá nhập VAT</th>
                                        <th scope="col">SL</th>
                                        <th scope="col">Thành tiền</th>
                                        <th scope="col">% Giá bán</th>
                                        <th scope="col">Giá bán</th>
                                        <th scope="col">...</th>
                                        <th scope="col">...</th>
                                    </tr>
                                </thead>
                                <tbody id='chitiet_nhapkho_line'>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Form delete Line -->
    <div class="modal fade" id="form_delete_line" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color:#000">Xóa hàng hóa</h5>
                </div>
                <div class="modal-body" style="display:flex;justify-content: center;">
                    <div id="title">
                        <h5 id="tensp_delete" style="display: flex; align-items: center;"></h5>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soct_delete">
                    <input type="hidden" id="rowid_delete">
                    <button type="button" class="btn btn-secondary" style="background-color: red;border: none;" onclick="nhapkho_delete_line()">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Form nhập kho thành công -->
    <div class="modal fade" id="form_nhapkho_success" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color:green">Nhập kho thành công</h5>
                </div>
                <div class="modal-body" style="display:flex;justify-content: center;">
                    <img style="width: 100px;height: 100px;" src="./vendor/img/check_128.png">
                </div>

            </div>

        </div>
    </div>
    <!-- Form thêm nhà cung cấp-->
    <div class="modal fade" id="form_add_ncc" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:700px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color:red">Thêm mới nhà cung cấp</h5>
                </div>
                <div class="modal-body" style="width: 100%;">
                    <label for="msncc_add" style="width: 100%; margin: 10px 10px;">
                        <p style="margin-bottom: 3px;">Mã đơn vị</p>
                        <input class="form_input_right_add" style="width: 100%;" type="text" id="msncc_add" require>
                    </label>
                    <label for="tenncc_add" style="width: 100%; margin: 10px 10px;">
                        <p style="margin-bottom: 3px;">Tên đơn vị</p>
                        <input class="form_input_right_add" style="width: 100%;" type="text" id="tenncc_add" require>
                    </label>
                    <label for="tenviettat_ncc_add" style="width: 100%; margin: 10px 10px;">
                        <p style="margin-bottom: 3px;">Tên viết tắt</p>
                        <input class="form_input_right_add" style="width: 100%;" type="text" id="tenviettat_ncc_add" require>
                    </label>
                    <label for="dienthoai_ncc_add" style="width: 100%; margin: 10px 10px;">
                        <p style="margin-bottom: 3px;">Điện thoại</p>
                        <input class="form_input_right_add" style="width: 100%;" type="text" id="dienthoai_ncc_add">
                    </label>

                    <label for="diachi_ncc_add" style="width: 100%; margin: 10px 10px;">
                        <p style="margin-bottom: 3px;">Địa chỉ</p>
                        <input class="form_input_right_add" style="width: 100%;" type="text" id="diachi_ncc_add">
                    </label>
                    <div style="max-height: 300px; overflow-y: scroll;">
                        <table class="table table-bordered table-white ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Mã đv</th>
                                    <th scope="col">Tên đv</th>
                                    <th scope="col">Tên viết tắt</th>
                                    <th scope="col">ĐT</th>
                                    <th scope="col">ĐC</th>
                                    <th scope="col">...</th>
                                </tr>
                            </thead>
                            <tbody class="__chitiet_nhacc_line">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="background-color: green;border: none;" onclick="add_nhacungcap()">Đồng ý</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

                </div>

            </div>

        </div>
    </div>
    <!-- Form edit Line -->
    <div class="modal fade" id="form_edit_line" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color:#000">Chỉnh sửa hàng hóa</h5>
                </div>
                <div class="modal-body" style="display:flex;justify-content: start;width: 100%">
                    <input hidden id="soct_edit_line">
                    <input hidden id="mshh_edit_line">
                    <div id="title" style="text-align: start;width: 100%; gap:10px">
                        <label for="tenhh_line_edit" style="width: 45%; margin: 10px 10px;">
                            <p style="margin-bottom: 3px;">Tên thuốc</p>
                            <input class="form_input_right_add" style="width: 100%; background-color: #d1d1d1;" type="text" id="tenhh_line_edit" readonly>
                        </label>
                        <label for="tenhh_line_edit" style="width: 45%; margin: 10px 10px;">
                            <p style="margin-bottom: 3px;">Đơn vị tính</p>
                            <input class="form_input_right_add" style="width: 100%; background-color: #d1d1d1;" type="text" id="dvt_line_edit" readonly>
                        </label>
                        <label for="tenhh_line_edit" style="width: 45%; margin: 10px 10px;">
                            <p style="margin-bottom: 3px;">Số lô</p>
                            <input class="form_input_right_add" style="width: 100%;" type="text" id="solo_line_edit">
                        </label>
                        <label for="tenhh_line_edit" style="width: 45%; margin: 10px 10px;">
                            <p style="margin-bottom: 3px;">Hạn dùng</p>
                            <input id="handung_line_edit" class="form_input_right_add txt_date" style="width: 100%;" value="" data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">
                        </label>
                        <label for="tenhh_line_edit" style="width: 45%; margin: 10px 10px;">
                            <p style="margin-bottom: 3px;">Giá nhập</p>
                            <input class="form_input_right_add" onkeyup="tinh_gianhapcothue_edit();_ChangeFormat(this)" style="width: 100%;" type="text" id="gianhap_line_edit">
                        </label>
                        <label for="tenhh_line_edit" style="width: 45%; margin: 10px 10px;">
                            <p style="margin-bottom: 3px;">Chiết khấu(%)
                            </p>
                            <input class="form_input_right_add" style="width: 100%;" onkeyup="tinh_gianhapcothue_edit()" type="text" id="chietkhau_line_edit">
                        </label>
                        <label for="tenhh_line_edit" style="width: 45%; margin: 10px 10px;">
                            <p style="margin-bottom: 3px;">Tiền chiết khấu</p>
                            <input class="form_input_right_add" style="width: 100%; background-color: #d1d1d1;" type="text" id="tienchietkhau_line_edit" readonly>
                        </label>
                        <label for="tenhh_line_edit" style="width: 45%; margin: 10px 10px;">
                            <p style="margin-bottom: 3px;">VAT</p>
                            <input class="form_input_right_add" onkeyup="tinh_gianhapcothue_edit()" style="width: 100%;" type="text" id="vat_line_edit">
                        </label>
                        <label for="tenhh_line_edit" style="width: 45%; margin: 10px 10px;">
                            <p style="margin-bottom: 3px;">Giá nhập VAT</p>
                            <input class="form_input_right_add" style="width: 100%; background-color: #d1d1d1;" type="text" id="gianhapvat_line_edit" readonly>
                        </label>
                        <label for="tenhh_line_edit" style="width: 45%; margin: 10px 10px;">
                            <p style="margin-bottom: 3px;">Số lượng</p>
                            <input class="form_input_right_add" onkeyup="tinh_gianhapcothue_edit()" style="width: 100%;" type="text" id="soluong_line_edit">
                        </label>
                        <label for="tenhh_line_edit" style="width: 45%; margin: 10px 10px;">
                            <p style="margin-bottom: 3px;">PT giá bán(%)</p>
                            <input class="form_input_right_add" onkeyup="tinh_gianhapcothue_edit()" style="width: 100%;" type="text" id="ptgiaban_line_edit">
                        </label>
                        <label for="tenhh_line_edit" style="width: 45%; margin: 10px 10px;">
                            <p style="margin-bottom: 3px;">Giá bán</p>
                            <input class="form_input_right_add" style="width: 100%;" type="text" id="giaban_line_edit">
                        </label>
                        <label for="tenhh_line_edit" style="width: 45%; margin: 10px 10px;">
                            <p style="margin-bottom: 3px;">Thành tiền</p>
                            <input class="form_input_right_add" style="width: 100%; background-color: #d1d1d1;" type="text" id="thanhtien_line_edit" readonly>
                        </label>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soct_delete">
                    <input type="hidden" id="rowid_delete">
                    <button type="button" class="btn btn-secondary" style="background-color: red;border: none;" onclick="nhapkho_edit_line()">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>



    <script>
        $(document).ready(function() {
            nhapkho_load_line()
            tinh_tongcong()
            nhapkho_load_header_taophieu()
            load_nhacungcap()
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

    <script src="vendor/js/import.js?v=<?= md5_file('vendor/js/import.js') ?>"></script>
<?php } ?>