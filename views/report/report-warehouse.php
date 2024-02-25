<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && $_COOKIE['loaiuser'] >= 98) { ?>
    <!-- Main Content -->
    <div id="content" style="background-color: #e0e0e0;">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; ">Xuất tồn</h1>
                <div style="display: flex; gap: 10px; justify-content: end; margin-bottom: 15px; font-size: 15px;" id="ds_menu_baocao">

                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="nhapkho">
                        <div style="display: flex; justify-content: space-between; align-items: center ;">
                            <input id="valueSearch" style="border:none;border-bottom: 1px solid #ddd; width: 350px;" onkeyup="load_warehouse()" value="" placeholder="Tìm MSHH, Tên HH, Số lô">
                            <div style="display: flex;  border-radius: 5px; background-color: #e4fae9;">
                                <div id="datepicker_tungay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <span style="color:#000">Từ ngày</span>
                                    <input style="background-color: #e4fae9; color: #000; border: none" id="tungay" onchange="load_warehouse()" class="form-control donhang_tungay" placeholder="Từ ngày" value="<?= date('d/m/Y', strtotime('0 day', strtotime(date('Y-m-d')))); ?>" type="text"> <span class="input-group-addon"></span>
                                </div>
                                <div id="datepicker_denngay" class="input-group date datepicker_donhang" data-date-format="dd/mm/yyyy">
                                    <span style="color:#000">Đến ngày</span>
                                    <input style="background-color: #e4fae9; color: #000; border: none;" id="denngay" onchange="load_warehouse()" class="form-control donhang_denngay" placeholder="Đến Ngày" name="denngay" value="<?= date('d/m/Y'); ?>" type="text"> <span class="input-group-addon"></span>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 20px; max-height: 600px; overflow-y: scroll;">
                            <table class="table table-bordered table-gre">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">ĐVT</th>
                                        <th scope="col">Số lô</th>
                                        <th scope="col">Hạn dùng</th>
                                        <th scope="col">Giá nhập</th>
                                        <th scope="col">Tồn đầu</th>
                                        <th scope="col">TT Tồn đầu</th>
                                        <th scope="col">Tổng nhập</th>
                                        <th scope="col">Tổng xuất</th>
                                        <th scope="col">Tồn cuối</th>
                                        <th scope="col">TT Tồn đầu</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_warehouse">

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
            load_warehouse()
            add_menu_baocao('report-warehouse')
            $("#datepicker_tungay, #datepicker_denngay").datepicker({
                autoclose: true,
                todayHighlight: true,
            }).on('changeDate', function() {
                load_warehouse()
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