<?php
include('functions.php');
require('reusable/conn.php');
secure_page();

if (isset($_POST['addSchool'])) {
    $boardName = $_POST['boardName'];
    $schoolNumber = $_POST['schoolNumber'];
    $schoolName = $_POST['schoolName'];
    $schoolLevel = $_POST['schoolLevel'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $query = "INSERT INTO schools (`Board Name`, `School Number`, `School Name`, `School Level`, `City`, `Province`, `Email`, `Phone`)
              VALUES ('$boardName', '$schoolNumber', '$schoolName', '$schoolLevel', '$city', '$province', '$email', '$phone')";

    if (mysqli_query($connect, $query)) {
        set_message('School added successfully!', 'success');
        header("Location: index.php");
        exit;
    } else {
        set_message('Error: '.mysqli_error($connect), 'danger');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add School</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include('reusable/nav.php'); ?>

  <div class="container mt-5">
    <h1 class="mb-4">Add a New School</h1>
    <?php get_message(); ?>

    <form method="POST">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Board Name</label>
          <input type="text" name="boardName" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">School Number</label>
          <input type="text" name="schoolNumber" class="form-control">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">School Name</label>
        <input type="text" name="schoolName" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">School Level</label>
        <input type="text" name="schoolLevel" class="form-control">
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">City</label>
          <input type="text" name="city" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Province</label>
          <input type="text" name="province" class="form-control">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control">
        </div>
      </div>

      <button type="submit" name="addSchool" class="btn btn-success">Add School</button>
    </form>
  </div>
</body>
</html>
