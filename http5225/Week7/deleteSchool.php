<?php
include('functions.php');
require('reusable/conn.php');
secure_page();

if (isset($_GET['deleteSchool']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM schools WHERE id = $id";

    if (mysqli_query($connect, $query)) {
        set_message('🗑️ School deleted successfully!', 'danger');
    } else {
        set_message('Error: ' . mysqli_error($connect), 'danger');
    }
}
header("Location: index.php");
exit;
?>