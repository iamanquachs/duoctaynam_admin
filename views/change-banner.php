<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && $_COOKIE['loaiuser'] >= 98) { ?>
    <!-- Main Content -->
    <div id="content" style="background-color: #e0e0e0;">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800" style="text-align: center; margin: 10px 0px; padding-bottom: 7px; border-bottom: solid 1px #d1d1d1;">Change Image Banner</h1>

            <div class="row">
                <div class="col-4 ">
                    <div class="nhapkho">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách hình ảnh</h6>
                        <div style="margin-top: 20px; max-height: 400px; overflow-y: scroll;">
                            <table class="table table-bordered table-gre">
                                <thead>
                                    <tr>
                                        <th scope="col">Vị trí</th>

                                    </tr>
                                </thead>
                                <tbody class="__chitiet_banner_header">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-8 ">
                    <div class="nhapkho">
                        <div style="margin-top: 10px;">
                            <table class="table table-bordered table-white ">
                                
                                <thead>
                                    <tr>
                                        <th scope="col">Vị trí</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">File</th>
                                        <th scope="col">Sửa</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_banner_line">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form load nhập kho chưa thành công -->
    <div class="modal fade" id="form_change_banner" data-bs-backdrop="static" data-keyboard="false" aria-labelledby="form_add" aria-hidden="true">
        <div class="modal-dialog modal_dialog_xetnghiem" style="max-width:430px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color:red">Đổi Banner!</h4>
                </div>

                <div class="modal-body" style="justify-content: center;">
                    <img id="img_banner_change" style="max-width: 400px; margin-bottom: 10px;">
                    <div>
                        <label for="link_img_change" style="border: 1px solid #ddd; border-radius: 5px; padding: 10px 5px;">Chọn file hình ảnh</label>
                        <input id="link_img_change" hidden onchange="anhsanpham(this)" type="file" accept="image/*">
                    </div>
                    <div style="margin-top: 10px; ">
                        <label for="link_pdf_change" style="border: 1px solid #ddd; border-radius: 5px; padding: 10px 5px;" id="ten_file_pdf">Chọn file</label>
                        <input id="link_pdf_change" type="file" hidden accept="*">
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="vitri_banner">
                    <input type="hidden" id="ten_banner">
                    <input type="hidden" id="ten_pdf">
                    <input type="hidden" id="vitri_header">
                    <button type="button" onclick="change_banner(this)" class="btn btn-success" style="background-color: green; border: none ;">Đồng ý</button>
                    <button type="button" class="btn btn-secondary" style="background-color: orange; border: none ;" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>




    <script>
        function anhsanpham(input) {
            $('#img_banner_change')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
        }
        $(document).ready(function() {
            load_img_banner()
        })
        $("#link_pdf_change").change(function() {
            filename = this.files[0].name;
            $('#ten_file_pdf').html(filename);
        });
    </script>

    <script src="vendor/js/change_img.js?v=<?= md5_file('vendor/js/change_img.js') ?>"></script>
<?php } ?>