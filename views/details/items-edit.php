<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && $_COOKIE['loaiuser'] >= 98) { ?>
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">Items Management (IT) | Add Items</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-2">
                <div class="group_itemadd">
                    <div class="row">
                        <!-- Danh sách đơn hàng -->
                        <div class="col-12">
                            <div class="title_group">
                                <div class="title_group">
                                    <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa hàng hóa</h6>
                                </div>
                                <div class="title_group">
                                    <div>
                                        <button class="btn btn-primary btn_add_hanghoa" onclick="item_edit()" type="button">
                                            Lưu
                                        </button>
                                    </div>
                                    <a href="items">
                                        <button onclick="in_mavach_load_thuoc()" type="button" class="btn btn-warning" data-toggle="modal" data-target="#inmavach_form">
                                            Hủy
                                        </button>
                                    </a>
                                    <a href="items">
                                        <button type="button" onclick="print_banggia()" class="btn btn-secondary">Trở về</button>
                                    </a>
                                </div>
                            </div>
                            <div class="title_group">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6 card-body card_body_donhang">
                                                <label class="field field_v2">
                                                    <select class="form-control field__input" id="nhasx_edit" style="width:230px;height: 50px; color: #000;">

                                                    </select>
                                                    <span class="field__label-wrap">
                                                        <span class="field__label">Nhà sản xuất</span>
                                                    </span>
                                                    <div><img data-target="#add_nhasx_form" data-toggle="modal" src="./vendor/img/add24.png"></div>
                                                </label>
                                            </div>
                                            <div class="col-6 card-body card_body_donhang">
                                                <label class="field field_v2">
                                                    <select class="form-control field__input" id="nuocsx_edit" style="width:230px;height: 50px; color: #000;">

                                                    </select>
                                                    <span class="field__label-wrap">
                                                        <span class="field__label">Nước sản xuất</span>
                                                    </span>
                                                    <div><img data-target="#add_nuocsx_form" data-toggle="modal" src="./vendor/img/add24.png"></div>
                                                </label>
                                            </div>
                                            <div class="col-6 card-body card_body_donhang">
                                                <label class="field field_v2">
                                                    <select class="form-control field__input" id="tieuchuan_edit" style="width:230px;height: 50px;  color: #000;">

                                                    </select>
                                                    <span class="field__label-wrap">
                                                        <span class="field__label">Tiêu chuẩn</span>
                                                    </span>
                                                    <div><img data-target="#add_tieuchuan_form" data-toggle="modal" src="./vendor/img/add24.png"></div>
                                                </label>
                                            </div>
                                            <div class="col-6 card-body card_body_donhang">
                                                <label class="field field_v2">
                                                    <select class="form-control field__input" id="nhomweb_edit" style="width:230px;height: 50px;  color: #000;">
                                                        <option value='0'>Không</option>
                                                        <option value="1">Có</option>
                                                    </select>
                                                    <span class="field__label-wrap">
                                                        <span class="field__label">Nhóm nổi bật</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div>

                                            </div>
                                            <div class="col-6 card-body card_body_donhang" hidden>
                                                <label class="field field_v2">
                                                    <input type="text" id="msncc_edit" class="field__input" placeholder="Vui lòng nhập" value="<?= $msncc ?>">
                                                    <span class="field__label-wrap">
                                                        <span id='msncc_err' class="field__label">NCC</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-6 card-body card_body_donhang" hidden>
                                                <label class="field field_v2">
                                                    <input type="text" id="msncchh_edit" class="field__input" placeholder="Vui lòng nhập" value="<?= $mshhncc ?>">
                                                    <span class="field__label-wrap">
                                                        <span id='msncchh_err' class="field__label">MSHHNCC</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-6 card-body card_body_donhang">
                                                <label class="field field_v2">
                                                    <input type="text" id="msnpp_edit" class="field__input" placeholder="Vui lòng nhập" value="<?= $msnpp ?>">
                                                    <span class="field__label-wrap">
                                                        <span id='msnpp_err' class="field__label">MSNPP</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-6 card-body card_body_donhang">
                                                <label class="field field_v2">
                                                    <input type="text" id="mshhnpp_edit" class="field__input" placeholder="Vui lòng nhập" value="<?= $mshhnpp ?>">
                                                    <span class="field__label-wrap">
                                                        <span id='mshhnpp_err' class="field__label">MSHHNPP</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-6 card-body card_body_donhang">
                                                <label class="field field_v2">
                                                    <select class="form-control field__input" onchange="load_quycach_edit()" id="dvtmin_edit" style="width:230px;height: 50px; color: #000;">

                                                    </select>
                                                    <span class="field__label-wrap">
                                                        <span class="field__label">ĐVT</span>
                                                    </span>
                                                    <div><img data-target="#add_dvt_form" data-toggle="modal" src="./vendor/img/add24.png"></div>
                                                </label>
                                            </div>

                                            <div class="col-12 card-body card_body_donhang0" style="padding-left: 0;">
                                                <div style="display: flex; justify-content: space-between;">
                                                    <p style="color: red; margin-bottom: 10px;">Hồ sơ giá bán</p>
                                                    <div>
                                                        <img style="margin-right: 10px;" onclick="tracuu_giaban('edit')" src="./vendor/img/search.png">
                                                        <img onclick="open_add_hosogiaban()" src="./vendor/img/add24.png">
                                                    </div>
                                                </div>
                                                <div style="min-height: 40px;">
                                                    <table class="table table-bordered table-gre">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Ngày</th>
                                                                <th scope="col">ĐVT bán</th>
                                                                <th scope="col">SL bán từ</th>
                                                                <th scope="col">SL bán đến</th>
                                                                <th scope="col">Giá bán</th>
                                                                <th scope="col">ĐVT EGPP</th>
                                                                <th scope="col">SL quy đổi</th>
                                                                <th scope="col">SL max</th>
                                                                <th scope="col">...</th>
                                                                <th scope="col">...</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="table_hoso_giaban">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 card-body card_body_donhang" style="margin-top: 120px;">
                                            <span>Ảnh sản phẩm</span>
                                            <div>
                                                <label class="field_v2 width_100" style="margin-bottom: 0; width: 200px; height: 200px;">
                                                    <label for="anhsanpham_edit" class="drop-container" style="margin-bottom: 0; width: 200px; height: 200px;">
                                                        <img style="z-index: 10; height: 100px;" id='img_sanpham_edit' />
                                                        <span class="drop-title"><img src="vendor/img/plus.png" /></span>
                                                        <input hidden type="file" name="file" id="anhsanpham_edit" onchange="anhsanpham(this)" accept="image/*" class="inputfile" placeholder="Vui lòng nhập thông tin" data-multiple-caption="{count} files selected" multiple>
                                                    </label>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 card-body card_body_donhang">
                                            <input hidden id="all_img_mota">
                                            <span>Ảnh mô tả sản phẩm</span>
                                            <div class='center' style="width: 95%; gap: 10px; flex-wrap: wrap;">
                                                <div style="width: 23%;">
                                                    <div class="field_v2 width_100  drop-container1" style="margin-bottom: 0;  width: 200px; height: 200px;">
                                                        <label for="anhsanphammota1_edit" class="drop-container" style="margin-bottom: 0; width: 200px; height: 200px;">
                                                            <img style="z-index: 10; height: 100px;" id='img_sanphammota_edit1' />
                                                            <span class="drop-title"><img src="vendor/img/plus.png" /></span>
                                                            <input hidden id='path_child1'>
                                                            <input hidden type="file" name="file" id="anhsanphammota1_edit" accept="image/*" onchange="item_edit_img_phu(this, 1)" class="inputfile" placeholder="Vui lòng nhập thông tin" data-multiple-caption="{count} files selected" multiple required>
                                                        </label>
                                                        <div class="delete_item1" onclick="delete_img_mota(this,1)">
                                                            <img alt="Xóa" src="./vendor/img/delete.png">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 23%;display: none;" id="form_add_img2">
                                                    <div class="field_v2 width_100  drop-container2" style="margin-bottom: 0; width: 200px; height: 200px;">
                                                        <label for="anhsanphammota2_edit" class="drop-container" style="margin-bottom: 0; width: 200px; height: 200px;">
                                                            <img style="z-index: 10; height: 100px;" id='img_sanphammota_edit2' />
                                                            <span class="drop-title"><img src="vendor/img/plus.png" /></span>
                                                            <input hidden id='path_child2'>
                                                            <input hidden type="file" name="file" id="anhsanphammota2_edit" accept="image/*" onchange="item_edit_img_phu(this, 2)" class="inputfile" placeholder="Vui lòng nhập thông tin" data-multiple-caption="{count} files selected" multiple required>
                                                        </label>
                                                        <div class="delete_item2" onclick="delete_img_mota(this,2)">
                                                            <img alt="Xóa" src="./vendor/img/delete.png">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 23%;display: none;" id="form_add_img3">
                                                    <div class="field_v2 width_100 drop-container3" style="margin-bottom: 0; width: 200px; height: 200px;">
                                                        <label for="anhsanphammota3_edit" class="drop-container" style="margin-bottom: 0; width: 200px; height: 200px;">
                                                            <img style="z-index: 10; height: 100px;" id='img_sanphammota_edit3' />
                                                            <span class="drop-title"><img src="vendor/img/plus.png" /></span>
                                                            <input hidden id='path_child3'>
                                                            <input hidden type="file" name="file" id="anhsanphammota3_edit" accept="image/*" onchange="item_edit_img_phu(this, 3)" class="inputfile" placeholder="Vui lòng nhập thông tin" data-multiple-caption="{count} files selected" multiple required>
                                                        </label>
                                                        <div class="delete_item3" onclick="delete_img_mota(this,3)">
                                                            <img alt="Xóa" src="./vendor/img/delete.png">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 23%;display: none;" id="form_add_img4">
                                                    <div class="field_v2 width_100 drop-container4" style="margin-bottom: 0; width: 200px; height: 200px;">
                                                        <label for="anhsanphammota4_edit" class="drop-container" style="margin-bottom: 0; width: 200px; height: 200px;">
                                                            <img style="z-index: 10; height: 100px;" id='img_sanphammota_edit4' />
                                                            <span class="drop-title"><img src="vendor/img/plus.png" /></span>
                                                            <input hidden id='path_child4'>
                                                            <input hidden type="file" name="file" id="anhsanphammota4_edit" accept="image/*" onchange="item_edit_img_phu(this, 4)" class="inputfile" placeholder="Vui lòng nhập thông tin" data-multiple-caption="{count} files selected" multiple required>
                                                        </label>
                                                        <div class="delete_item4" onclick="delete_img_mota(this,4)">
                                                            <img alt="Xóa" src="./vendor/img/delete.png">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body card_body_donhang" hidden>
                                        <label class="field field_v2">
                                            <input type="text" id="mshh_edit" class="field__input" value="<?= $mshh ?>">
                                            <span class="field__label-wrap">
                                                <span id='mshh_err' class="field__label">MSHH</span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12 card-body card_body_donhang">
                                                <label class="field field_v2" style="width: 95%">
                                                    <input type="text" id="tenhh_edit" style="color: red; font-weight: 600;" class="field__input" placeholder="Vui lòng nhập" value="<?= $tenhh ?>">
                                                    <span class="field__label-wrap">
                                                        <span id='tenhh_err' class="field__label">Tên hàng hóa</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-12 card-body card_body_donhang">
                                                <div class="card-body card_body_donhang" hidden>
                                                    <label class="field field_v2">
                                                        <input type="text" id="mshh_add" value="<?= $mshh ?>" class="field__input">
                                                        <span class="field__label-wrap">
                                                            <span id='mshh_err' class="field__label">MSHH</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 card-body card_body_donhang" style="margin-right: 20px;">
                                                <span id="tenhc_err">
                                                    Tên hoạt chất
                                                </span>
                                                <label class="field_v2 field_v2" style="height: 50px;">
                                                    <textarea row="5" cols="50" style="height:50px" type="text" id="tenhc_edit" class="field__input" placeholder="" required><?= $tenhoatchat ?></textarea>
                                                    <script>
                                                        var editor = CKEDITOR.replace('tenhc_edit');
                                                    </script>

                                                </label>
                                            </div>
                                            <div class="col-12 card-body card_body_donhang">
                                                <label class="field field_v2" style="width: 95%">
                                                    <input type="text" id="tenbd_edit" class="field__input" placeholder="Vui lòng nhập" value="<?= $tenbietduoc ?>">
                                                    <span class="field__label-wrap">
                                                        <span id='tenbd_err' class="field__label">Tên biệt dược</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-6 card-body card_body_donhang">
                                                        <label class="field field_v2">
                                                            <input type="text" id="hamluong_edit" class="field__input" placeholder="Vui lòng nhập" value="<?= $hamluong ?>">
                                                            <span class="field__label-wrap">
                                                                <span id='hamluong_err' class="field__label">Hàm lượng</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="col-6 card-body card_body_donhang">
                                                        <label class="field field_v2">
                                                            <input type="text" id="thuesuat_edit" class="field__input" placeholder="Vui lòng nhập" value="<?= $thuesuat ?>">
                                                            <span class="field__label-wrap">
                                                                <span id='thuesuat_err' class="field__label">Thuế suất</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="col-6 card-body card_body_donhang">
                                                        <label class="field field_v2">
                                                            <input type="text" id="tonkhotoithieu_edit" class="field__input" placeholder="Vui lòng nhập" value="<?= $tonkhott ?>">
                                                            <span class="field__label-wrap">
                                                                <span id='tonkhotoithieu_err' class="field__label">Tồn kho tối thiểu</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div>

                                                    </div>
                                                    <div class="col-6 card-body card_body_donhang">
                                                        <label class="field field_v2">
                                                            <select class="form-control field__input" id="nhomhh_edit" style="width:230px;height: 50px; color: #000;">

                                                            </select>
                                                            <span class="field__label-wrap">
                                                                <span class="field__label">Nhóm hàng hóa</span>
                                                            </span>
                                                            <div><img data-target="#add_nhomhh_form" data-toggle="modal" src="./vendor/img/add24.png"></div>
                                                        </label>
                                                    </div>
                                                    <div class="col-6 card-body card_body_donhang">
                                                        <label class="field field_v2">

                                                            <select class="form-control field__input" id="loaihh_edit" style="width:230px;height: 50px; color: #000;">

                                                            </select>
                                                            <span class="field__label-wrap">
                                                                <span class="field__label">Loại hàng hóa</span>
                                                            </span>
                                                            <div><img data-target="#add_loaihh_form" data-toggle="modal" src="./vendor/img/add24.png"></div>
                                                        </label>
                                                    </div>
                                                    <div class="col-6 card-body card_body_donhang">
                                                        <label class="field field_v2">
                                                            <select class="form-control field__input" id="bantheodon_edit" style="width:230px;height: 50px; color: #000;">
                                                                <?php
                                                                foreach ($List_DMPhanLoai_bantheodon as $t) {
                                                                    echo '<option value="' . $t->msloai . '">' . $t->tenloai . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span class="field__label-wrap">
                                                                <span class="field__label">Bán theo đơn</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="col-6 card-body card_body_donhang">
                                                        <label class="field field_v2">
                                                            <select class="form-control field__input" id="trangthaihh_edit" style="width:230px;height: 50px; color: #000;">
                                                                <?php
                                                                foreach ($List_DMPhanLoai_trangthaihh as $e) {
                                                                    echo '<option value="' . $e->msloai . '">' . $e->tenloai . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span class="field__label-wrap">
                                                                <span class="field__label">Kích hoạt</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="col-6 card-body card_body_donhang" style="margin-bottom: 10px;"></div>

                                                </div>
                                            </div>
                                            <div class="col-12 card-body card_body_donhang" style="margin-right: 20px;">
                                                <span id="ghichu">
                                                    Ghi chú
                                                </span>
                                                <label class="field_v2 field_v2" style="height: 50px;">
                                                    <textarea row="5" cols="50" style="height:50px" type="text" id="ghichu_edit" class="field__input" placeholder="" required><?= $ghichu ?></textarea>
                                                    <script>
                                                        var editor = CKEDITOR.replace('ghichu_edit');
                                                    </script>

                                                </label>
                                            </div>

                                        </div>

                                    </div>
                                    <div>
                                        <h4 style="color:green;padding-top: 20px;">Mô tả sản phẩm</h4>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6 card-body card_body_donhang">
                                                <div class="form-group">
                                                    <p style="color:#000; font-size:20px;">Chỉ định</p>
                                                    <div class="col-12">
                                                        <label class="field_v2 width_100">
                                                            <textarea row="5" cols="50" style="height:100px" type="text" id="chidinh_edit" class="field__input" placeholder="" required></textarea>
                                                            <script>
                                                                var editor = CKEDITOR.replace('chidinh_edit');
                                                            </script>
                                                            <span class="field__label-wrap">
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 card-body card_body_donhang">
                                                <div class="form-group">
                                                    <p style="color:#000; font-size:20px; ">Chống chỉ định</p>
                                                    <div class="col-12">
                                                        <label class="field_v2 width_100">
                                                            <textarea row="5" cols="50" style="height:100px" type="text" id="chongchidinh_edit" class="field__input" placeholder="" required></textarea>
                                                            <script>
                                                                var editor = CKEDITOR.replace('chongchidinh_edit');
                                                            </script>
                                                            <span class="field__label-wrap">
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 card-body card_body_donhang">
                                                <div class="form-group">
                                                    <p style="color:#000; font-size:20px;">Liều dùng</p>
                                                    <div class="col-12">
                                                        <label class="field_v2 width_100">
                                                            <textarea row="5" cols="50" style="height:100px" type="text" id="lieudung_edit" class="field__input" placeholder="" required></textarea>
                                                            <script>
                                                                var editor = CKEDITOR.replace('lieudung_edit');
                                                            </script>
                                                            <span class="field__label-wrap">
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 card-body card_body_donhang">
                                                <div class="form-group">
                                                    <p style="color:#000; font-size:20px;">Tác dụng phụ</p>
                                                    <div class="col-12">
                                                        <label class="field_v2 width_100">
                                                            <textarea row="5" cols="50" style="height:100px" type="text" id="tacdungphu_edit" class="field__input" placeholder="" required></textarea>
                                                            <script>
                                                                var editor = CKEDITOR.replace('tacdungphu_edit');
                                                            </script>
                                                            <span class="field__label-wrap">
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 card-body card_body_donhang">
                                                <div class="form-group">
                                                    <p style="color:#000; font-size:20px;">Thận trọng</p>
                                                    <div class="col-12">
                                                        <label class="field_v2 width_100">
                                                            <textarea row="5" cols="50" style="height:100px" type="text" id="thantrong_edit" class="field__input" placeholder="" required></textarea>
                                                            <script>
                                                                var editor = CKEDITOR.replace('thantrong_edit');
                                                            </script>
                                                            <span class="field__label-wrap">
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 card-body card_body_donhang">
                                                <div class="form-group">
                                                    <p style="color:#000; font-size:20px;">Tương tác thuốc</p>
                                                    <div class="col-12">
                                                        <label class="field_v2 width_100">
                                                            <textarea row="5" cols="50" style="height:100px" type="text" id="tuongtacthuoc_edit" class="field__input" placeholder="" required></textarea>
                                                            <script>
                                                                var editor = CKEDITOR.replace('tuongtacthuoc_edit');
                                                            </script>
                                                            <span class="field__label-wrap">
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 card-body card_body_donhang">
                                                <div class="form-group">
                                                    <p style="color:#000; font-size:20px;">Bảo quản</p>
                                                    <div class="col-12">
                                                        <label class="field_v2 width_100">
                                                            <textarea row="5" cols="50" style="height:100px" type="text" id="baoquan_edit" class="field__input" placeholder="" required></textarea>
                                                            <script>
                                                                var editor = CKEDITOR.replace('baoquan_edit');
                                                            </script>
                                                            <span class="field__label-wrap">
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <!-- Form thêm hồ sơ giá bán -->
    <div class="modal fade" id="form_add_hosogiaban" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div id="title" style="padding:10px" class="modal-header">
                    <h4 style="color: green;">
                        Thêm mới giá bán
                    </h4>
                </div>
                <div class="modal-body">
                    <label class="field field_v2" style="width: 100%;">
                        <select class="form-control field__input" id="dvt_ban_hsgb" style="width:100%;height: 50px;  color: #000;">
                            <?php foreach ($List_DMPhanLoai_dvt as $r) { ?>
                                <option value='<?= $r->msloai ?>'><?= $r->tenloai ?></option>
                            <?php } ?>
                        </select>
                        <span class="field__label-wrap">
                            <span style=" color: #000;" class="field__label">ĐVT bán</span>
                        </span>
                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="sl_bantu_hsgb" onkeyup="_ChangeFormat(this)" class="field__input tenloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span style=" color: #000;" class="field__label">SL bán từ</span>
                        </span>
                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <div class="col-8" style="padding: 0;">
                            <input type="text" id="sl_banden_hsgb" onkeyup="_ChangeFormat(this)" class="field__input tenloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                            <span class="field__label-wrap">
                                <span style=" color: #000;" class="field__label">SL bán đến </span>
                            </span>
                        </div>
                        <div class="col-4" style="display: flex;align-items: center;">
                            <span style=" color: #000; padding-right: 5px;">SL cao nhất</span>
                            <input type="checkbox" onchange="set_sl_caonhat(this)" id="sl_caonhat_hsgb" value="9999" style="color: #000;">

                        </div>

                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="giaban_hsgb" onkeyup="_ChangeFormat(this)" class="field__input msloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span style=" color: #000;" class="field__label">Giá bán</span>
                        </span>
                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <select class="form-control field__input" id="dvt_egpp_hsgb" style="width:100%;height: 50px;  color: #000;">
                            <?php foreach ($List_DMPhanLoai_dvt as $r) { ?>
                                <option value='<?= $r->msloai ?>'><?= $r->tenloai ?></option>
                            <?php } ?>
                        </select>
                        <span class="field__label-wrap">
                            <span style=" color: #000;" class="field__label">ĐVT EGPP</span>
                        </span>
                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="sl_quydoi_hsgb" onkeyup="_ChangeFormat(this)" class="field__input msloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span style=" color: #000;" class="field__label">SL quy đổi</span>
                        </span>
                    </label>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="mshh_add_hosohanghoa">
                    <button type="button" onclick="add_hosogiaban()" class="btn btn-success">Thêm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form thông báo đã có max hồ sơ giá bán -->
    <div class="modal fade" id="form_dacomax_hosohanghoa" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px; margin-top: 200px;">
            <div class="modal-content">
                <div id="title" style="padding:10px; justify-content: center;" class="modal-header">
                    <div style='display: flex; justify-content: center; flex-direction: column; align-items: center;'>

                        <p style="color:red; font-size: 22px">Đã có số lượng tối đa<span id="title_delete_hsgb"></span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form chỉnh sửa hồ sơ giá bán -->
    <div class="modal fade" id="form_edit_hosogiaban" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div id="title" style="padding:10px" class="modal-header">
                    <h4 style="color: green;">
                        Chỉnh sửa giá bán
                    </h4>
                </div>
                <div class="modal-body">
                    <input hidden id='rowid_edit_hsgb'>
                    <label class="field field_v2" style="width: 100%;">
                        <select class="form-control field__input" id="dvt_ban_hsgb_edit" style="width:100%;height: 50px;  color: #000;">
                            <?php foreach ($List_DMPhanLoai_dvt as $r) { ?>
                                <option value='<?= $r->tenloai ?>' data-valdvt='<?= $r->msloai ?>'><?= $r->tenloai ?></option>
                            <?php } ?>
                        </select>
                        <span class="field__label-wrap">
                            <span style=" color: #000;" class="field__label">ĐVT bán</span>
                        </span>
                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="sl_bantu_hsgb_edit" class="field__input tenloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span style=" color: #000;" class="field__label">SL bán từ</span>
                        </span>
                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <div class="col-8" style="padding: 0;">
                            <input type="text" id="sl_banden_hsgb_edit" onkeyup="_ChangeFormat(this)" class="field__input tenloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                            <span class="field__label-wrap">
                                <span style=" color: #000;" class="field__label">SL bán đến </span>
                            </span>
                        </div>
                        <div class="col-4" style="display: flex;align-items: center;">
                            <span style=" color: #000; padding-right: 5px;">SL cao nhất</span>
                            <input type="checkbox" onchange="set_sl_caonhat(this)" id="sl_caonhat_hsgb_edit" value="9999" style="color: #000;">

                        </div>

                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="giaban_hsgb_edit" onkeyup="_ChangeFormat(this)" class="field__input msloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span style=" color: #000;" class="field__label">Giá bán</span>
                        </span>
                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="sl_quydoi_hsgb_edit" class="field__input msloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span style=" color: #000;" class="field__label">SL quy đổi</span>
                        </span>
                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <select class="form-control field__input" id="dvt_egpp_hsgb_edit" style="width:100%;height: 50px;  color: #000;">
                            <?php foreach ($List_DMPhanLoai_dvt as $r) { ?>
                                <option value='<?= $r->tenloai ?>' data-valdvt='<?= $r->msloai ?>'><?= $r->tenloai ?></option>
                            <?php } ?>
                        </select>
                        <span class="field__label-wrap">
                            <span style=" color: #000;" class="field__label">ĐVT EGPP</span>
                        </span>
                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <select class="form-control field__input" id="khoa_hsgb_edit" style="width:100%;height: 50px;  color: #000;">
                            <option value="0">Hiện</option>
                            <option value="1">Ẩn</option>
                        </select>
                        <span class="field__label-wrap">
                            <span style=" color: #000;" class="field__label">Khóa</span>
                        </span>
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="edit_hosogiaban()" class="btn btn-success">Chỉnh</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form delete hồ sơ giá bán -->
    <div class="modal fade" id="delete_hosohanghoa" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px; margin-top: 200px;">
            <div class="modal-content">
                <div id="title" style="padding:10px; justify-content: center;" class="modal-header">
                    <div style='display: flex; justify-content: center; flex-direction: column; align-items: center;'>
                        <svg style="width: 100px; color: red;" aria-hidden="true" className="" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p style="color:red; font-size: 22px">Xóa <span id="title_delete_hsgb"></span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <input hidden id='id_hosogiaban'>
                    <input hidden id='mshh_hosogiaban'>
                    <button type="button" onclick="delete_hosogiaban(this)" class="btn btn-secondary" style="background-color: red; border: none ;" data-dismiss="modal">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form xác nhận hủy -->
    <div class="modal fade" id="edit_hanghoa_form" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div id="title" style="padding:10px" class="modal-header">
                    Xác nhận thay đổi
                </div>
                <div class="modal-footer">
                    <button id="btn_dongy" style="background-color: green;" type="button" onclick="item_edit()" class="btn btn-secondary" data-dismiss="modal">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form Thêm nhà sản xuất -->
    <div class="modal fade" id="add_nhasx_form" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div id="title" style="padding:10px" class="modal-header">
                    <h4>Thêm nhà sản xuất</h4>
                </div>
                <div class="modal-body">
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="qdnhonhat_min_add" class="field__input msloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span id='slquydoimin_err' style=" color: red;" class="field__label">Mã nhà sản xuất</span>
                        </span>
                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="qdnhonhat_min_add" class="field__input tenloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span id='slquydoimin_err' style=" color: red;" class="field__label">Tên nhà sản xuất</span>
                        </span>
                    </label>
                    <div class="list_nhasx">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tên nhà sản xuất</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody id="nhasx_table_header" class="nhasx_tbody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="add_phanloai(this, 'nhasx')">Thêm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form Thêm nước sản xuất -->
    <div class="modal fade" id="add_nuocsx_form" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div id="title" style="padding:10px" class="modal-header">
                    <h4>Thêm nước sản xuất</h4>
                </div>
                <div class="modal-body">
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="qdnhonhat_min_add" class="field__input msloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span id='slquydoimin_err' style=" color: red;" class="field__label">Mã nước sản xuất</span>
                        </span>
                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="qdnhonhat_min_add" class="field__input tenloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span id='slquydoimin_err' style=" color: red;" class="field__label">Tên nước sản xuất</span>
                        </span>
                    </label>
                    <div class="list_nhasx">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tên nhà sản xuất</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody id="nuocsx_table_header" class="nuocx_tbody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-success" onclick="add_phanloai(this,'nuocsx')">Thêm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form Thêm tiêu chuẩn -->
    <div class="modal fade" id="add_tieuchuan_form" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div id="title" style="padding:10px" class="modal-header">
                    <h4>Thêm tiêu chuẩn</h4>
                </div>
                <div class="modal-body">
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="qdnhonhat_min_add" class="field__input msloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span id='slquydoimin_err' style=" color: red;" class="field__label">Mã tiêu chuẩn</span>
                        </span>
                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="qdnhonhat_min_add" class="field__input tenloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span id='slquydoimin_err' style=" color: red;" class="field__label">Tên tiêu chuẩn</span>
                        </span>
                    </label>
                    <div class="list_nhasx">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tên nhà sản xuất</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody id="tieuchuan_table_header" class="tieuchuan_tbody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-success" onclick="add_phanloai(this, 'tieuchuan')">Thêm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form Thêm Nhóm hàng hóa -->
    <div class="modal fade" id="add_nhomhh_form" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div id="title" style="padding:10px" class="modal-header">
                    <h4>Thêm nhóm hàng hóa</h4>
                </div>
                <div class="modal-body">
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="qdnhonhat_min_add" class="field__input msloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span id='slquydoimin_err' style=" color: red;" class="field__label">Mã nhóm sản phẩm</span>
                        </span>
                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="qdnhonhat_min_add" class="field__input tenloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span id='slquydoimin_err' style=" color: red;" class="field__label">Tên nhóm sản phẩm</span>
                        </span>
                    </label>
                    <div class="list_nhasx">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tên nhóm hàng hóa</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody id="nhomhh_table_header" class="nhomhh_tbody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-success" onclick="add_phanloai(this,'nhom')">Thêm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form Thêm loại hàng hóa -->
    <div class="modal fade" id="add_loaihh_form" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div id="title" style="padding:10px" class="modal-header">
                    <h4>Thêm loại hàng hóa</h4>
                </div>
                <div class="modal-body">
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" class="field__input msloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span style=" color: red;" class="field__label">Mã loại hàng hóa</span>
                        </span>
                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="tenloai_add" class="field__input tenloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span style=" color: red;" class="field__label">Tên loại hàng hóa</span>
                        </span>
                    </label>
                    <div class="list_nhasx">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tên nhà sản xuất</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody id="loaihh_table_header" class="loaihh_tbody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-success" onclick="add_phanloai(this, 'loai')">Thêm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form thêm dvt -->
    <div class="modal fade" id="add_dvt_form" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:530px">
            <div class="modal-content">
                <div id="title" style="padding:10px" class="modal-header">
                    <h4>Thêm đơn vị tính</h4>
                </div>
                <div class="modal-body">
                    <label class="field field_v2" style="width: 100%; display: none;">
                        <input type="text" class="field__input msloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span style=" color: #000;" class="field__label">Mã loại hàng hóa</span>
                        </span>
                    </label>
                    <label class="field field_v2" style="width: 100%;">
                        <input type="text" id="tenloai_add" class="field__input tenloai_add" placeholder="Vui lòng nhập" style="width:100%;height: 50px; color: #000;">
                        <span class="field__label-wrap">
                            <span style=" color: red;" class="field__label">Thêm đơn vị tính</span>
                        </span>
                    </label>
                    <div class="list_nhasx">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tên nhà sản xuất</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody id="dvt_table_header" class="dvt_tbody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-success" onclick="add_phanloai(this, 'dvt')">Thêm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form thông báo mã bị trùng -->
    <div class="modal fade" id="form_msloai_trung" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:530px; margin-top: 220px; box-shadow: 5px 10px 18px #000;">
            <div class="modal-content">
                <div id="title" style="padding:10px" class="modal-header">
                    <h4 style="color:red">Thông tin đã tồn tại</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form tra cứu giá sản phẩm -->
    <div class="modal fade" id="form_tracuu_giaban" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:530px; margin-top: 220px; box-shadow: 5px 10px 18px #000;">
            <div class="modal-content">
                <div id="title" style="padding:10px" class="modal-header">
                    <h4 style="color:red">Thông tin sản phẩm</h4>
                </div>
                <div class="modal-body" style="overflow-y: scroll; max-height: 500px;">
                    <table class="table table-bordered table-gre">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên HH</th>
                                <th scope="col">ĐVT</th>
                                <th scope="col">Giá nhập</th>
                                <th scope="col">NCC</th>
                            </tr>
                        </thead>
                        <tbody class="table_tracuu_giaban">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(async function() {
            if (typeof timer !== undefined) {
                clearTimeout(this.timer);
            }
            let myPromise = new Promise(function(resolve) {
                load_nhasx();
                load_nuocsx();
                load_tieuchuan();
                load_nhom();
                load_loai();
                load_dvt();
                load_mota_edit();
                setTimeout(resolve, 2000);
            });
            await myPromise;
            handleLoad_dvtNhoNhat();
            item_load_edit()
            load_hosogiaban()
        })

        function anhsanpham(input) {
            $('#img_sanpham_edit')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
            item_edit_img_chinh()
        }
    </script>

    <script src="vendor/js/items.js?v=<?= md5_file('vendor/js/items.js') ?>"></script>
<?php } ?>