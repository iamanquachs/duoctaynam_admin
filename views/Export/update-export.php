<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && $_COOKIE['loaiuser'] >= 98) { ?>
    <!-- Main Content -->
    <div id="content" style="background-color: #e0e0e0;">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">SỬA PHIẾU <span style="text-transform: uppercase;" id='title_loai_xuat'></span></h1>

            <div class="row">
                <div class="col-12 ">
                    <div class="nhapkho">
                        <div class="row">
                            <div class="col-3">
                                <div class="filter_date" style="margin-top: 0;">
                                    <select id="loai_xuat" class="select_add" onchange="chon_loaixuat(this)">
                                        <option value="">Chọn loại xuất</option>

                                        <?php foreach ($list_loai_xuat as $r) { ?>
                                            <option value="<?= $r->msloai ?>"><?= $r->tenloai ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div id="xuattra_ncc" class="hidden">
                                    <p id='ncc_error' style="display: none; color: red;margin-bottom: 0;">Chưa chọn nhà cung cấp</p>
                                    <div class="filter_date" style="margin-top: 0;">
                                        <select id="nhacc_add" class="select_add">
                                            <option value="">Chọn nhà cung cấp</option>

                                            <?php foreach ($list_nhacc as $r) { ?>
                                                <option value="<?= $r->msnsx ?>"><?= $r->tennsx ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="row input_right">
                                    <p class="col-5" style="margin: 0;">Tổng cộng</p>
                                    <input id='thanhtoan_add' class="form_input_right_add  col-6" style="text-align: end; color:red" type="text" value="0">
                                </div>
                            </div>
                            <div class="col-4" style="display:flex; gap:10px;justify-content: end;">

                                <button onclick="xuatkho_update_xuat()" class="btn_luuphieu">Lưu phiếu</button>
                            </div>

                        </div>
                    </div>
                </div>
                <style>
                    .hidden {
                        display: none;
                    }
                </style>
                <!-- xuất hết hạn - xuất hư bể -->
                <div class="col-12 " style="margin-top:30px">
                    <div class="nhapkho">
                        <div class="form_chitiethoadon " style="padding: 10px; display: flex;">
                            <label for="tenthuoc_add" id='load_hh_xuattra'>
                                <p style="margin-bottom: 3px;">Tên thuốc</p>
                                <input hidden id='mshh_add'>
                                <input id="tenthuoc_add" onkeyup="load_hosohanghoa_xuat(this)" class="input_add" style="color:#000; width: 500px; text-align: start;" placeholder="Nhập tên thuốc">
                            </label>
                            <label for="dvt_add">
                                <p style="margin-bottom: 3px;">ĐVT</p>
                                <input id="dvt_add" class="input_add" style="color:#000; background-color: #ddd;" value="" readonly>

                            </label>
                            <label for="dvt_add">
                                <p style="margin-bottom: 3px;">Tồn</p>
                                <input id="tonkho_add" class="input_add" style="color:#000; background-color: #ddd;" value="" readonly>

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
                                <input id="gianhap_add" class="input_add" style="color:#000;width: 100%;" value="0">
                            </label>
                            <label for="soluong_add">
                                <p style="margin-bottom: 3px;">Số lượng</p>
                                <input id="soluong_add" class="input_add" style="color:#000;" value="1">
                            </label>

                            <label style='display: flex; justify-content: end;'>
                                <input hidden id="msnpp_add">
                                <input hidden id="ptgiam_add" value="">
                                <input hidden id="msctkm_add" value="">
                                <input hidden id="pttichluy_add">
                                <input hidden id="thuesuat_add">
                                <input id="submit_add" onclick="add_xuatkho_line_export()" type="submit" class="btn_chon" style="height: 40px;" value="Chọn">
                            </label>
                        </div>

                        <div style="margin-top: 10px;">
                            <table id='load_hosohanghoa_xuat' class="table table-bordered table-white ">

                            </table>
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
                                        <th scope="col">Thành tiền</th>
                                        <th scope="col">...</th>
                                    </tr>
                                </thead>
                                <tbody id='chitiet_xuatkho_line'>

                                </tbody>
                            </table>
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
    <!-- Form chưa đủ thông tin  -->
    <div class="modal fade" id="form_chuadu_thongtin" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color:red">Vui lòng chọn nhà cung cấp</h5>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(async function() {
            if (typeof timer !== undefined) {
                clearTimeout(this.timer);
            }
            let myPromise = new Promise(function(resolve) {
                load_nhacc_update()
                setTimeout(resolve, 500);
            });
            await myPromise;
            chon_loaixuat()
            tinh_tonkho()
            load_xuatkho_line()
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