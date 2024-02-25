<!DOCTYPE html>
<html lang="en">

<head>
    <base href="https://localhost/DuocTayNam/Admin/">
    </base>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tây Nam Pharma</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="vendor/ckeditor/ckeditor.js"></script>

    <!-- Custom styles for this template-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/js/admin.js?v=<?= md5_file('vendor/js/admin.js') ?>"></script>
    <script type="text/javascript" src="vendor/js/socket.io.min.js?v=<?= md5_file('vendor/js/socket.io.min.js') ?>"></script>
    <link rel="stylesheet" type="text/css" href="vendor/css/sb-admin-2.css?v=<?= md5_file('vendor/css/sb-admin-2.css') ?>">
    <link rel="stylesheet" type="text/css" href="vendor/css/style.css?v=<?= md5_file('vendor/css/style.css') ?>">
    <link rel="stylesheet" type="text/css" href="vendor/css/nhapkho.css?v=<?= md5_file('vendor/css/nhapkho.css') ?>">

    <link href="vendor/css/input_style.css" rel="stylesheet">
    <link href="vendor/css/datepicker.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="vendor/img/logo.ico">

</head>
<?php
if (isset($_COOKIE['msdn']) != "") { ?>

    <body id="page-top">
        <div id="wrapper">
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
                <a style="padding-bottom:5px; height:3rem" class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    <p>ERP</p>
                </a>
                <div style="color: white; text-align:center;padding-bottom:5px"><?= $_COOKIE['msdn'] ?></div>
                <input id='loaiuser_dangnhap' hidden value='<?= $_COOKIE['loaiuser'] ?>'>
                <hr class="sidebar-divider my-0">

                <li class="nav-item ">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>CRM</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div style="background-color: #414241;" class=" py-2 collapse-inner rounded">
                            <?php
                            if (($_COOKIE['loaiuser']) >= 98  || ($_COOKIE['loaiuser']) == 0) { ?>

                                <a href="customers" id="customers" class="collapse-item item_header">Khách hàng</a>
                                <hr class="sidebar-divider item_header" style=" margin:0">
                                <a href="contract" id="contract" class="collapse-item item_header">Theo dõi hợp đồng</a>
                            <?php
                            } else { ?>
                                <a id="customers" class="collapse-item item_header">Khách hàng</a>
                                <hr class="sidebar-divider item_header" style=" margin:0">
                                <a id="contract" class="collapse-item item_header">Theo dõi hợp đồng</a>
                            <?php } ?>

                        </div>
                    </div>
                </li>
                <li class="nav-item ">
                    <?php
                    if (($_COOKIE['loaiuser']) >= 98 || ($_COOKIE['loaiuser']) == 0) { ?>
                        <a href="work" class="nav-link">
                            <i class="fas fa-fw fa-user"></i>
                            <span>Công việc</span></a>
                    <?php
                    } else { ?>
                        <a class="nav-link">
                            <i class="fas fa-fw fa-user"></i>
                            <span>Công việc</span></a>
                    <?php } ?>
                </li>
                <hr class="sidebar-divider my-0">
                <?php
                if (($_COOKIE['loaiuser']) >= 98 || ($_COOKIE['loaiuser']) == 0) { ?>
                    <li class="nav-item ">
                        <a href="oms" class="nav-link">
                            <i style="position: relative;" class="fas fa-shopping-cart">
                                <span id="soluong_donhang"></span></i>
                            <span>Đặt hàng</span>
                            <script>
                                var socket = io("https://notication.duoctaynam.vn");
                                //ready
                                socket.emit('get_soluong');
                                //hung data
                                socket.on("soluong", function(donhang) {
                                    $("#soluong_donhang").text(donhang);
                                });
                            </script>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="ims" class="nav-link">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Đơn hàng</span></a>
                    </li>
                <?php
                } else { ?>
                    <li class="nav-item ">
                        <a href="#" class="nav-link">
                            <i style="position: relative;" class="fas fa-shopping-cart">
                                <span id="soluong_donhang"></span></i>
                            <span>Đặt hàng</span>
                            <script>
                                var socket = io("https://notication.duoctaynam.vn");
                                //ready
                                socket.emit('get_soluong');
                                //hung data
                                socket.on("soluong", function(donhang) {
                                    $("#soluong_donhang").text(donhang);
                                });
                            </script>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Đơn hàng</span></a>
                    </li>
                <?php } ?>


                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-box"></i>
                        <span>Kho</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div style="background-color: #414241;" class=" py-2 collapse-inner rounded">
                            <?php
                            if (($_COOKIE['loaiuser']) >= 98) { ?>
                                <a href="import" class="collapse-item item_header" style="color: #fff;font-size: 14px;">
                                    <span>Nhập kho</span></a>
                                <hr class="sidebar-divider" style=" margin:0">
                                <a href="export" class="collapse-item item_header" style="color: #fff;font-size: 14px;">
                                    <span>Xuất kho</span></a>
                                <hr class="sidebar-divider" style=" margin:0">
                                <a href="product-inquiry" class="collapse-item item_header" style="color: #fff;font-size: 14px;">
                                    <span>Yêu cầu hàng hóa</span></a>
                                <hr class="sidebar-divider" style=" margin:0">

                                <a href="items" class="collapse-item item_header" style="color: #fff;font-size: 14px;">
                                    <span>Danh mục hàng hóa</span></a>
                            <?php
                            } else { ?>
                                <a class="collapse-item item_header" style="color: #fff;font-size: 14px;">
                                    <span>Nhập kho</span></a>
                                <hr class="sidebar-divider" style=" margin:0">
                                <a class="collapse-item item_header" style="color: #fff;font-size: 14px;">
                                    <span>Xuất kho</span></a>
                                <hr class="sidebar-divider" style=" margin:0">
                                <a class="collapse-item item_header" style="font-size: 14px;">
                                    <span>Yêu cầu hàng hóa</span></a>
                                <hr class="sidebar-divider" style=" margin:0">

                                <a class="collapse-item item_header" style="color: #fff;font-size: 14px;">
                                    <span>Danh mục hàng hóa</span></a>
                            <?php } ?>

                        </div>
                    </div>
                </li>

                <hr class="sidebar-divider">

                <li class="nav-item">
                    <?php
                    if (($_COOKIE['loaiuser']) >= 98 || $_COOKIE['loaiuser'] == 1) { ?>
                        <a href="accounting" class="nav-link">
                            <i class="fas fa-hand-holding-usd"></i>
                            <span>Thu chi</span></a>
                    <?php
                    } else { ?>
                        <a class="nav-link">
                            <i class="fas fa-hand-holding-usd"></i>
                            <span>Thu chi</span></a>
                    <?php } ?>
                </li>
                <hr class="sidebar-divider">

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        <i class="fas fa-gifts"></i>
                        <span>CTKM</span>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div style="background-color: #414241;" class=" py-2 collapse-inner rounded">
                            <?php
                            if (($_COOKIE['loaiuser']) >= 98) { ?>
                                <a href="promotions" class="collapse-item item_header">
                                    <span>CTKM</span></a>
                                <hr class="sidebar-divider item_header" style=" margin:0">
                                <a href="change-banner" class="collapse-item item_header">
                                    <span>Change Banner</span></a>

                            <?php
                            } else { ?>
                                <a class="collapse-item item_header" style="color: #fff;font-size: 14px;">
                                    <span>CTKM</span></a>
                                <hr class="sidebar-divider" style=" margin:0">
                                <a class="collapse-item item_header">
                                    <span>Change Banner</span></a>

                            <?php } ?>

                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <?php
                    if (($_COOKIE['loaiuser']) >= 98) { ?>
                        <a href="voucher" class="nav-link">
                            <i class="fas fa-hand-holding-usd"></i>
                            <span>Voucher</span>
                        </a>
                    <?php
                    } else { ?>
                        <a class="nav-link">
                            <i class="fas fa-hand-holding-usd"></i>
                            <span>Voucher</span>
                        </a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                    <?php
                    if (($_COOKIE['loaiuser']) >= 98) { ?>
                        <a href="report-cus-item" class="nav-link">
                            <i class="fas fa-hand-holding-usd"></i>
                            <span>Báo cáo</span>
                        </a>
                    <?php
                    } else { ?>
                        <a class="nav-link">
                            <i class="fas fa-hand-holding-usd"></i>
                            <span>Báo cáo</span>
                        </a>
                    <?php } ?>
                </li>

                <hr class="sidebar-divider">
                <li class="nav-item">
                    <a onclick="logout()" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>

                <hr class="sidebar-divider d-none d-md-block">

                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>


            </ul>
            <div id="content-wrapper" class="d-flex flex-column" style="overflow-x: visible;">
                <script src="vendor/js/admin.js?v=<?= md5_file('vendor/js/admin.js') ?>"></script>

                <script>
                    $(document).ready(function() {
                        loai_loaiUser()
                    })

                    function add_active(e) {
                        $('.active_items_hover').removeClass('active_items')
                        $(e).addClass('active_items')
                    }
                </script>
            <?php } else { ?>

                <body class="bg-gradient-primary">
                    <div class="container">

                        <!-- Outer Row -->
                        <div style="margin-top: 100px;" class="row justify-content-center">

                            <div class="col-md-6">

                                <div class="card o-hidden border-0 shadow-lg my-5">
                                    <div class="card-body p-0">
                                        <!-- Nested Row within Card Body -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="p-4">
                                                    <div class="text-center">
                                                        <img src="vendor/img/Logo_TPSPharma.png" alt="" style="width:14em; margin-bottom:20px">
                                                    </div>
                                                    <form class="user" method="post" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <input type="text" name="msdn" class="form-control form-control-user" id="msdn" aria-describedby="emailHelp" placeholder="Số điện thoại">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" name="matkhau" class="form-control form-control-user" id="matkhau" placeholder="Mật khẩu">
                                                        </div>
                                                        <div style="margin-top: 30px">
                                                            <button onclick="login()" type="submit" name="submit_login" class="btn btn-primary btn-user btn-block">
                                                                Đăng nhập
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <script src="vendor/js/admin.js?v=<?= md5_file('vendor/js/admin.js') ?>"></script>



                    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                    <script src="js/sb-admin-2.min.js"></script>
                    <script type="text/javascript" src="vendor/js/tinymce.min.js"></script>
                    <script type="text/javascript" src="vendor/js/model.min.js"></script>
                    <script type="text/javascript" src="vendor/js/icon.min.js"></script>

                </body>


            <?php }
            ?>