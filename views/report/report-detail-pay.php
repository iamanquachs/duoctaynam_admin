<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && $_COOKIE['loaiuser'] >= 98) { ?>
    <!-- Main Content -->
    <div id="content" style="background-color: #e0e0e0;">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; ">Chi tiết phải trả</h1>
                <div style="display: flex; gap: 10px; justify-content: end; margin-bottom: 15px; font-size: 15px;" id="ds_menu_baocao">

                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="nhapkho">
                        <div style="display: flex; justify-content: space-between; align-items: center ;">
                            <input id="valueSearch" style="border:none;border-bottom: 1px solid #ddd; width: 350px;" onkeyup="load_report_detail_pay()" value="" placeholder="Tìm Số CT, Số HD, MSNCC, Tên NCC, Số phiếu chi">
                            <div style="display: flex;  border-radius: 5px; background-color: #e4fae9;">
                                <div id="datepicker_tungay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <span style="color:#000">Từ ngày</span>
                                    <input style="background-color: #e4fae9; color: #000; border: none" id="tungay" onchange="load_report_detail_pay()" class="form-control donhang_tungay" placeholder="Từ ngày" value="<?= date('d/m/Y', strtotime('0 day', strtotime(date('Y-m-d')))); ?>" type="text"> <span class="input-group-addon"></span>

                                </div>
                                <div id="datepicker_denngay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <span style="color:#000">Đến ngày</span>
                                    <input style="background-color: #e4fae9; color: #000; border: none;" id="denngay" onchange="load_report_detail_pay()" class="form-control donhang_denngay" placeholder="Đến Ngày" name="denngay" value="<?= date('d/m/Y'); ?>" type="text"> <span class="input-group-addon"></span>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 20px; max-height: 600px; overflow-y: scroll;">
                            <table class="table table-bordered table-gre">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ngày</th>
                                        <th scope="col">Số CT</th>
                                        <th scope="col">Số HD</th>
                                        <th scope="col">Phát sinh</th>
                                        <th scope="col">Đã thanh toán</th>
                                        <th scope="col">Số phiếu thu</th>
                                        <th scope="col">Còn nợ</th>
                                        <th scope="col">Cuối kỳ</th>
                                        <th scope="col">Tuổi nợ</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_report_detail_pay">

                                </tbody>
                            </table>
                            <div style="display: flex; justify-content: end">
                                <div style="display: flex; gap: 10px; justify-content: end;align-items: center; margin-top: 15px;  font-size: 15px;">
                                    <div class="ds_tong">Đầu kỳ: <span id="tongdauky"></span></div>
                                    <div class="ds_tong">Phát sinh: <span id="tongcongvat"></span></div>
                                    <div class="ds_tong">Thanh toán: <span id="tongdathanhtoan"></span></div>
                                    <div class="ds_tong">Cuối kỳ: <span id="tongno"></span></div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Form load nhập kho chưa thành công -->
    <div class="modal fade" id="form_post_thuchi" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color:red">Thanh toán nhà cung cấp <span id='soct_phieu'></span></h5>
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
    <!-- Form chi tiết phiếu thu -->
    <div class="modal fade" id="form_chitiet_phieuthu" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:400px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:green">Thông tin thanh toán <span id="ma_soct_chitiet_phieuthu"></span></h4>
                </div>

                <div class="modal-body body_thongtin_phieuthu" id=''>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="soct_thanhtoan">
                    <input type="hidden" id="ten_ncc_thanhtoan">
                    <input type="hidden" id="ms_ncc_thanhtoan">
                    <input type="hidden" id="sohd_thanhtoan">
                    <input type="hidden" id="dathanhtoan_thanhtoan">
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ; color: #000;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            load_tong_phaitra()

            add_menu_baocao('report-warehouse')
            $("#datepicker_tungay, #datepicker_denngay").datepicker({
                autoclose: true,
                todayHighlight: true,
            }).on('changeDate', function() {
                load_report_detail_pay()
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
    <script src="vendor/js/report.js?v=<?= md5_file('vendor/js/report.js') ?>"></script>
<?php } ?>