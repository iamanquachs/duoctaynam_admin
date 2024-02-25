<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && ($_COOKIE['loaiuser'] >= 98 || $_COOKIE['loaiuser'] == 0)) { ?>
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">CRM ● <?= $_COOKIE['hoten'] ?></h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-2">
                <div class="row">
                    <div class="col-sm-4 col-12">
                        <div class="card-header py-3 card_header_khachhang">
                            <div>
                                <h6 class="m-0 font-weight-bold text-primary">Danh sách Khách hàng</h6>
                            </div>
                            <div>
                                <img onclick="location.reload()" src="vendor/img/refresh24.png" alt="Load lại trang" title="Load lại trang">
                                <img data-toggle="modal" data-target="#form_add" src="vendor/img/add24.png" alt="Thêm mới khách hàng" title="Thêm mới khách hàng">
                            </div>
                        </div>
                        <div class="khachhang_filter_div" style="display: flex; justify-content: center; align-items: center;">
                            <input onkeyup="khachhang_search()" id="tenkhachhang_search" class="Input_Style" type="text" placeholder="Tên, số điện thoại" autocomplete="FALSE" style="width:40%; margin-right:0px">
                            <div id="datepicker_khachhang" class="input-group date datepicker_khachhang" data-date-format="dd/mm/yyyy">
                                <input onchange="khachhang_filter()" class="form-control khachhang_tungay" value="<?= date('d/m/Y', strtotime('-30 day', strtotime(date('Y-m-d')))); ?>" type="text"> <span class="input-group-addon"></span>

                            </div>
                            <div id="datepicker_khachhang2" class="input-group date datepicker_khachhang" data-date-format="dd/mm/yyyy">
                                <input onchange="khachhang_filter()" class="form-control khachhang_denngay" name="denngay" value="<?= date('d/m/Y'); ?>" type="text"> <span class="input-group-addon"></span>
                            </div>

                        </div>

                        <div class="khachhang_filter_div" style="display: flex; justify-content: center; align-items: center;margin-top: 10px;">
                            <select onchange="khachhang_filter()" class="form-control" id="trangthai_khachhang_loc">
                                <option value="">Trạng thái</option>
                                <?php
                                foreach ($list_trangthai as $r) { ?>
                                    <option value="<?= $r->msloai ?>"><?= $r->tenloai ?></option>
                                <?php }
                                ?>
                            </select>
                            <select onchange="khachhang_filter()" class="form-control" id="msdn_khachhang_loc">
                                <option value="">Tất cả nhân viên</option>
                                <?php
                                foreach ($list_user as $r) { ?>
                                    <option value="<?= $r->msdn ?>"><?= $r->hoten ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>



                        <div class="card-body card_body_khachhang">
                            <div id="khachhang_table_header" class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Khách hàng</th>
                                            <th>Điện thoại</th>
                                            <th>...</th>
                                            <th>...</th>
                                            <th>...</th>
                                        </tr>
                                    </thead>
                                    <tbody class="khachhang_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 col-12">
                        <div class="card-header py-3 card_header_khachhang">
                            <div style="display: flex; align-items: center;">
                                <h6 class="m-0 font-weight-bold text-primary">Nhật ký Khách hàng</h6>
                                <input hidden id="mskh_form" />
                                <input hidden id="tendv" />
                                <input hidden id="dtdaidien" />
                                <input hidden id="tendaidien" />
                                <input hidden id="diachi" />
                                <input hidden id="msxa" />
                                <input hidden id="dtcongtacvien" />
                                <input hidden id="ngaykichhoat" />
                                <div style='padding-left: 10px;'>
                                    <img id="btn_add_chitiet" onclick="load_hinhanh()" data-toggle="modal" data-target="#form_add_img" src="vendor/img/add24.png" alt="Thêm mới ảnh chi tiết" title="Thêm mới ảnh chi tiết">
                                </div>
                            </div>
                            <div>
                                <img id="btn_add_chitiet" data-toggle="modal" data-target="#form_chitiet_add" src="vendor/img/add_1_24.png" alt="Thêm mới nhật kí khách hàng chi tiết" title="Thêm mới nhật kí khách hàng chi tiết">
                            </div>
                        </div>
                        <div class="card-body card_body_khachhang">
                            <div id="khachhang_table_line" class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ngày</th>
                                            <th>NV</th>
                                            <th>Yêu cầu</th>
                                            <th>Ghi chú</th>
                                            <th>Nội dung</th>
                                            <th>Báo giá</th>
                                            <th>Trạng thái</th>
                                            <th>...</th>
                                            <th>...</th>
                                        </tr>
                                    </thead>
                                    <tbody class="chitiet_khachhang_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


    </div>
    <!-- Form Add -->
    <div class="modal fade" id="form_add" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem">
            <div class="modal-content">
                <div style="padding:10px" class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Thêm mới Khách hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ngay_add" value="<?= date('d/m/Y') ?>" class="field__input txt_date" data-date-format="dd-mm-yy" type="text" placeholder="Ngày" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false" disabled>
                                <span class="field__label-wrap">
                                    <span class="field__label">Ngày</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input type="text" id="tenkh_add" class="field__input" placeholder="Vui lòng nhập tên khách hàng" required>
                                <span class="field__label-wrap">
                                    <span class="field__label">Tên Khách hàng</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="dienthoai_add" onkeyup="this.value = this.value.replace(/[^0-9\.\,]/g,'')" class="field__input" placeholder="Vui lòng nhập số điện thoại">
                                <span class="field__label-wrap">
                                    <span class="field__label">Điện thoại</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="diachi_add" class="field__input" placeholder="Vui lòng nhập địa chỉ">
                                <span class="field__label-wrap">
                                    <span class="field__label">Số nhà, Đường</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="row" style="padding: 0 10px">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4 control-label ">
                                        <p style="margin:0;">Tỉnh</p>
                                    </div>
                                    <div class="col-sm-12">
                                        <select id="active_tinh" onChange="Load_Huyen()" class="form-control chosen-select">
                                            <?php
                                            foreach ($db->_Get_ListTinh() as $r) {
                                                if ($r->matinh == $matinh_edit) {
                                                    echo '<option value="' . $r->matinh . '" selected>' . $r->tentinh . '</option>';
                                                } else {
                                                    echo '<option value="' . $r->matinh . '">' . $r->tentinh . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4 control-label">
                                        <p style="margin:0;">Huyện</p>
                                    </div>
                                    <div class="col-sm-12">
                                        <select id="active_huyen" onChange="Load_Xa()" class="form-control chosen-select">
                                            <option value="<?= $mahuyen ?>"><?= $tenhuyen ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4 control-label">
                                        <p style="margin:0;">Xã</p>
                                    </div>
                                    <div class="col-sm-12">
                                        <select id="active_xa" name="msxa" class="form-control chosen-select">
                                            <option value="<?= $maxa ?>"><?= $tenxa ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div id="check_input_add" style="margin:10px 0"></div>
                        <div class="control_btn">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button style="margin-left: 5px;" type="button" onclick="khachhang_add()" class="btn btn-success">Lưu</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Form Edit -->
    <div class="modal fade" id="form_edit" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem">
            <div class="modal-content">
                <div style="padding:10px" class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Chỉnh sửa Khách hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ngay_edit" value="<?= date('d/m/Y') ?>" class="field__input txt_date" data-date-format="dd-mm-yy" type="text" placeholder="Ngày" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false" disabled>
                                <span class="field__label-wrap">
                                    <span class="field__label">Ngày</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input type="hidden" id="mskh_edit">
                                <input type="text" id="tenkh_edit" class="field__input" placeholder="Vui lòng nhập tên khách hàng" required>
                                <span class="field__label-wrap">
                                    <span class="field__label">Tên Khách hàng</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="dienthoai_edit" onkeyup="this.value = this.value.replace(/[^0-9\.\,]/g,'')" class="field__input" placeholder="Vui lòng nhập số điện thoại">
                                <span class="field__label-wrap">
                                    <span class="field__label">Điện thoại</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="diachi_edit" class="field__input" placeholder="Vui lòng nhập địa chỉ">
                                <span class="field__label-wrap">
                                    <span class="field__label">Địa chỉ</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="row" style="padding: 0 10px">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4 control-label ">
                                        <p style="margin:0;">Tỉnh</p>
                                    </div>
                                    <div class="col-sm-12">
                                        <select id="active_tinh_edit" onChange="Load_Huyen_edit()" class="form-control chosen-select">
                                            <?php
                                            foreach ($db->_Get_ListTinh() as $r) {
                                                if ($r->matinh == $matinh_edit) {
                                                    echo '<option value="' . $r->matinh . '" selected>' . $r->tentinh . '</option>';
                                                } else {
                                                    echo '<option value="' . $r->matinh . '">' . $r->tentinh . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4 control-label">
                                        <p style="margin:0;">Huyện</p>
                                    </div>
                                    <div class="col-sm-12">
                                        <select id="active_huyen_edit" onChange="Load_Xa_edit()" class="form-control chosen-select">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4 control-label">
                                        <p style="margin:0;">Xã</p>
                                    </div>
                                    <div class="col-sm-12">
                                        <select id="active_xa_edit" name="msxa" class="form-control chosen-select">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="check_input_edit" style="margin:10px 0"></div>
                        <div class="control_btn">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button style="margin-left: 5px;" type="button" onclick="khachhang_edit()" class="btn btn-success">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form delete -->
    <div class="modal fade" id="form_delete" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem">
            <div class="modal-content">
                <div style="padding:10px" class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Đồng ý xóa?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="margin: 0;margin-left: 10px;" id="khachhang_delete"></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="mskh_delete">
                    <button data-dismiss="modal" class="btn btn-secondary">Hủy</button>
                    <button onclick="khachhang_delete()" class="btn btn-danger">Đồng ý</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form Add chi tiết -->
    <div class="modal fade" id="form_chitiet_add" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem">
            <div class="modal-content">
                <div style="padding:10px" class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Thêm nhật ký</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input type="hidden" id="ctkh_mskh">
                                <input type="hidden" id="ctkh_tenkh">
                                <input id="ctkh_ngay_add" value="<?= date('d/m/Y') ?>" class="field__input txt_date" data-date-format="dd-mm-yy" type="text" placeholder="Ngày" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false" disabled>
                                <span class="field__label-wrap">
                                    <span class="field__label">Ngày</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ctkh_yeucau_add" class="field__input" placeholder="Vui lòng nhập Yêu cầu">
                                <span class="field__label-wrap">
                                    <span class="field__label">Yêu cầu</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ctkh_note_add" class="field__input" placeholder="Vui lòng nhập Ghi chú">
                                <span class="field__label-wrap">
                                    <span class="field__label">Ghi chú</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ctkh_link_add" class="field__input" placeholder="Vui lòng nhập Link tài liệu">
                                <span class="field__label-wrap">
                                    <span class="field__label">Link tài liệu</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ctkh_gia_add" class="field__input" onkeyup="this.value = this.value.replace(/[^0-9\.\,-]/g,'');_ChangeFormat(this)" type="text" placeholder="Vui lòng nhập Báo giá">
                                <span class="field__label-wrap">
                                    <span class="field__label">Báo giá</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ctkh_tungay_add" value="<?= date('d/m/Y') ?>" onkeyup="put_thangkm_add()" class="field__input txt_date" data-date-format="dd-mm-yy" type="text" placeholder="Ngày" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">
                                <span class="field__label-wrap">
                                    <span class="field__label">Từ ngày</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ctkh_thangkm_add" class="field__input" value="0" onkeyup="put_thangkm_add()" onkeyup="this.value = this.value.replace(/[^0-9\.\,-]/g,'');_ChangeFormat(this)" type="text" placeholder="Vui lòng nhập Số tháng khuyến mãi">
                                <span class="field__label-wrap">
                                    <span class="field__label">Số tháng khuyến mãi</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ctkh_denngay_add" value="<?= date('d/m/Y', strtotime('+52 week + 1 day', strtotime(date('Y-m-d')))); ?>" class="field__input ctkh_denngay_add" data-date-format="dd-mm-yy" type="text" placeholder="Ngày" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">
                                <span class="field__label-wrap">
                                    <span class="field__label">Đến ngày</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="padding: 0 10px">
                        <div class="row">
                            <div class="col-sm-12 " id="loai_hopdong_add" style="display: flex; align-items: center;">

                                <input type="radio" name="loai_hopdong_add" id="new" value="NEW" checked></input>
                                <label style="margin:0; padding-left: 5px;" for="new">HĐ mới</label>

                                <input style="margin-left: 20px;" name="loai_hopdong_add" type="radio" id='renew' value="RENEW"></input>
                                <label style="margin:0; padding-left: 5px;" for="renew">Gia hạn</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <select class="form-control" id="loaiphanmem_ctkh_add">
                                <option value="EP">EP</option>
                                <option value="EC">EC</option>
                                <option value="EPEC">EPEC</option>
                                <option value="EPW">EPW</option>
                                <option value="ECW">ECW</option>
                                <option value="EPECW">EPECW</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <select class="form-control" id="trangthai_ctkh_add">
                                <option value="">Chọn Trạng thái</option>
                                <?php
                                foreach ($list_trangthai_ctkh as $r) { ?>
                                    <option value="<?= $r->msloai ?>"><?= $r->tenloai ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div id="check_input_add_ct" style="margin:10px 0"></div>
                        <div class="control_btn">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button style="margin-left: 5px;" type="button" onclick="khachhang_chitiet_add()" class="btn btn-success">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form edit chi tiết -->
    <div class="modal fade" id="form_chitiet_edit" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem">
            <div class="modal-content">
                <div style="padding:10px" class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Chỉnh sửa nhật ký</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input type="hidden" id="ctkh_mskh_edit">
                                <input type="hidden" id="ctkh_msct_edit">
                                <input id="ctkh_ngay_edit" value="<?= date('d/m/Y') ?>" class="field__input txt_date" data-date-format="dd-mm-yy" type="text" placeholder="Ngày" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false" disabled>
                                <span class="field__label-wrap">
                                    <span class="field__label">Ngày</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ctkh_yeucau_edit" class="field__input" placeholder="Vui lòng nhập Yêu cầu">
                                <span class="field__label-wrap">
                                    <span class="field__label">Yêu cầu</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ctkh_note_edit" class="field__input" placeholder="Vui lòng nhập Ghi chú">
                                <span class="field__label-wrap">
                                    <span class="field__label">Ghi chú</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ctkh_link_edit" class="field__input" placeholder="Vui lòng nhập Link tài liệu">
                                <span class="field__label-wrap">
                                    <span class="field__label">Link tài liệu</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ctkh_gia_edit" class="field__input" onkeyup="this.value = this.value.replace(/[^0-9\.\,-]/g,'');_ChangeFormat(this)" type="text" placeholder="Vui lòng nhập Giá">
                                <span class="field__label-wrap">
                                    <span class="field__label">Giá</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ctkh_tungay_edit" value="<?= date('d/m/Y', strtotime(date('Y-m-d'))) ?>" onkeyup="put_thangkm_edit()" class="field__input ctkh_tungay_edit" data-date-format="dd-mm-yy" type="text" placeholder="Ngày" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yy" data-mask="" im-insert="false">
                                <span class="field__label-wrap">
                                    <span class="field__label">Từ ngày</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ctkh_thangkm_edit" class="field__input" value="0" onkeyup="put_thangkm_edit()" onkeyup="this.value = this.value.replace(/[^0-9\.\,-]/g,'');_ChangeFormat(this)" type="text" placeholder="Vui lòng nhập Số tháng khuyến mãi">
                                <span class="field__label-wrap">
                                    <span class="field__label">Số tháng khuyến mãi</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label class="field field_v2 width_100">
                                <input id="ctkh_denngay_edit" value="<?= date('d/m/Y', strtotime('+52 week + 1 day', strtotime(date('Y-m-d')))); ?>" class="field__input ctkh_denngay_edit" data-date-format="dd-mm-yy" type="text" placeholder="Ngày" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" im-insert="false">
                                <span class="field__label-wrap">
                                    <span class="field__label">Đến ngày</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="padding: 0 10px">
                        <div class="row">
                            <div class="col-sm-12 " id="loai_hopdong_edit" style="display: flex; align-items: center;">

                                <input type="radio" name="loai_hopdong" id="new_edit" value="NEW" checked></input>
                                <label style="margin:0; padding-left: 5px;" for="new">Đăng ký mới</label>

                                <input style="margin-left: 20px;" name="loai_hopdong" type="radio" id='renew_edit' value="RENEW"></input>
                                <label style="margin:0; padding-left: 5px;" for="renew">Gia hạn</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <select class="form-control" id="loaiphanmem_ctkh_edit">
                                <option value="EP">EP</option>
                                <option value="EC">EC</option>
                                <option value="EPEC">EPEC</option>
                                <option value="EPW">EPW</option>
                                <option value="ECW">ECW</option>
                                <option value="EPECW">EPECW</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <select class="form-control" id="trangthai_ctkh_edit">
                                <option value="">Chọn Trạng thái</option>
                                <?php
                                foreach ($list_trangthai_ctkh as $r) { ?>
                                    <option value="<?= $r->msloai ?>"><?= $r->tenloai ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div id="check_input_edit_ct" style="margin:10px 0"></div>
                        <div class="control_btn">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button style="margin-left: 5px;" type="button" onclick="khachhang_chitiet_edit()" class="btn btn-success">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form delete chi tiết -->
    <div class="modal fade" id="form_chitiet_delete" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem">
            <div class="modal-content">
                <div style="padding:10px" class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Đồng ý xóa dòng số?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="margin: 0;margin-left: 10px;" id="ctkh_stt_td"></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="ctkh_mskh_delete">
                    <input type="hidden" id="ctkh_msct_delete">
                    <button data-dismiss="modal" class="btn btn-secondary">Hủy</button>
                    <button onclick="ctkh_delete()" class="btn btn-danger">Đồng ý</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Form Add hình ảnh -->
    <div class="modal fade" id="form_add_img" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem">
            <div class="modal-content">
                <div style="padding:10px" class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hình ảnh</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form_add_img">
                        <label class="field field_v2 width_50" style="border: #ddd 1px solid;border-radius: 5px;">
                            <input id="file_img" type="file" onchange="add_hinhanh()" accept="image/*,.pdf" data-multiple-caption="{count} files selected" multiple required>
                        </label>
                    </div>
                    <div id="img_kh" class="row">
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-secondary">Đóng</button>

                </div>
            </div>

        </div>
    </div>
    <!-- Form chốt khách hàng -->
    <div class="modal fade" id="form_chot_kh" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem">
            <div class="modal-content">
                <div style="padding:10px" class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Chắc chắn chuyển kích hoạt</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="padding:0 20px;" class="modal-body">
                    <p id='thongbao_form'></p>
                    <input id="tendv_form" hidden />
                    <input id="dtdaidien_form" hidden />
                    <input id="tendaidien_form" hidden />
                    <input id="diachi_form" hidden />
                    <input id="msxa_form" hidden />
                    <input id="dtcongtacvien_form" hidden />
                    <input id="ngaykichhoat_form" hidden />

                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-secondary">Đóng</button>
                    <button id="__btn_success" onclick="chot_khachhang()" class="btn btn-danger">Đồng ý</button>
                </div>
            </div>

        </div>
    </div>
    <script src="vendor/js/khachhang.js?v=<?= md5_file('vendor/js/khachhang.js') ?>"></script>
    <script>
        $(document).ready(function() {
            khachhang_filter()
            // put_thangkm()
        });
    </script>
<?php } ?>