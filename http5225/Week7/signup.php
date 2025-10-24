<?php
include('functions.php');
require('reusable/conn.php');

if (isset($_POST['signup'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);

    // basic validation
    if (empty($name) || empty($email) || empty($password) || empty($confirm)) {
        set_message("All fields are required!", "danger");
    } elseif ($password !== $confirm) {
        set_message("Passwords do not match!", "danger");
    } else {
        // check if email already exists
        $check = mysqli_query($connect, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            set_message("Email already registered!", "warning");
        } else {
            // handle optional image
            $fileName = null;
            if (!empty($_FILES["image"]["name"])) {
                $targetDir = "reusable/uploads/";
                $fileName = basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $targetDir . $fileName);
            }

            // hash password and insert
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO users (name, email, password, image)
                      VALUES ('$name', '$email', '$hashed', '$fileName')";
            if (mysqli_query($connect, $query)) {
                set_message("Account created successfully! Please login.", "success");
                header("Location: login.php");
                exit;
            } else {
                set_message("Error: " . mysqli_error($connect), "danger");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include('reusable/nav.php'); ?>
  <div class="container mt-5">
    <h2>Create Account</h2>
    <?php get_message(); ?>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="confirm" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Profile Image (optional)</label>
        <input type="file" name="image" class="form-control">
      </div>
      <button type="submit" name="signup" class="btn btn-success">Sign Up</button>
      <a href="login.php" class="btn btn-link">Already have an account? Login</a>
    </form>
  </div>
</body>
</html>
