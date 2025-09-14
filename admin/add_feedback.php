<?php
include_once('../admin/layout_admin/header.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
  }

?>
<body class="with-welcome-text">

    <div class="container-scroller">
      <?php include('../admin/layout_admin/topbar.php'); ?>

      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <?php include('../admin/layout_admin/sidebar.php'); ?>

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
          
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <h4 class="card-title">Add Client Details</h4>
                      <a href="../admin/dashboard.php" class="btn btn-primary btn-rounded btn-fw">Back</a>
                  </div>

                    <form class="forms-sample material-form" id="myForm">
                      <div class="form-group">
                        <input type="text" name="full_name" id="full_name"  />
                        <label for="input" class="control-label">Full name</label><i class="bar"></i>
                        <small id="full_name_error" style="color: red"></small>
                    
                    </div>
                    <div class="form-group">
                        <input type="text" name="company_name" id="company_name"  />
                        <label for="input" class="control-label">Company Name</label><i class="bar"></i>
                        <small id="company_name_error" style="color: red"></small>
                    
                      </div>
                      <div class="form-group">
                        <input type="text" name="email" id="email"  />
                        <label for="input"  class="control-label">Email address</label><i class="bar"></i>
                      <small id="emailError" style="color: red"></small>
                      
                      </div>
                      <div class="form-group">
                        <input type="text" name="phone_no" id="phone_no" />
                        <label for="input"  class="control-label">Phone number</label><i class="bar"></i>
                        <small id="phone_noError" style="color: red"></small>
                      </div>
                      <div class="form-group">
                        <input type="text"   id="message" name="message" />
                        <label for="input" class="control-label">Message</label><i class="bar"></i>
                        <small id="message_error" style="color: red"></small>

                      </div>

                      <div class="button-container">
                        <button type="submit" class="button btn btn-primary"><span>Submit</span></button>
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
    <script src="../js/bootstrap.bundle.min.js"></script>

<!-- Additional Javascript -->
<script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"
></script>
<script src="../js/custom.js"></script>
<!-- <script src="js/custom.js"></script> -->
<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/client-slick.js"></script>
<script type="text/javascript" src="../fontawesome_5/all.min.js"></script>
<script
  type="text/javascript"
  src="../fontawesome_5/fontawesome.min.js"
></script>
<script src="../js/wow.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("myForm").addEventListener("submit", function (event) {
          event.preventDefault();
          let isValid = true;

        // Get all fields
        const name = document.getElementById("full_name");
        const email = document.getElementById("email");
        const phone = document.getElementById("phone_no");
        const company_name = document.getElementById("company_name");
        const message = document.getElementById("message");
        const full_name_error = document.getElementById("full_name_error");
        const emailError = document.getElementById("emailError");
        const phone_noError = document.getElementById("phone_noError");
        const company_nameError = document.getElementById("company_name_error");
        const messageError = document.getElementById("message_error");

        // Reset errors
        full_name_error.textContent = "";
        emailError.textContent = "";
        phone_noError.textContent = "";
        company_nameError.textContent = "";
        messageError.textContent = "";

            name.value = name.value.trim();
            email.value = email.value.trim();
            phone.value = phone.value.trim();
            company_name.value = company_name.value.trim();
            message.value = message.value.trim();

        
            // Validation
            // name
            if(name.value.length == 0){
                name_error.textContent = "Name is required.";
                isValid = false;
            }
           else if (name.value.length < 3 || name.value.length > 50) {
                name_error.textContent = "Name must be between 3 and 50 characters.";
                isValid = false;
            }
            
            // Phone
            const phoneRegex = /^\d{10,15}$/;
           if(phone.value == 0){
            phone_error.textContent = "Phone number is required.";
                    isValid = false;
            }
           else if (!phoneRegex.test(phone.value)) {
                phone_error.textContent = "Phone number must be between 10 and 15 digits.";
                isValid = false;
            }

            // Email
            const emailRegex = /\S+@\S+\.\S+/;
            if(email.value == 0){
            email_error.textContent = "Email is required.";
                    isValid = false;
            }
            else  if (!emailRegex.test(email.value)) {
                email_error.textContent = "Invalid email format.";
                isValid = false;
            }

            // company name
            if(company_name.value.length == 0){
                company_name_error.textContent = "Company name is required.";
                isValid = false;
                

            }
           else if (company_name.value.length < 3 || company_name.value.length > 50) {
                company_name_error.textContent = "Company name must be between 3 and 50 characters.";
                isValid = false;
            }

            // message 
            if(message.value.length ==0){
                message_error.textContent = "Message is required.";
                isValid = false;
                

            }
            else if (message.value.length < 3 || message.value.length > 250) {
                message_error.textContent = "Message must be between 3 and 250 characters.";
                isValid = false;
            }
        // If all validations pass, submit the form
        if (isValid) {
            const formData = new FormData();
            formData.append("name", name.value.trim());
            formData.append("email", email.value.trim());
            formData.append("company_name", company_name.value.trim());
            formData.append("phone_no", phone_no.value.trim());
            formData.append("message", message.value.trim());

            fetch("php/add_feedback.php", {
                method: "POST",
                body: formData,
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                if (data.success) {
                  Swal.fire({
                icon: "success",
                title: "Success!",
                text: data.message,
                timer: 2000,  // Auto-close after 2 seconds
                showConfirmButton: false,  // Hide the OK button
            }).then(() => {
              document.getElementById("myForm").reset(); // Reset form after successful submission
                window.location.href = "dashboard.php"; // Redirect after alert closes
            });

                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: data.message || "Failed to send message.",
                        showConfirmButton: false,  // Hide the OK button

                    });
                }
            })
            .catch((error) => {
                console.error("Fetch Error:", error);
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "An error occurred. Please try again later.",
                    showConfirmButton: false,  // Hide the OK button
                  });
            });
        }
    });
});

    </script>
  </body>
</html>