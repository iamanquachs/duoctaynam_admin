<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && ($_COOKIE['loaiuser'] >= 98 || $_COOKIE['loaiuser'] == 1)) { ?>
    <link rel="stylesheet" href="vendor/css/phantich/phantich.css">
    <!-- Main Content -->
    <div id="phantich">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800">Phân tích</h1>

            <div class="row">
                <div class="col-12 ">
                    <div class="phantich_wrap">
                        <div class="header">
                            <select id="msdv_loc" class="form-control">
                                <?php
                                foreach ($list_msdv as $r) { ?>
                                    <option value="<?= $r->msdv ?>"><?= $r->tendv ?></option>
                                <?php }
                                ?>
                            </select>
                            <div id="ngay_div">
                                <div id="datepicker_tungay" class="input-group date datepicker_phantich" data-date-format="dd/mm/yyyy">
                                    <span>Từ ngày</span>
                                    <input id="tungay" onchange="load_thuchi()" class="form-control " placeholder="Từ ngày" value="<?= date('d/m/Y', strtotime('-30 day', strtotime(date('Y-m-d')))); ?>" type="text"> <span class="input-group-addon"></span>

                                </div>
                                <div id="datepicker_denngay" class="input-group date datepicker_phantich" data-date-format="dd/mm/yyyy">
                                    <span>Đến ngày</span>
                                    <input id="denngay" onchange="load_thuchi()" class="form-control" placeholder="Đến Ngày" name="denngay" value="<?= date('d/m/Y'); ?>" type="text">
                                    <span class="input-group-addon"></span>
                                </div>
                            </div>
                            <input id="_search" style="border:none;border-bottom: 1px solid #e4fae9; width: 300px;" onkeyup="load_thuchi()" value="" placeholder="Tìm kiếm nội dung hoặc tên khách hàng">
                            <button type="button" onclick="phantich_xem()" class="btn btn-success">Xem</button>
                        </div>
                        <div class="content">
                            <table class="table table-bordered table-gre">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên DV</th>
                                        <th scope="col">Tên thuốc</th>
                                        <th scope="col">Hoạt chất</th>
                                        <th scope="col">ĐVT</th>
                                        <th scope="col">SL nhập</th>
                                        <th scope="col">Giá nhập</th>
                                        <th scope="col">SL bán</th>
                                        <th scope="col">Giá bán</th>
                                        <th scope="col">NCC</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_thuchi">

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
            $("#datepicker_tungay, #datepicker_denngay").datepicker({
                autoclose: true,
                todayHighlight: true,
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
    <script src="vendor/js/thuchi.js?v=<?= md5_file('vendor/js/thuchi.js') ?>"></script>
<?php } ?>