<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && $_COOKIE['loaiuser'] >= 98) { ?>
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">Items Management (IT)</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-2">
                <div class="row">
                    <!-- Danh sách đơn hàng -->
                    <div class="col-12">
                        <div class="title_group">
                            <div class="" style="display: flex; align-items: center; justify-content: start; gap:20px; flex-wrap: wrap; max-width: 1200px;">
                                <!-- Fliter nhóm sản phẩm -->
                                <select class="form-control" onchange="item_fillter()" id="filter_nhom" style="width:230px;">
                                    <option value="">Tất cả nhóm</option>
                                    <?php
                                    foreach ($List_DMPhanLoai_nhomsp as $r) {
                                        echo '<option value="' . $r->msloai . '">' . $r->tenloai . '</option>';
                                    }
                                    ?>
                                </select>
                                <!-- Fliter nhà cung cấp -->
                                <select class="form-control" onchange="item_fillter()" id="filter_ncc" style="width:230px;">
                                    <option value="">Nhà cung cấp</option>
                                    <?php
                                    foreach ($List_DMPhanLoai_ncc as $r) {
                                        echo '<option value="' . $r->msnsx . '">' . $r->tennsx . '</option>';
                                    }
                                    ?>
                                </select>
                                <!-- Fliter tiêu chuẩn -->
                                <select class="form-control" onchange="item_fillter()" id="filter_tieuchuan" style="width:230px;">
                                    <option value="">Tiêu chuẩn</option>
                                    <?php
                                    foreach ($List_DMPhanLoai_tieuchuan as $r) {
                                        echo '<option value="' . $r->msloai . '">' . $r->tenloai . '</option>';
                                    }
                                    ?>
                                </select>
                                <!-- Fliter nhà sản xuất -->
                                <select class="form-control" onchange="item_fillter()" id="filter_nsx" style="width:230px;">
                                    <option value="">Nhà sản xuất</option>
                                    <?php
                                    foreach ($List_DMPhanLoai_nhasx as $r) {
                                        echo '<option value="' . $r->msloai . '">' . $r->tenloai . '</option>';
                                    }
                                    ?>
                                </select>
                                <!-- Fliter loại hàng hóa -->
                                <select class="form-control" onchange="item_fillter()" id="filter_loaihh" style="width:230px;">
                                    <option value="">Loại hàng hóa</option>
                                    <?php
                                    foreach ($List_DMPhanLoai_loaihh as $r) {
                                        echo '<option value="' . $r->msloai . '">' . $r->tenloai . '</option>';
                                    }
                                    ?>
                                </select>
                                <!-- Fliter Kích hoạt -->
                                <select class="form-control" onchange="item_fillter_trangthai()" id="filter_trangthai" style="width:230px;">
                                    <option value="">Trạng thái</option>
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiện</option>
                                    <option value="99">Khóa</option>

                                </select>
                                <!-- Fliter Nhóm nổi bật -->
                                <select class="form-control" onchange="item_fillter()" id="filter_nhomnoibat" style="width:230px;">
                                    <option value="">Nhóm nổi bật</option>
                                    <option value="0">Không</option>
                                    <option value="1">Có</option>
                                </select>
                                <input onkeyup="item_search()" id="hanghoa_search" type="text" class="form-control" placeholder="Tìm tên hàng hóa, Tên hoạt chất, Tiêu chuẩn, Nhà sản xuất" style="width:250px;">
                            </div>
                            <div class="title_group">
                                <a href="items-add">
                                    <button class="btn btn-primary btn_add_hanghoa" data-toggle="modal" data-target="#add_hanghoa_form" type="button">
                                        Thêm mới
                                    </button>
                                </a>
                                <button onclick="in_mavach_load_thuoc()" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#inmavach_form">
                                    In mã vạch
                                </button>
                                <button type="button" onclick="print_banggia()" class="btn btn-secondary">In Bảng giá</button>
                            </div>
                        </div>
                        <div class="card-body card_body_donhang">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">MSHH</th>
                                            <th scope="col">Tên hàng hóa</th>
                                            <th scope="col">Tên hoạt chất</th>
                                            <th scope="col">Hàm lượng</th>
                                            <th scope="col">Giá nhập</th>
                                            <th scope="col">Giá Bán</th>
                                            <th scope="col">Quy cách</th>
                                            <th scope="col">Tiêu chuẩn</th>
                                            <th scope="col">Nhà CC</th>
                                            <th scope="col">Nhà SX</th>
                                            <th scope="col">Nhóm</th>
                                            <th scope="col">Nổi bật</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="donhang_table_header" class="donhang_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Chi tiết đơn hàng -->


                </div>
            </div>
        </div>
    </div>

    <!-- Form xác nhận hủy -->
    <div class="modal fade" id="form_xacnhan" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div id="title" style="padding:10px; justify-content: space-evenly;" class="modal-header">
                    <h4 id="tensp" style="display: flex; align-items: center;"></h4>
                </div>
                <div class="modal-body" style="display:flex;justify-content: center;">

                    <select id="chonkichhoat" style='width: 200px; border: none; border-bottom: 2px solid #000; '>
                        <?php
                        foreach ($List_DMPhanLoai_trangthaihh as $r) {
                            echo '<option value="' . $r->msloai . '">' . $r->tenloai . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="mshh_kichhoat">
                    <input type="hidden" id="trangthai_kichhoat">
                    <div id="btn_dongy"></div>
                    <button type="button" class="btn btn-secondary" onclick="handleEditTrangThai()">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>



    <script>
        $(document).ready(function() {
            item_fillter()
            // setInterval(donhang_load(), 1000);
        })
    </script>

    <script src="vendor/js/items.js?v=<?= md5_file('vendor/js/items.js') ?>"></script>
<?php } ?>