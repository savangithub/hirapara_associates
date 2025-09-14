<?php
include('../admin/layout_admin/header.php');
include_once('./config.php');
session_start();
print_r('code');
die();
// Validate and fetch ID securely
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $id = intval($_GET['id']);

    // Fetch data securely
    $stmt = $conn->prepare("SELECT * FROM feedback WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Feedback not found!");
    }
}
?>

<body class="with-welcome-text">
    <div class="container-scroller">
        <?php include('../admin/layout_admin/topbar.php'); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include('../admin/layout_admin/sidebar.php'); ?>
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title">Edit Client Feedback</h4>
                                    <a href="../admin/dashboard.php" class="btn btn-primary btn-rounded btn-fw">Back</a>
                                </div>

                                <!-- Correct ID -->
                                <form id="myForm" class="forms-sample material-form">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                    <div class="form-group">
                                        <input type="text" name="name" id="name"
                                            value="<?php echo htmlspecialchars($row['name']); ?>" minlength="3"
                                            maxlength="50" />
                                        <label class="control-label">Full Name</label><i class="bar"></i>
                                        <small id="name_error" style="color: red"></small>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="company_name" id="company_name"
                                            value="<?php echo htmlspecialchars($row['company_name']); ?>" minlength="3"
                                            maxlength="50" />
                                        <label class="control-label">Company Name</label><i class="bar"></i>
                                        <small id="company_name_error" style="color: red"></small>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="email" id="email"
                                            value="<?php echo htmlspecialchars($row['email']); ?>" minlength="3"
                                            maxlength="50" />
                                        <label class="control-label">Email Address</label><i class="bar"></i>
                                        <small id="email_error" style="color: red"></small>
                                    </div>

                                    <!-- <div class="form-group">
                                        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($row['email']); ?>"  />
                                        <label class="control-label">Email Address</label><i class="bar"></i>
                                        <small id="email_error" style="color: red"></small>
                                    </div> -->

                                    <div class="form-group">
                                        <input type="text" name="phone" id="phone"
                                            value="<?php echo htmlspecialchars($row['mobile']); ?>"
                                            pattern="\d{10,15}" />
                                        <label class="control-label">Phone Number</label><i class="bar"></i>
                                        <small id="phone_error" style="color: red"></small>
                                    </div>

                                    <div class="form-group">
                                        <textarea name="message"
                                            id="message"><?php echo htmlspecialchars($row['msg']); ?></textarea>
                                        <label class="control-label">Message</label><i class="bar"></i>
                                        <small id="message_error" style="color: red"></small>
                                    </div>

                                    <div class="button-container">
                                        <button type="submit" id="submitBtn" class="button btn btn-primary">
                                            <span>Submit</span>
                                        </button>
                                    </div>
                                </form>

                                <div id="feedbackResponse"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("myForm").addEventListener("submit", function (event) {
                event.preventDefault();
                let isValid = true;

                // Get form fields
                const name = document.getElementById("name");
                const email = document.getElementById("email");
                const phone = document.getElementById("phone");
                const company_name = document.getElementById("company_name");
                const message = document.getElementById("message");

                // Get error spans
                const name_error = document.getElementById("name_error");
                const email_error = document.getElementById("email_error");
                const phone_error = document.getElementById("phone_error");
                const company_name_error = document.getElementById("company_name_error");
                const message_error = document.getElementById("message_error");

                // Trim values before validating
                name.value = name.value.trim();
                email.value = email.value.trim();
                phone.value = phone.value.trim();
                company_name.value = company_name.value.trim();
                message.value = message.value.trim();

                // Reset errors
                name_error.textContent = "";
                email_error.textContent = "";
                phone_error.textContent = "";
                company_name_error.textContent = "";
                message_error.textContent = "";
                // Validation
                // name
                if (name.value.length == 0) {
                    name_error.textContent = "Name is required.";
                    isValid = false;
                }
                else if (name.value.length < 3 || name.value.length > 50) {
                    name_error.textContent = "Name must be between 3 and 50 characters.";
                    isValid = false;
                }

                // Phone
                const phoneRegex = /^\d{10,15}$/;
                if (phone.value == 0) {
                    phone_error.textContent = "Phone number is required.";
                    isValid = false;
                }
                else if (!phoneRegex.test(phone.value)) {
                    phone_error.textContent = "Phone number must be between 10 and 15 digits.";
                    isValid = false;
                }

                // Email
                const emailRegex = /\S+@\S+\.\S+/;
                if (email.value == 0) {
                    email_error.textContent = "Email is required.";
                    isValid = false;
                }
                else if (!emailRegex.test(email.value)) {
                    email_error.textContent = "Invalid email format.";
                    isValid = false;
                }

                // company name
                if (company_name.value.length == 0) {
                    company_name_error.textContent = "Company name is required.";
                    isValid = false;


                }
                else if (company_name.value.length < 3 || company_name.value.length > 50) {
                    company_name_error.textContent = "Company name must be between 3 and 50 characters.";
                    isValid = false;
                }

                // message 
                if (message.value.length == 0) {
                    message_error.textContent = "Message is required.";
                    isValid = false;


                }
                else if (message.value.length < 3 || message.value.length > 250) {
                    message_error.textContent = "Message must be between 3 and 250 characters.";
                    isValid = false;
                }

                // Submit if valid
                if (isValid) {
                    const formData = new FormData();
                    formData.append("id", <?php echo $row['id']; ?>);
                    formData.append("name", name.value.trim());
                    formData.append("email", email.value.trim());
                    formData.append("company_name", company_name.value.trim());
                    formData.append("phone", phone.value.trim());
                    formData.append("message", message.value.trim());

                    fetch("php/edit_feedback.php", {
                        method: "POST",
                        body: formData,
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success!",
                                    text: data.message,
                                    timer: 2000,
                                    showConfirmButton: false,
                                }).then(() => {
                                    document.getElementById("myForm").reset();
                                    window.location.href = "dashboard.php";
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error!",
                                    text: data.message || "Failed to update feedback.",
                                    showConfirmButton: false,
                                });
                            }
                        })
                        .catch(error => {
                            console.error("Fetch Error:", error);
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: "An error occurred. Please try again later.",
                                showConfirmButton: false,
                            });
                        });
                }
            });
        });
    </script>
</body>

</html>