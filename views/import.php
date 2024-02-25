<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && $_COOKIE['loaiuser'] >= 98) { ?>
    <!-- Main Content -->
    <div id="content" style="background-color: #e0e0e0;">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">Purchase Invoice (PI)</h1>

            <div class="row">
                <div class="col-4 ">
                    <div class="nhapkho">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách hóa đơn</h6>
                        <div style="margin-top: 20px; max-height: 500px; overflow-y: scroll;">
                            <table class="table table-bordered table-gre">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ngày HĐ</th>
                                        <th scope="col">Số HĐ</th>
                                        <th scope="col">NCC</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th>Đã thanh toán</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_nhapkho">

                                </tbody>
                            </table>
                        </div>
                        <div style="margin-top: 20px;">
                            <div>
                                <input class="input_search" onkeyup='nhapkho_search(this)' placeholder="Tìm kiếm">
                            </div>
                            <div class="filter_date">
                                <select id="loai_filter" onchange="nhapkho_filter()" class="select_seach">
                                    <option value="theoNN">Theo ngày nhập</option>
                                    <option value="theoHD">Theo ngày HĐ</option>
                                </select>
                                <div class="donhang_filter_div" style="display: flex; justify-content: center; align-items: center;">
                                    <div id="datepicker_tungay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                        <input id="tungay" onchange="nhapkho_filter()" class="form-control donhang_tungay" placeholder="Từ ngày" value="<?= date('d/m/Y', strtotime('-30 day', strtotime(date('Y-m-d')))); ?>" type="text"> <span class="input-group-addon"></span>

                                    </div>
                                    <span>Đến</span>
                                    <div id="datepicker_denngay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                        <input id="denngay" onchange="nhapkho_filter()" class="form-control donhang_denngay" placeholder="Đến Ngày" name="denngay" value="<?= date('d/m/Y'); ?>" type="text"> <span class="input-group-addon"></span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-8 ">
                    <div class="nhapkho">
                        <div class="form_chitiethoadon">
                            <div>
                                <h4>Chi tiết hóa đơn</h4>
                            </div>
                            <div style="display: inline-block;">
                                <a id="taophieu__" onclick="sethref_taophieu()">
                                    <button class="btn_taophieu">Tạo phiếu nhập</button>
                                </a>
                                <input hidden class='__soct_nhapkho'>
                                <a onclick="open_capnhatkho(this)" id="capnhat__">
                                    <button class="btn_capnhat">Cập nhật</button>
                                </a>
                                <button onclick="open_form_delete_nhapkho_header(this)" class="btn_xoa">Xóa phiếu</button>
                            </div>
                        </div>
                        <div style="margin-top: 10px;">
                            <table class="table table-bordered table-white ">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên thuốc</th>
                                        <th scope="col">ĐVT</th>
                                        <th scope="col">Số lô</th>
                                        <th scope="col">Hạn dùng</th>
                                        <th scope="col">Giá nhập</th>
                                        <th scope="col">CK</th>
                                        <th scope="col">VAT</th>
                                        <th scope="col">SL</th>
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_nhapkho_line">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form load nhập kho chưa thành công -->
    <div class="modal fade" id="form_nhapkho_chua_thanhcong" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Có hóa đơn chưa nhập?</h4>
                </div>

                <div class="modal-body">
                    <div id="item_nhapkho_chua_thanhcong">

                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="mshh_kichhoat">
                    <input type="hidden" id="trangthai_kichhoat">
                    <div id="btn_dongy"></div>
                    <button type="button" class="btn btn-secondary" style="background-color: orange; border: none ;" data-dismiss="modal">Bỏ qua</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form load nhập kho chưa thành công -->
    <div class="modal fade" id="form_post_thuchi" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Thanh toán NCC</h4>
                </div>

                <div class="modal-body">
                    <div class="row" style="display: flex;">
                        <span class="col-3" style="color: #000;">Số tiền</span>
                        <input class=" col-9 form_input_right_add" onkeyup=" _ChangeFormat(this)" id="sotien_conno">

                    </div>
                    <div class="row" style="margin-top: 20px; display: flex;">
                        <span class="col-3" style="color: #000;">Ngân quỹ</span>
                        <select id="nganquy_post_thuchi" class="col-9 form_input_right_add">
                            <option value="TM">Tiền mặt</option>
                            <option value="NH">Ngân hàng</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soct_thanhtoan">
                    <input type="hidden" id="ten_ncc_thanhtoan">
                    <input type="hidden" id="ms_ncc_thanhtoan">
                    <input type="hidden" id="sohd_thanhtoan">
                    <input type="hidden" id="dathanhtoan_thanhtoan">
                    <button type="button" class="btn btn-secondary" style="background-color: red; border: none ;" onclick="nhapkho_post_thuchi()">Thanh toán</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ;" data-dismiss="modal">Bỏ qua</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form delete nhập kho header -->
    <div class="modal fade" id="form_nhapkho_delete" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Đồng ý xóa đơn hàng?</h4>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="form_soct_delete">
                    <button type="button" onclick="delete_nhapkho_header(this)" class="btn btn-secondary" style="background-color: red; border: none ;" data-dismiss="modal">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ; color: #000;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form xác nhận hủy -->
    <div class="modal fade" id="form_xacnhan" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div id="title" style="padding:10px; justify-content: space-evenly;" class="modal-header">
                    <h4 id="tensp" style="display: flex; align-items: center;"></h4>
                </div>
                <div class="modal-body" style="display:flex;justify-content: center;">

                    <select id="chonkichhoat" style='width: 200px; border: none; border-bottom: 2px solid #000; '>
                        <?php
                        foreach ($List_DMPhanLoai_trangthaihh as $r) {
                            echo '<option value="' . $r->msloai . '">' . $r->tenloai . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="mshh_kichhoat">
                    <input type="hidden" id="trangthai_kichhoat">
                    <div id="btn_dongy"></div>
                    <button type="button" class="btn btn-secondary" onclick="handleEditTrangThai()">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>



    <script>
        function sethref_taophieu() {
            const d = new Date();
            const date =
                d.getDate().toString() +
                (d.getMonth() + 1).toString() +
                d.getFullYear().toString();
            const randomNumber = Math.floor(Math.random() * 10).toString() +
                Math.floor(Math.random() * 10).toString() +
                Math.floor(Math.random() * 10).toString() +
                Math.floor(Math.random() * 10).toString() +
                Math.floor(Math.random() * 10).toString() +
                Math.floor(Math.random() * 10).toString() +
                Math.floor(Math.random() * 10).toString() +
                Math.floor(Math.random() * 10).toString() +
                Math.floor(Math.random() * 10).toString();
            const soct = "ID" + date + randomNumber.toString();
            nhapkho_add_header(soct)
            const taophieu = document.getElementById('taophieu__')
            taophieu.href = 'create-import?' + soct

        }
    </script>
    <script>
        $(document).ready(function() {
            nhapkho_filter()
            get_nhapkho_chua_update()

        })
    </script>
    <script src="vendor/js/import.js?v=<?= md5_file('vendor/js/import.js') ?>"></script>
<?php } ?>