<?php
include('functions.php');
require('reusable/conn.php');
secure_page();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($connect, "SELECT * FROM schools WHERE id=$id");
    $school = mysqli_fetch_assoc($result);
}

if (isset($_POST['updateSchool'])) {
    $id = intval($_POST['id']);
    $schoolName = $_POST['schoolName'];
    $schoolLevel = $_POST['schoolLevel'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $query = "UPDATE schools 
              SET `School Name`='$schoolName', `School Level`='$schoolLevel', 
                  `City`='$city', `Province`='$province', `Email`='$email', `Phone`='$phone'
              WHERE id=$id";

    if (mysqli_query($connect, $query)) {
        set_message('School updated successfully!', 'success');
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
  <title>Update School</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include('reusable/nav.php'); ?>

  <div class="container mt-5">
    <h1>Update School</h1>
    <?php get_message(); ?>

    <form method="POST">
      <input type="hidden" name="id" value="<?= $school['id'] ?>">
      <div class="mb-3">
        <label class="form-label">School Name</label>
        <input type="text" name="schoolName" class="form-control" value="<?= htmlspecialchars($school['School Name']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">School Level</label>
        <input type="text" name="schoolLevel" class="form-control" value="<?= htmlspecialchars($school['School Level']) ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">City</label>
        <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($school['City']) ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Province</label>
        <input type="text" name="province" class="form-control" value="<?= htmlspecialchars($school['Province']) ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($school['Email']) ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($school['Phone']) ?>">
      </div>
      <button type="submit" name="updateSchool" class="btn btn-primary">Update</button>
    </form>
  </div>
</body>
</html>
