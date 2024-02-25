<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && $_COOKIE['loaiuser'] >= 98) { ?>
    <!-- Main Content -->
    <div id="content" style="background-color: #e0e0e0;">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; ">Chi tiết phải thu</h1>
                <div style="display: flex; gap: 10px; justify-content: end; margin-bottom: 15px; font-size: 15px;" id="ds_menu_baocao">

                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="nhapkho">
                        <div style="display: flex; justify-content: space-between; align-items: center ;">
                            <input id="valueSearch" style="border:none;border-bottom: 1px solid #ddd; width: 350px;" onkeyup="load_report_detail_receivable()" value="" placeholder="Tìm Số CT, Số HD, MSKH, Tên KH, Số phiếu thu">
                            <div style="display: flex;  border-radius: 5px; background-color: #e4fae9;">
                                <div id="datepicker_tungay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <span style="color:#000">Từ ngày</span>
                                    <input style="background-color: #e4fae9; color: #000; border: none" id="tungay" onchange="load_report_detail_receivable()" class="form-control donhang_tungay" placeholder="Từ ngày" value="<?= date('d/m/Y', strtotime('0 day', strtotime(date('Y-m-d')))); ?>" type="text"> <span class="input-group-addon"></span>

                                </div>
                                <div id="datepicker_denngay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <span style="color:#000">Đến ngày</span>
                                    <input style="background-color: #e4fae9; color: #000; border: none;" id="denngay" onchange="load_report_detail_receivable()" class="form-control donhang_denngay" placeholder="Đến Ngày" name="denngay" value="<?= date('d/m/Y'); ?>" type="text"> <span class="input-group-addon"></span>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 20px; max-height: 600px; " class="">
                            <table class="table table-bordered table-gre " style="margin: 0; ">
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
                                <tbody class="__chitiet_report_detail_receivable">

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


    <!-- Form thu tiền xuất kho -->
    <div class="modal fade" id="form_post_thuchi" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Thu tiền đơn hàng <span id="ma_soct"></span></h4>
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
                <div class="modal-footer" style="justify-content: space-between;">
                    <input type="hidden" id="soct_thanhtoan">
                    <input type="hidden" id="soctdh_thanhtoan">
                    <input type="hidden" id="ten_ncc_thanhtoan">
                    <input type="hidden" id="ms_ncc_thanhtoan">
                    <input type="hidden" id="sohd_thanhtoan">
                    <input type="hidden" id="dathanhtoan_thanhtoan">
                    <div style="gap:20px; display: flex; align-items: center;">
                        <div>
                            <label for='upload_file_qr' style="color: #000;height: 30px; display: flex;align-items: center;">Tải mã thanh toán</label>
                            <input type="file" hidden accept="image/*" id="upload_file_qr" onchange="upload_qr_thanhtoan(this)">
                        </div>
                        <div style="max-width: 50px; position: relative" id="form_qr_code">

                        </div>
                    </div>
                    <div style="border:1px solid #ddd; height: 50px;"></div>
                    <div>
                        <button type="button" class="btn btn-secondary" style="background-color: red; border: none ;" onclick="xuatkho_post_thuchi()">Thanh toán</button>
                        <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ;" data-dismiss="modal">Đóng</button>
                    </div>
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
        function img_qr(input) {
            $('#img_banner_change')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
        }
        $(document).ready(function() {
            load_tong_phaithu()
            add_menu_baocao('report-detail-receivable')
            $("#datepicker_tungay, #datepicker_denngay").datepicker({
                autoclose: true,
                todayHighlight: true,
            }).on('changeDate', function() {
                load_report_detail_receivable()
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