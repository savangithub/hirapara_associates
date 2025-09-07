<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
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
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="card-title">Client Details</h4>
                                        <a href="add_feedback.php" class="btn btn-primary btn-rounded btn-fw">Add Client</a>
                                    </div>

                                    <!-- Search Input -->
                                    <div class="mb-3">
                                        <input type="text" id="search" class="form-control" placeholder="Search by Name or Company Name...">
                                    </div>

                                    <!-- Table Data -->
                                    <div id="feedback-data"></div>

                                    <!-- Pagination -->
                                    <div class="pagination mt-3 text-center">
                                        <ul class="pagination justify-content-center" id="pagination-links"></ul>
                                    </div>

                                </div> <!-- card-body -->
                            </div> <!-- card -->
                        </div> <!-- col-lg-12 -->
                    </div> <!-- row -->
                </div> <!-- content-wrapper -->
            </div> <!-- main-panel -->
        </div> <!-- container-fluid -->
    </div> <!-- container-scroller -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function loadFeedback(page = 1, query = "") {
            $.ajax({
                url: "php/fetch_feedback.php",
                type: "GET",
                data: { page: page, search: query },
                success: function (response) {
                    let data = JSON.parse(response);
                    $("#feedback-data").html(data.table);
                    $("#pagination-links").html(data.pagination);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    alert("Error loading data.");
                }
            });
        }

        $(document).ready(function () {
            loadFeedback();

            $(document).on("click", ".page-link", function (e) {
                e.preventDefault();
                let page = $(this).data("page");
                let query = $("#search").val();
                loadFeedback(page, query);
            });

            $("#search").on("keyup", function () {
                let query = $(this).val();
                loadFeedback(1, query);
            });
        });



    </script>
    

    <script>
document.addEventListener("DOMContentLoaded", function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = new URL(this.href);
            const id = url.searchParams.get("id");
            const rowElement = this.closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete the feedback.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('delete_feedback.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id: id })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Deleted!', data.message, 'success');
                            rowElement.remove(); // Dynamically remove row
                        } else {
                            Swal.fire('Error!', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                        console.error('Error:', error);
                    });
                }
            });
        });
    });
});
</script>

</body>
</html>
