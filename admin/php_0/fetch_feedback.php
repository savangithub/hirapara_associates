<?php
include_once('../../config.php');

$limit = 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : "";

$offset = ($page - 1) * $limit;

$where = "";
if (!empty($search)) {
    $search_escaped = $conn->real_escape_string($search);
    $where = "WHERE name LIKE '%$search_escaped%' OR company_name LIKE '%$search_escaped%'";
}

// Get Total Records
$totalSql = "SELECT COUNT(*) AS total FROM feedback $where";
$totalResult = $conn->query($totalSql);
$totalRow = $totalResult->fetch_assoc();
$totalRecords = $totalRow['total'];
$totalPages = ceil($totalRecords / $limit);

// Fetch Data
$sql = "SELECT * FROM feedback $where ORDER BY id DESC LIMIT $offset, $limit";
$result = $conn->query($sql);

// Build Table
$output = '<table class="table table-bordered">
<thead class="table-dark">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Company Name</th>
        <th>Email Address</th>
        <th>Phone Number</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $output .= '<tr>
            <td>' . $row['id'] . '</td>
            <td>' . htmlspecialchars($row['name']) . '</td>
            <td>' . htmlspecialchars($row['company_name']) . '</td>
            <td>' . htmlspecialchars($row['email']) . '</td>
            <td>' . htmlspecialchars($row['mobile']) . '</td>
            <td>
                <a href="edit_feedback.php?id=' . $row['id'] . '" class="fa fa-pencil action-icon"></a>
                <a href="view_feedback.php?id='. $row['id'] .'" class="fa fa-eye action-icon"></a>
                <a href="delete_feedback.php?id='. $row['id'] .'" class="fa fa-trash action-icon"></a>


            </td>
        </tr>';
    }
} else {
    $output .= '<tr><td colspan="6" class="text-center">No records found.</td></tr>';
}
$output .= '</tbody></table>';

// Pagination links
$pagination = '';
if ($totalPages > 1) {
    for ($i = 1; $i <= $totalPages; $i++) {
        $active = ($i == $page) ? 'active' : '';
        $pagination .= '<li class="page-item ' . $active . '"><a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
    }
}

echo json_encode([
    'table' => $output,
    'pagination' => $pagination
]);
?>
