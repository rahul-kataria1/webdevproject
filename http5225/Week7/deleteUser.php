<?php
include('functions.php');
require('reusable/conn.php');
secure_page();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch user first (to get image name for deletion)
    $result = mysqli_query($connect, "SELECT * FROM users WHERE id = $id");
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Optional: delete image file
        if (!empty($user['image'])) {
            $filePath = "uploads/" . $user['image'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Delete user record
        $query = "DELETE FROM users WHERE id = $id";
        if (mysqli_query($connect, $query)) {
            set_message("User deleted successfully!", "danger");
        } else {
            set_message("Error deleting user: " . mysqli_error($connect), "danger");
        }
    } else {
        set_message("User not found!", "warning");
    }

    header("Location: users.php");
    exit;
} else {
    set_message("Invalid request!", "warning");
    header("Location: users.php");
    exit;
}
?>
