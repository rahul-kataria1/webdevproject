<?php
include('functions.php');
require('reusable/conn.php');
secure_page();

// Step 1: Get user details by ID
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $result = mysqli_query($connect, "SELECT * FROM users WHERE id = $id");
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        set_message("User not found!", "danger");
        header("Location: users.php");
        exit;
    }
}

// Step 2: Handle form submission
if (isset($_POST['updateUser'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Optional password update
    $password = $_POST['password'];
    $password_sql = "";
    if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $password_sql = ", password='$hashed'";
    }

    // Image upload handling
    $image_sql = "";
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetDir . $fileName);
        $image_sql = ", image='$fileName'";
    }

    // Update query
    $query = "UPDATE users SET 
                name='$name', 
                email='$email' 
                $password_sql 
                $image_sql
              WHERE id=$id";

    if (mysqli_query($connect, $query)) {
        set_message("User updated successfully!", "success");
        header("Location: users.php");
        exit;
    } else {
        set_message("Error: " . mysqli_error($connect), "danger");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include('reusable/nav.php'); ?>
  <div class="container mt-5">
    <h2>Edit User</h2>
    <?php get_message(); ?>

    <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $user['id'] ?>">

      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password (leave blank to keep current)</label>
        <input type="password" name="password" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Profile Image</label><br>
        <?php if(!empty($user['image'])): ?>
          <img src="uploads/<?= htmlspecialchars($user['image']) ?>" width="80" class="mb-2"><br>
        <?php endif; ?>
        <input type="file" name="image" class="form-control">
      </div>

      <button type="submit" name="updateUser" class="btn btn-primary">Update User</button>
      <a href="users.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</body>
</html>
