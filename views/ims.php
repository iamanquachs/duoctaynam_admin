<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && ($_COOKIE['loaiuser'] >= 98 || $_COOKIE['loaiuser'] == 0)) { ?>
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">Invoice Management System (IMS)</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-2">
                <div class="row">
                    <!-- Danh sách đơn hàng -->
                    <div class="col-4">
                        <div class="card-header py-3 card_header_donhang">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h6>
                            <div style="display: flex; gap:10px">
                                <a id="taophieu_" onclick="sethref_taophieu()">
                                    <img src="./vendor/img/add24.png">
                                </a>
                                <button onclick="location.reload()" class="btn btn-primary">Lấy đơn hàng
                                </button>
                            </div>
                        </div>
                        <div id="form_filter">
                            <div class="donhang_filter_div" style="display: flex; justify-content: center; align-items: center;">
                                <input id="tendonhang_search" onkeyup="ims_timkiem()" class="Input_Style" type="text" placeholder="Tên, SĐT" autocomplete="FALSE">
                                <div id="datepicker_tungay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <input id="tungay" onchange="ims_header()" class="form-control donhang_tungay" placeholder="Từ ngày" value="<?= date('d/m/Y', strtotime('-30 day', strtotime(date('Y-m-d')))); ?>" type="text"> <span class="input-group-addon"></span>

                                </div>
                                <div id="datepicker_denngay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <input id="denngay" onchange="ims_header()" class="form-control donhang_denngay" placeholder="Đến Ngày" name="denngay" value="<?= date('d/m/Y'); ?>" type="text"> <span class="input-group-addon"></span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body card_body_donhang">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ngày</th>
                                            <th>Khách hàng</th>
                                            <th>Tổng tiền</th>
                                            <th>Đã thanh toán</th>
                                            <th>Nguồn</th>
                                        </tr>
                                    </thead>
                                    <tbody id="donhang_table_header" class="donhang_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Chi tiết đơn hàng -->
                    <div class="col-8">
                        <div class="card-header py-3 card_header_donhang">
                            <h6 class="m-0 font-weight-bold text-primary">Chi tiết đơn hàng</h6>
                            <input type="hidden" id="soct_td">
                            <input type="hidden" id="soct_dathang">
                            <input type="hidden" id="trangthai_td">
                            <input type="hidden" id="tenkhachhang_chitiet">
                            <div class="menu_line">
                                <a id="btn_guihang" style="display: none;" onclick="open_capnhat_donhang(this, 'guihang')" class="btn btn-success ">Gửi hàng</a>
                                <a id="btn_danhan" style="background-color: green; border: none;display: none;" onclick="open_capnhat_donhang(this, 'danhan')" class="btn btn-success ">Đã nhận</a>
                                <a id="btn_capnhat" style="display: none;" onclick="capnhat_xuatkho(this)" class="btn btn-warning ">Cập nhật</a>
                                <button id="btn_xacnhan" style="display: none; background-color: red; border: none" onclick="open_ims_xacnhan(this)" data-xacnhan="0" data-target="#form_xacnhan" data-toggle="modal" class="btn btn-warning ">Hủy duyệt</button>
                            </div>
                        </div>
                        <div class="card-body card_body_donhang">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <tr>
                                            <th>#</th>
                                            <th>NPP</th>
                                            <th>MSHH</th>
                                            <th>Tên hàng hóa</th>
                                            <th>ĐVT</th>
                                            <th>SL</th>
                                            <th>% KM</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody id="chitiet_ims_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Form thu tiền xuất kho -->
    <div class="modal fade" id="form_post_thuchi" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Thu tiền đơn hàng</h4>
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
                    <button type="button" class="btn btn-secondary" style="background-color: red; border: none ;" onclick="xuatkho_post_thuchi()">Thanh toán</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ;" data-dismiss="modal">Bỏ qua</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form xác nhận hủy -->
    <div class="modal fade" id="form_xacnhan" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div id="title" style="padding:10px" class="modal-header">

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soct_xacnhan">
                    <input type="hidden" id="trangthai_xacnhan">
                    <div id="btn_dongy"></div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form load nhập kho chưa thành công -->
    <div class="modal fade" id="form_danhsach_xuatkho_chua_luu" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:orange">Còn 1 phiếu bán chưa thanh toán</h4>
                </div>

                <div class="modal-body">
                    <div id="item_xuatkho_chua_thanhcong">

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
    <!-- Form cập nhật gửi đơn hàng -->
    <div class="modal fade" id="form_capnhat_guihang" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="title_donhang" style="color:#1cc88a"></h4>
                </div>

                <div class="modal-body">
                    <div id="item_xuatkho_chua_thanhcong">
                        <h5 id="title_tennhathuoc_guihang" style="text-align: center; color: #000;"></h5>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soct_guihang">
                    <input type="hidden" id="trangthai_donhang">
                    <button type="button" class="btn btn-secondary" onclick="capnhat_donhang(this)" style="background-color: #1cc88a; border: none ;" data-dismiss="modal">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ;" data-dismiss="modal">Bỏ qua</button>
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
            const soct = "XK" + date + randomNumber.toString();
            xuatkho_add_header(soct, 'XBB')
            const taophieu = document.getElementById('taophieu_')
            taophieu.href = 'create-seller?' + soct

        }
    </script>

    <script>
        $(document).ready(function() {
            ims_header()
            load_xuatkho_chua_luu()
        })
    </script>

    <script src="vendor/js/oms_ims.js?v=<?= md5_file('vendor/js/oms_ims.js') ?>"></script>
    <script src="vendor/js/xuatkho.js?v=<?= md5_file('vendor/js/xuatkho.js') ?>"></script>
<?php } ?>