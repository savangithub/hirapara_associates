<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include('../config.php');

if (!isset($_GET['id'])) {
    die("Invalid Request!");
}

$id = intval($_GET['id']);

// Fetch user data
$stmt = $conn->prepare("SELECT * FROM feedback WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("No record found!");
}

$data = $result->fetch_assoc();

include('../admin/layout_admin/header.php');
?>
<body class="with-welcome-text">
    <div class="container-scroller">
        <?php include('../admin/layout_admin/topbar.php'); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include('../admin/layout_admin/sidebar.php'); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 mx-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Back button at the top right -->
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4 class="card-title mb-0">Client Details</h4>
                                        <a href="javascript:history.back()" class="btn btn-primary btn-rounded btn-fw">Back</a>
                                    </div>

                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <td><?php echo htmlspecialchars($data['name']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Company Name</th>
                                            <td><?php echo htmlspecialchars($data['company_name']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><?php echo htmlspecialchars($data['email']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone Number</th>
                                            <td><?php echo htmlspecialchars($data['mobile']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Message</th>
                                            <td><?php echo nl2br(htmlspecialchars($data['msg'])); ?></td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- content-wrapper -->
            </div>
        </div>
    </div>
</body>
</html>
