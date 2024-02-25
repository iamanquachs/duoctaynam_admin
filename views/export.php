<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && $_COOKIE['loaiuser'] >= 98) { ?>
    <!-- Main Content -->
    <div id="content" style="background-color: #e0e0e0;">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">Exports Invoice (EI)</h1>

            <div class="row">
                <div class="col-4 ">
                    <div class="nhapkho">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách hóa đơn</h6>
                        <div style="margin-top: 20px; max-height: 500px; overflow-y: scroll;">
                            <table class="table table-bordered table-gre">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ngày xuất</th>
                                        <th scope="col">Tên KH</th>
                                        <th scope="col">Loại xuất</th>
                                        <th scope="col">Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_xuatkho">

                                </tbody>
                            </table>
                        </div>
                        <div style="margin-top: 20px;">
                            <div style="display: flex; gap:20px">

                                <select id="loai_xuat" class="select_add" onchange="load_xuatkho_header()" style="width: 50%;">
                                    <option value="">Tất cả loại xuất</option>
                                    <?php foreach ($list_loai_xuat as $r) { ?>
                                        <option value="<?= $r->msloai ?>"><?= $r->tenloai ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="filter_date">
                                <span style="color:#000; display: flex; align-items: flex-end;">Theo ngày</span>
                                <div class="donhang_filter_div" style="display: flex; justify-content: center; align-items: center;">
                                    <div id="datepicker_tungay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                        <input id="tungay" onchange="load_xuatkho_header()" class="form-control donhang_tungay" placeholder="Từ ngày" value="<?= date('d/m/Y', strtotime('-30 day', strtotime(date('Y-m-d')))); ?>" type="text"> <span class="input-group-addon"></span>

                                    </div>
                                    <span>Đến</span>
                                    <div id="datepicker_denngay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                        <input id="denngay" onchange="load_xuatkho_header()" class="form-control donhang_denngay" placeholder="Đến Ngày" name="denngay" value="<?= date('d/m/Y'); ?>" type="text"> <span class="input-group-addon"></span>
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
                                    <button class="btn_taophieu">Tạo phiếu xuất</button>
                                </a>
                                <input hidden class='__soct_xuatkho'>
                                <a onclick="open_capnhat_xuatkho(this)" id="capnhat__">
                                    <button class="btn_capnhat">Cập nhật</button>
                                </a>
                                <button onclick="open_delete_xuatkho_header(this)" class="btn_xoa">Xóa phiếu</button>
                            </div>
                        </div>
                        <div style="margin-top: 10px;">
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



    <!-- Form delete xuất kho header -->
    <div class="modal fade" id="form_xuatkho_delete" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Đồng ý xóa đơn hàng?</h4>
                </div>


                <div class="modal-footer">
                    <input type="hidden" id="soct_delete">
                    <button type="button" onclick="delete_xuatkho_header_export(this)" class="btn btn-secondary" style="background-color: red; border: none ;" data-dismiss="modal">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ; color: #000;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Form load nhập kho chưa thành công -->
    <div class="modal fade" id="form_danhsach_xuatkho_chua_luu" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:orange">Còn 1 phiếu xuất chưa lưu?</h4>
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
            xuatkho_add_header(soct, '')
            const taophieu = document.getElementById('taophieu__')
            taophieu.href = 'create-export?' + soct

        }
    </script>
    <script>
        $(document).ready(function() {
            tinh_tonkho()
            load_xuatkho_header()
            load_xuatkho_chua_luu_export()
        })
    </script>
    <script src="vendor/js/xuatkho.js?v=<?= md5_file('vendor/js/xuatkho.js') ?>"></script>
    <script src="vendor/js/oms_ims.js?v=<?= md5_file('vendor/js/oms_ims.js') ?>"></script>

<?php } ?>