<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && ($_COOKIE['loaiuser'] >= 98 || $_COOKIE['loaiuser'] == 1)) { ?>
    <!-- Main Content -->
    <div id="content" style="background-color: #e0e0e0;">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">Voucher</h1>

            <div class="row">
                <div class="col-12 ">
                    <div class="nhapkho">
                        <div style="display: flex; justify-content: space-between;">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách Voucher</h6>
                            <input id="_search" style="border:none;border-bottom: 1px solid #e4fae9; width: 300px;" onkeyup="load_voucher()" value="" placeholder="Tìm kiếm tên Voucher">
                            <div style="display: flex;  border-radius: 5px; background-color: #e4fae9;">
                                <div id="datepicker_tungay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <span style="color:#000">Từ ngày</span>
                                    <input style="background-color: #e4fae9; color: #000; border: none" id="tungay" onchange="load_voucher()" class="form-control donhang_tungay" placeholder="Từ ngày" value="<?= date('d/m/Y', strtotime('-30 day', strtotime(date('Y-m-d')))); ?>" type="text"> <span class="input-group-addon"></span>

                                </div>
                                <div id="datepicker_denngay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <span style="color:#000">Đến ngày</span>
                                    <input style="background-color: #e4fae9; color: #000; border: none;" id="denngay" onchange="load_voucher()" class="form-control donhang_denngay" placeholder="Đến Ngày" name="denngay" value="<?= date('d/m/Y'); ?>" type="text"> <span class="input-group-addon"></span>
                                </div>
                            </div>
                            <div>
                                <select id="loaivoucher_loc" onchange="load_voucher(this)" class="form-control">
                                    <option selected value="">Tất cả Voucher</option>
                                    <option value="FS">Free ship</option>
                                    <option value="GG">Giảm giá</option>
                                </select>
                            </div>
                            <div>
                                <select id="trangthai_loc" onchange="load_voucher(this)" class="form-control">
                                    <option selected value="">Tất cả trạng thái</option>
                                    <option value="1">Đã dùng</option>
                                    <option value="0">Chưa dùng</option>
                                </select>
                            </div>
                            <div>
                                <button type="button" class="btn btn-success" style="background-color: orange; border: none ; padding: 5px 10px;" data-target="#form_add_voucher" data-toggle="modal">Tạo Voucher</button>
                            </div>
                        </div>
                        <div style="margin-top: 20px; max-height: 600px; overflow-y: scroll;">
                            <table class="table table-bordered table-gre">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ngày</th>
                                        <th scope="col">Tên Voucher</th>
                                        <th scope="col">MSKH</th>
                                        <th scope="col">Số tiền</th>
                                        <th scope="col">Loại</th>
                                        <th scope="col">Thời hạn</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">...</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_voucher">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Form Add voucher -->
    <div class="modal fade" id="form_add_voucher" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Thêm mới voucher</h4>
                </div>

                <div class="modal-body" style="margin-right: 10px;">

                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="loaikh_err" class="col-4">Loại khách hàng</span>
                        <select id="loaikh_add" onchange="change_loaikh(this)" class="col-7 form_input_right_add" type="text">
                            <option value='0'>Tất cả</option>
                            <option value='1'>Theo khách hàng</option>
                        </select>
                    </div>
                    <style>
                        .hidden {
                            display: none;
                        }
                    </style>
                    <div class="row hidden" id="mskh_form" style=" align-items: center;margin-bottom: 20px;">
                        <span id="mskh_err" class="col-4">MSKH</span>
                        <input id="mskh_add" onkeyup="filter_kh()" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div class="row hidden" id="tenkh_form" style=" align-items: center;margin-bottom: 20px">
                        <span id="tenkhachhang_err" class="col-4">Tên khách hàng</span>
                        <input id="tenkhachhang_add" class="col-8 form_input_right_add" type="text" readonly>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="tenvoucher_err" class="col-4">Tên Voucher</span>
                        <input id="tenvoucher_add" class="col-8 form_input_right_add" type="text">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="sotien_err" class="col-4">Số tiền</span>
                        <input id="sotien_add" onkeyup="_ChangeFormat(this)" class="col-8 form_input_right_add" type="text" placeholder="0">
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="loaivoucher_err" class="col-4">Loại Voucher</span>
                        <select id="loaivoucher_add" class="col-7 form_input_right_add" type="text">
                            <option value='FS'>Free ship</option>
                            <option value='GG'>Giảm giá</option>
                        </select>
                    </div>
                    <div class="row" style=" align-items: center;margin-bottom: 20px;">
                        <span id="thoihan_err" class="col-4">Thời hạn</span>
                        <input id="thoihan_add" class="col-8 form_input_right_add txt_date" value='<?= date('d/m/Y'); ?>' data-date-format="dd-mm-yy" type="text" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="add_voucher(this)" class="btn btn-secondary" style="background-color: green; border: none ;">Thêm</button>
                    <button type="button" class="btn btn-secondary" style="border: none ;" data-dismiss="modal">Hủy</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Form delete nhập kho header -->
    <div class="modal fade" id="form_delete_voucher" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Đồng ý xóa</h4>
                </div>

                <div class="modal-body" style="text-align: center; margin-right: 10px;">
                    <h4 id="title_xoavoucher"></h4>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="mavoucher_delete">
                    <button type="button" onclick="delete_voucher(this)" class="btn btn-secondary" style="background-color: red; border: none ;" data-dismiss="modal">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ; color: #000;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#datepicker_tungay, #datepicker_denngay").datepicker({
                autoclose: true,
                todayHighlight: true,
            }).on('changeDate', function() {
                load_voucher()
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
    <script src="vendor/js/voucher.js?v=<?= md5_file('vendor/js/thuchi.js') ?>"></script>
<?php } ?>