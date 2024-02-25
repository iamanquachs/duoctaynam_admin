<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && $_COOKIE['loaiuser'] >= 98) { ?>
    <!-- Main Content -->
    <div id="content" style="background-color: #e0e0e0;">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">Product Inquiry (PI)</h1>

            <div class="row">
                <div class="col-12 ">
                    <div class="nhapkho">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách yêu cầu</h6>
                        <div style="margin-top: 20px; max-height: 600px; overflow-y: scroll;">
                            <table class="table table-bordered table-gre">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ngày yêu cầu</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Tên hoạt chất</th>
                                        <th scope="col">Hàm lượng</th>
                                        <th scope="col">Nhà sản xuất</th>
                                        <th scope="col">Ghi chú</th>
                                        <th scope="col">Link sản phẩm</th>
                                        <th scope="col">Ngày cấp link</th>
                                        <th scope="col">...</th>
                                        <th scope="col">...</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_yeucau">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Form load nhập kho chưa thành công -->
    <div class="modal fade" id="form_edit_yeucau" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:orange">Cập nhật link sản phẩm</h4>
                </div>

                <div class="modal-body">
                    <label for="msncc_add" style="width: 100%; margin: 10px 10px;">
                        <p style="margin-bottom: 3px;">Link sản phẩm</p>
                        <input class="form_input_right_add" style="width: 100%;" type="text" id="link_sanpham" require>
                    </label>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="msdn_yeucau_edit">
                    <input type="hidden" id="msdv_yeucau_edit">
                    <input type="hidden" id="rowid_yeucau_edit">
                    <button type="button" onclick="edit_yeucau(this)" class="btn btn-secondary" style="background-color: red; border: none ;" data-dismiss="modal">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" style="background-color: orange; border: none ;" data-dismiss="modal">Bỏ qua</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Form delete nhập kho header -->
    <div class="modal fade" id="form_delete_yeucau" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Xóa yêu cầu sản phẩm</h4>
                </div>

                <div class="modal-body" style="text-align: center;">
                    <img style="width: 70px; color: red;" src="./vendor/img/warning_delete.png">
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="msdn_yeucau_delete">
                    <input type="hidden" id="msdv_yeucau_delete">
                    <input type="hidden" id="rowid_yeucau_delete">
                    <button type="button" onclick="delete_yeucau(this)" class="btn btn-secondary" style="background-color: red; border: none ;" data-dismiss="modal">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" style="background-color: #ddd; border: none ; color: #000;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>



    <script>
        $(document).ready(function() {
            load_yeucau()

        })
    </script>
    <script src="vendor/js/yeucau.js?v=<?= md5_file('vendor/js/yeucau.js') ?>"></script>
<?php } ?>