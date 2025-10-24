<?php
include('functions.php');
require('reusable/conn.php');
secure_page();

if (isset($_POST['addUser'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = hash_pass($_POST['password']);

    // image upload
    $targetDir = "webdevproject/http5225/week7/uploads/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);

    $query = "INSERT INTO users (name, email, password, image)
              VALUES ('$name', '$email', '$password', '$fileName')";
    if (mysqli_query($connect, $query)) {
        set_message("User added successfully!", "success");
        header("Location: users.php");
        exit;
    } else {
        set_message("Error: " . mysqli_error($connect), "danger");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('reusable/nav.php'); ?>
<div class="container mt-5">
  <h2>Add New User</h2>
  <?php get_message(); ?>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Profile Image</label>
      <input type="file" name="image" class="form-control">
    </div>
    <button type="submit" name="addUser" class="btn btn-success">Add User</button>
  </form>
</div>
</body>
</html>
