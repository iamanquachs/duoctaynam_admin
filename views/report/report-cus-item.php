<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && $_COOKIE['loaiuser'] >= 98) { ?>
    <!-- Main Content -->
    <div id="content" style="background-color: #e0e0e0;">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; ">Khách hàng - Sản phẩm</h1>
                <div style="display: flex; gap: 10px; justify-content: end; margin-bottom: 15px; font-size: 15px;" id="ds_menu_baocao">

                </div>

            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="nhapkho">
                        <div style="display: flex; justify-content: space-between; align-items: center ;">
                            <div style="display: flex; gap:20px">
                                <select name="" id="loaiSearch" onchange="show_search(this)" class="form-control" style="max-width: 150px;">
                                    <option selected value='tenkh'>Tên KH</option>
                                    <option value='sdt'>SĐT</option>
                                    <option value='tenhh'>Tên HH</option>
                                    <option value='mshh'>MSHH</option>
                                </select>
                                <input id="valueSearch" style="border:none;border-bottom: 1px solid #ddd; width: 350px;" onkeyup="load_report_cus_item()" value="" placeholder="Tên KH">
                            </div>
                            <div style="display: flex;  border-radius: 5px; background-color: #e4fae9;">
                                <div id="datepicker_tungay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <span style="color:#000">Từ ngày</span>
                                    <input style="background-color: #e4fae9; color: #000; border: none" id="tungay" onchange="load_report_cus_item()" class="form-control donhang_tungay" placeholder="Từ ngày" value="<?= date('d/m/Y', strtotime('0 day', strtotime(date('Y-m-d')))); ?>" type="text"> <span class="input-group-addon"></span>

                                </div>
                                <div id="datepicker_denngay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <span style="color:#000">Đến ngày</span>
                                    <input style="background-color: #e4fae9; color: #000; border: none;" id="denngay" onchange="load_report_cus_item()" class="form-control donhang_denngay" placeholder="Đến Ngày" name="denngay" value="<?= date('d/m/Y'); ?>" type="text"> <span class="input-group-addon"></span>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 20px; max-height: 600px; overflow-y: scroll;">
                            <table class="table table-bordered table-gre">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Khách hàng</th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">SL</th>
                                        <th scope="col">Thành tiền</th>
                                        <th scope="col">Lợi nhuận</th>
                                        <th scope="col">Tỉnh</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_report_cus_item">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>




    <script>
        $(document).ready(function() {
            add_menu_baocao('report-cus-item')
            $("#datepicker_tungay, #datepicker_denngay").datepicker({
                autoclose: true,
                todayHighlight: true,
            }).on('changeDate', function() {
                load_report_cus_item()
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