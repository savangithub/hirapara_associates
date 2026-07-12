<?php
require_once('../admin/config.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Hirpara Associates</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="../admin/assets/vendors/feather/feather.css">
    <link rel="stylesheet" href=>
    <link rel="stylesheet" href="../admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../admin/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../admin/assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../admin/assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../admin/assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../admin/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- endinject -->
  

  <link rel="stylesheet" href="../admin/assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js">

  <!-- endinject -->
  <link rel="shortcut icon" href="../admin/assets/images/favicon.ico" />

  <!-- plugins:css -->
    <link
      rel="stylesheet"
      href="assets/vendors/mdi/css/materialdesignicons.min.css"
    />
    <link
      rel="stylesheet"
      href="assets/vendors/ti-icons/css/themify-icons.css"
    />
    <link
      rel="stylesheet"
      href="assets/vendors/font-awesome/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css" />
    <link
      rel="stylesheet"
      href="assets/vendors/simple-line-icons/css/simple-line-icons.css"
    />
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css" />
    <link
      rel="stylesheet"
      href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css"
    />
    <!-- endinject -->
  <!-- Plugin css for this page -->
   <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css" />
  <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
   <link rel="stylesheet" href="../admin/assets/style.css" />

</head>

<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="../admin/assets/vendors/chart.js/chart.umd.js"></script>
<script src="../admin/assets/vendors/progressbar.js/progressbar.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../admin/assets/js/off-canvas.js"></script>
<script src="../admin/assets/js/template.js"></script>
<script src="../admin/assets/js/settings.js"></script>
<script src="../admin/assets/js/hoverable-collapse.js"></script>
<script src="../admin/assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="../admin/assets/js/jquery.cookie.js" type="text/javascript"></script>
<script src="../admin/assets/js/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
var BASE_URL = "<?php echo BASE_URL; ?>";

</script>
</html>