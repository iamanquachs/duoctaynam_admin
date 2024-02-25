<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "" && $_COOKIE['loaiuser'] >= 98) { ?>
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="justify-content: space-between;">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <div>
                <img style="width: 200px;" src="vendor/img/Logo_TPSPharma.png" alt=""></a>

            </div>
            <div style="display: flex; gap:20px;  align-items: center;">
                <label for="get_month" style="color:black">Chọn tháng</label>
                <input type="month" onchange="load_theothang()" class="input_select_month" id="get_month" name="get_month" min="2023-01" value="">
            </div>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Searchduy for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">3+</span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>

                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>

                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter">7</span>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Message Center
                        </h6>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_COOKIE['username'] ?></span>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Doanh thu</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <span style="margin-bottom: 0;" id="tongxuatkho"></span>/
                                        <span style="color: red; margin-bottom: 0px;">
                                            <span id='tongdoanhthu'></span>
                                            <span id="phantram"></span></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Lợi nhuận</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <span style="margin-bottom: 0;" id="tongtienxuatkho"></span>/
                                        <span style="color: red; margin-bottom: 0px;">
                                            <span style="margin-bottom: 0;" id="loinhuan">
                                            </span>
                                            <span id="phantram_loinhuan"></span>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Đơn hàng</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <p style="margin-bottom: 0;" id="donhang"></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Khách hàng mới
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <span style="margin-bottom: 0;" id="tongkhachhang"></span>/

                                                <span style="color: red; margin-bottom: 0px;">
                                                    <span style="margin-bottom: 0;" id="khachhangmoi">

                                                    </span>
                                                    <span id="phantram_khachhang"></span>
                                                </span>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Tồn kho
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= str_replace(',', '.', number_format($tongtientonkho)) ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Đơn hàng chưa nhận</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <span id="donhangchuanhan"></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Công nợ phải thu</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><span id='congnophaithu'></span></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->


                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Công nợ phải trả
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id='congnophaitra'></span></div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Content Row -->

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Hàng hóa bán chạy</h6>

                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <table class="table table-bordered table-white " style="min-height: 400px;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên thuốc</th>
                                        <th scope="col">Tên hoạt chất</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_hanghoabanchay">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Hàng hóa lợi nhuận cao</h6>

                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <table class="table table-bordered table-white " style="min-height: 400px;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên thuốc</th>
                                        <th scope="col">Tên hoạt chất</th>
                                        <th scope="col">Thành tiền</th>
                                        <th scope="col">%</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_hanghoaloinhuancao">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Content Column -->
                <div class="col-lg-6 mb-4">

                    <!-- Project Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh thu theo khách hàng</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-white " style="min-height: 400px;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Mã số khách hàng</th>
                                        <th scope="col">Tên khách hàng</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col">%</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_doanhthutheokhachhang">

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 mb-4">

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lợi nhuận theo khách hàng</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-white " style="min-height: 200px;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Mã số khách hàng</th>
                                        <th scope="col">Tên khách hàng</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col">%</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_loinhuantheokhachhang">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Approach -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tuổi nợ khách hàng</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-white " style="min-height: 200px;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ngày</th>
                                        <th scope="col">Mã số khách hàng</th>
                                        <th scope="col">Tên khách hàng</th>
                                        <th scope="col">Tuổi nợ</th>
                                    </tr>
                                </thead>
                                <tbody class="__chitiet_tuoinokhachhang">

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <script>
        function getDate() {
            const date = new Date();
            const thang = date.getMonth() + 1

            const nam = date.getFullYear()
            $('#get_month').val(nam + '-' + (thang < 10 ? '0' + thang : thang))
        }
        getDate()
    </script>
    <script>
        $(document).ready(function() {
            load_theothang()
        })
    </script>
    <script src="vendor/js/home.js?v=<?= md5_file('vendor/js/home.js') ?>"></script>

<?php } else {
}
