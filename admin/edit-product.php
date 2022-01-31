<?php
session_start();
if(!$_SESSION['Loggeduser'])
  header("Location: ../home");
  include "update-product.php";
try {
  $sereverName = "localhost";
  $dbName = "tech-life";
  $dbusername = "root";
  $dbpassword = "";
  $conn = new PDO("mysql:host=$sereverName;dbname=$dbName", $dbusername, $dbpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "connection successfully!<br>";
} catch (PDOException $e) {
  echo "<br>" . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Home</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>  

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users CRUD</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories CRUD</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products CRUD</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index4.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact CRUD</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index5.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders CRUD</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

         <!-- edit product start -->
         <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="update-product.php">
                <div class="card-body">
                <input type="hidden" name="product-id" value="<?php echo $id ?>">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Name</label>
                    <input type="text" name="p_name" class="form-control" id="exampleInputPassword1" placeholder="New Name" value="<?php echo $productName; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Category</label>
                    <select class="form-control" name="p_category">
                    <!-- </select> -->
                    <?php
                    $sql = "SELECT id,name FROM categories";
                    $result = $conn->query($sql);
                    $result = $result->fetchAll(PDO::FETCH_ASSOC);
                    foreach($result as $v){
                        if($v['name']==="{$_GET['category']}"){
                            echo "<option value='{$v['id']}' selected>";
                      echo $v['name'];
                      echo "</option>";   
                        }
                        else{
                            echo "<option value='{$v['id']}'>";
                      echo $v['name'];
                      echo "</option>";
                        }
                    }
                    ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Image</label>
                    <input type="text" name="p_image" class="form-control" id="exampleInputPassword1" placeholder="New Image" value="<?php echo $productImage; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Stock</label>
                    <input type="number" name="p_stock" class="form-control" id="exampleInputPassword1" placeholder="New Stock Value" value="<?php echo $productStock; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input type="number" name="p_price" class="form-control" id="exampleInputPassword1" placeholder="New Price" value="<?php echo $productPrice; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Discount</label>
                    <input type="text" name="p_discount" class="form-control" id="exampleInputPassword1" placeholder="New Discount" value="<?php echo $productDiscount; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Age Rating</label>
                    <input type="text" name="p_age-rating" class="form-control" id="exampleInputPassword1" placeholder="New Age Rating" value="<?php echo $productAgeRating; ?>">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="update-product">Update</button>
                </div>
              </form>
            </div>

            <?php

            if(isset($_POST['c_id'])&&preg_match("/^[0-9]*$/",$_POST['c_id'])){
              if(isset($_POST['c_name'])&&strlen($_POST['c_name'])>4){
                $sql = "UPDATE products SET name='{$_POST['c_name']}' WHERE id={$_POST['c_id']}";
                $conn->query($sql);
              }
              if(isset($_POST['c_description'])&&strlen($_POST['c_description'])>4){
                $sql = "UPDATE products SET description='{$_POST['c_description']}' WHERE id={$_POST['c_id']}";
                $conn->query($sql);
              }
              if(isset($_POST['c_category'])&&preg_match("/[0-9]/",$_POST['c_category'])){
                $sql = "UPDATE products SET category_id='{$_POST['c_category']}' WHERE id={$_POST['c_id']}";
                $conn->query($sql);
              }
              if(isset($_POST['c_image'])&&strlen($_POST['c_image'])>4){
                $sql = "UPDATE products SET image='{$_POST['c_image']}' WHERE id={$_POST['c_id']}";
                $conn->query($sql);
              }
              if(isset($_POST['c_stock'])&&preg_match("/[0-9]/",$_POST['c_stock'])){
                $sql = "UPDATE products SET stock='{$_POST['c_stock']}' WHERE id={$_POST['c_id']}";
                $conn->query($sql);
              }
              if(isset($_POST['c_price'])&&preg_match("/[0-9]/",$_POST['c_price'])){
                $sql = "UPDATE products SET price='{$_POST['c_price']}' WHERE id={$_POST['c_id']}";
                $conn->query($sql);
              }
              if(isset($_POST['c_discount'])&&preg_match("/[0-9]/",$_POST['c_discount'])){
                $sql = "UPDATE products SET discount='{$_POST['c_discount']}' WHERE id={$_POST['c_id']}";
                $conn->query($sql);
              }
            }


            ?>
        
            <!-- edit product end -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
