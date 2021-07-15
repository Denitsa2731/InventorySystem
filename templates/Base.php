
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoices System</title>
    <base href="http://localhost/~deni/InventorySystem/public/">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>


    <!-- plugins:css -->
    <link rel="stylesheet" href="admin/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="admin/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="admin/images/favicon.png" />

</head>
<body>

<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
            <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                <a class="navbar-brand brand-logo" href="dashboard"><img src="admin/images/logo.svg" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="admin/images/logo-mini.svg" alt="logo"/></a>
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-sort-variant"></span>
                </button>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">


        </div>
    </nav>
</div>

<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <?php if(!isset($arguments['hideNav'])) {
        ?>
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard">
                        <i class="mdi mdi-home menu-icon"></i>
                        <span class="menu-title">Начало</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products">
                        <i class="mdi mdi-home menu-icon"></i>
                        <span class="menu-title" href="produucts">Продукти</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="category">
                        <i class="mdi mdi-home menu-icon"></i>
                        <span class="menu-title" href="category">Категории</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order">
                        <i class="mdi mdi-home menu-icon"></i>
                        <span class="menu-title" href="order">Поръчки</span>
                    </a>
                </li>
                <?php if(isset($_SESSION['user']) && $_SESSION['user']['userRole'] == 'admin') {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="user/register">
                            <i class="mdi mdi-home menu-icon"></i>
                            <span class="menu-title" href="user/register">Добави нов служител</span>
                        </a>
                    </li>
                <?php
                }?>
                <li class="nav-item">
                    <a class="nav-link" href="user/logout">
                        <i class="mdi mdi-home menu-icon"></i>
                        <span class="menu-title" href="user/logout">Изход</span>
                    </a>
                </li>
            </ul>
        </nav>
    <?php
    }?>


    <!-- partial -->
    <div class="main-panel" <?php echo isset($arguments['hideNav']) ?  'style="width: 100%;"':''?>>
        <div class="content-wrapper">

            <div class="row">
                <div class="col-md-12 grid-margin">
                    <?php
                    include $template;
                    ?>

                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2021</span>

            </div>
        </footer>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>

<!-- plugins:js -->
<script src="admin/vendors/base/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="admin/vendors/chart.js/Chart.min.js"></script>
<script src="admin/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="admin/js/off-canvas.js"></script>
<script src="admin/js/hoverable-collapse.js"></script>
<script src="admin/js/template.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="admin/js/dashboard.js"></script>
<script src="admin/js/data-table.js"></script>
<script src="admin/js/jquery.dataTables.js"></script>
<script src="admin/js/dataTables.bootstrap4.js"></script>
<!-- End custom js for this page-->
<script src="admin/js/jquery.cookie.js" type="text/javascript"></script>
</body>
</html>
