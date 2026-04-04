<?php
include_once('../admin/layout_admin/header.php');
// session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin2 </title>
    <!-- plugins:css -->

</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="../admin/assets/images/1.jpg" alt="logo">
                            </div>
                            <h4>Login</h4>
                            <form class="pt-3" id="loginForm">
                            <input type="hidden" name="action" value="login">

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="email" name="email"
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="password" name="password" placeholder="Password">
                                </div>
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">
                                        SIGN IN
                                    </button>
                                </div>
                             
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <!-- <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                                    </div> -->
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div> 
                                 <div class="mb-2 d-grid gap-2">
                                    <button type="button" class="btn btn-block btn-google auth-form-btn">
                                        <i class="ti-google me-2"></i>Connect using google </button>
                                </div> 
                                 <!-- <div class="text-center mt-4 fw-light"> Don't have an account? <a href="register.html"
                                        class="text-primary">Create</a>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../admin/assets/vendors/js/vendor.bundle.base.js"></script>

    <script src="../admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../admin/assets/js/off-canvas.js"></script>
    <script src="../admin/assets/js/template.js"></script>

    <script src="../admin/assets/js/settings.js"></script>
    <script src="../admin/assets/js/hoverable-collapse.js"></script>
    <script src="../admin/assets/js/todolist.js"></script>
    <!-- endinject -->
    <script>
$("#loginForm").submit(function(e){
    e.preventDefault();

    // Add the action field to the formData
    var formData = new FormData(this);
    formData.append("action", "login"); // Required by your PHP API

    $.ajax({
        url: BASE_URL + "api/api.php",
        type: "POST",
        data: formData,
        processData: false,  // Important for FormData
        contentType: false,  // Important for FormData
        dataType: "json",
        success: function(response){
            if(response.status == "success"){
                Swal.fire({
                    icon: 'success',
                    title: 'Login Successful',
                    text: 'Redirecting...',
                    timer: 1500,
                    showConfirmButton: false
                }).then(function(){
                    window.location.href = BASE_URL + "dashboard.php";
                    // C:\wamp64\www\hirapara\admin\dashboard.php
                    // window.location.href = "../admin/dashboard.php";
                });

            }else{

                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: response.message || 'Invalid Email or Password'
                });

            }

        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            Swal.fire({
                icon: 'error',
                title: 'Something went wrong',
                text: 'Please try again later.'
            });
        }
    });

});
</script>

</body>

</html>