<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && ($_COOKIE['loaiuser'] >= 98 || $_COOKIE['loaiuser'] == 0) ) { ?>
    <!-- Main Content -->
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">QUẢN LÝ HỢP ĐỒNG</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-2">
                <div class="row">
                    <div class="col-sm-12 col-12">
                        <div class="card-header py-3 card_header_khachhang">
                            <div>
                                <h6 class="m-0 font-weight-bold text-primary">Thông tin hợp đồng</h6>
                            </div>
                        </div>
                        <div class="khachhang_filter_div" style="display: flex; justify-content: center; align-items: center;">
                            <input onkeyup="search()" id="tenkhachhang_search" class="Input_Style" type="text" placeholder="Tên, số điện thoại" autocomplete="FALSE" style="width: 250px;">
                            <input onkeyup="search_songay()" id="songayhethan_search" class="Input_Style" type="text" placeholder="Số ngày hết hạn" autocomplete="FALSE" style="width: 130px;">
                            <select onchange="quanlyhopdong_load()" class="form-control" id="trangthai_search">
                                <option value="">Tất cả</option>
                                <option value="0">Còn hạn</option>
                                <option value="1">Hết hạn</option>
                            </select>
                        </div>
                        <div class="card-body card_body_khachhang">
                            <div id="" class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Khách hàng</th>
                                            <th>PM</th>
                                            <th>Điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Người ĐD</th>
                                            <th>Ngày BĐ</th>
                                            <th>Ngày KT</th>
                                            <th>Hết hạn</th>
                                            <th>SLGH</th>
                                        </tr>
                                    </thead>
                                    <tbody id="contract_tbody" class="contract_tbody">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


    </div>

    <script src="vendor/js/contract.js?v=<?= md5_file('vendor/js/contract.js') ?>"></script>
    <script>
        $(document).ready(function() {
            quanlyhopdong_load()
        });
    </script>
<?php } ?>