<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && ($_COOKIE['loaiuser'] >= 98 || $_COOKIE['loaiuser'] == 0)) { ?>
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">Order Management System (OMS)</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-2">
                <div class="row">
                    <!-- Danh sách đơn hàng -->
                    <div class="col-4">
                        <div class="card-header py-3 card_header_donhang">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách đặt hàng</h6>
                            <button onclick="location.reload()" class="btn btn-primary">Lấy đặt hàng
                            </button>
                        </div>
                        <div id="form_filter">
                            <div class="donhang_filter_div" style="display: flex; justify-content: center; align-items: center;">
                                <input id="tendonhang_search" onkeyup="oms_timkiem()" class="Input_Style" type="text" placeholder="Tên, SĐT" autocomplete="FALSE">
                                <div id="datepicker_tungay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <input id="tungay" onchange="oms_header()" class="form-control donhang_tungay" placeholder="Từ ngày" value="<?= date('d/m/Y', strtotime('-30 day', strtotime(date('Y-m-d')))); ?>" type="text"> <span class="input-group-addon"></span>

                                </div>
                                <div id="datepicker_denngay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <input id="denngay" onchange="oms_header()" class="form-control donhang_denngay" placeholder="Đến Ngày" name="denngay" value="<?= date('d/m/Y'); ?>" type="text"> <span class="input-group-addon"></span>
                                </div>
                                <div>
                                    <select id="trangthai_loc" onchange="oms_header(this)" class="form-control">
                                        <option value="99">Tất cả</option>
                                        <option selected value="0">Chưa xác nhận</option>
                                        <option value="1">Đã xác nhận</option>
                                        <option value="2">Đang giao</option>
                                        <option value="3">Xuất kho</option>
                                        <option value="4">Đã nhận</option>
                                        <option value="5">Đã hủy</option>
                                    </select>
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
                                            <th>Điện thoại</th>
                                            <th>Tổng tiền</th>
                                            <th><img src="vendor/img/pay16.png"></th>
                                            <th>...</th>
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
                            <h6 class="m-0 font-weight-bold text-primary">Chi tiết đặt hàng</h6>
                            <input type="hidden" id="soct_td">
                            <input type="hidden" id="trangthai_td">
                            <div style="display: flex; gap:10px">
                                <div class="menu_line" id="menu_line_add">
                                    <!-- Menu chức năng -->
                                </div>
                                <div class="menu_line" id="menu_line_huy"></div>
                            </div>
                        </div>
                        <!-- Thông tin khách hàng -->
                        <div style="display: flex; justify-content: center;">
                            <div class="thongtin_kh">
                                <img src="vendor/img/store.png">
                                <p id="tennhathuoc"></p>
                                <input hidden id="mskh_line" />
                            </div>
                            <div class="thongtin_kh">
                                <img src="vendor/img/user.png">
                                <p id="tenkhachhang"></p>
                            </div>
                            <div class="thongtin_kh">
                                <img src="vendor/img/phone.png">
                                <p id="dienthoai"></p>
                            </div>
                        </div>
                        <div class="thongtin_kh" style="display: flex; justify-content: center; margin-bottom: 5px;">
                            <img src="vendor/img/address.png">
                            <p id="diachi"></p>
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
                                    <tbody class="chitiet_donhang_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Form xác nhận -->
    <div class="modal fade" id="form_xacnhan" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div style="padding:10px" class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Xác nhận đơn hàng?</h5>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soct_xacnhan">
                    <input type="hidden" id="trangthai_xacnhan">
                    <button onclick="oms_xacnhan_duyetdon(this)" id="btn_dongy" class="btn btn-success">Xác nhận</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form xác nhận -->
    <div class="modal fade" id="form_xuatkho" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div style="padding:10px" class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Xác nhận xuất kho?</h5>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soct_xacnhan">
                    <input type="hidden" id="trangthai_xacnhan">
                    <button onclick="oms_xuatkho(this)" id="btn_dongy" class="btn btn-success">Xác nhận</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form kiểm tra chưa đủ điều kiện xác nhận đơn hàng -->
    <div class="modal fade" id="form_kiemtra" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div style="padding:10px" class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Đơn hàng không đủ tồn kho!</h5>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soct_xacnhan">
                    <input type="hidden" id="trangthai_xacnhan">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form Hủy -->
    <div class="modal fade" id="form_huy" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div style="padding:10px" class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Chắc chắn Hủy đặt hàng với lý do?</h5>
                </div>
                <select class="form-control" id="DM_LyDo">
                </select>
                <div class="modal-body">
                    <p style="margin: 0;margin-left: 10px;" id="donhang_delete"></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="donhang_delete">
                    <input type="hidden" id="msdn_delete">
                    <div class="col-12">
                        <p id="error"></p>
                    </div>
                    <div>
                        <button onclick="oms_huy()" id="btn_dongy" class="btn btn-danger">Đồng ý</button>
                        <button data-dismiss="modal" class="btn btn-secondary">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Form cập nhật thông tin nhận hàng -->
    <div class="modal fade" id="form_capnhat_thongtinkh" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div style="padding:10px" class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Vui lòng nhập đầy đủ thông tin</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input type="text" id="tennhathuoc_kh" class="field__input" placeholder="Vui lòng nhập tên nhà thuốc" required>
                                <span class="field__label-wrap">
                                    <span class="field__label">Tên nhà thuốc</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input type="text" id="tendaidien_kh" class="field__input" placeholder="Vui lòng nhập tên người đại diện" required>
                                <span class="field__label-wrap">
                                    <span class="field__label">Người đại diện</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input type="text" id="dienthoai_kh" class="field__input" placeholder="Vui lòng nhập điện thoại" required>
                                <span class="field__label-wrap">
                                    <span class="field__label">Điện thoại</span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soct_kh">
                    <input type="hidden" id="dienthoai_old_kh">
                    <input type="hidden" id="mskh_kh">
                    <input type="hidden" id="trangthai_xacnhan">
                    <button onclick="oms_capnhat_thongtin_khachhang(this)" id="btn_dongy" class="btn btn-success">Xác nhận</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function() {
            oms_header()
            // setInterval(donhang_load(), 1000);
        })
    </script>


    <script src="vendor/js/oms_ims.js?v=<?= md5_file('vendor/js/oms_ims.js') ?>"></script>

    <script>
        socket.on("soluong", function(donhang) {
            oms_header_reload()
        });
    </script>
<?php } ?>