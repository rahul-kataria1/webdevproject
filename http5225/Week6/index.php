<?php
include('functions.php');
require('reusable/conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Schools</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include('reusable/nav.php'); ?>

  <div class="container mt-5">
    <h1 class="mb-4">All Schools</h1>
    <?php get_message(); ?>

    <?php
      $query = "SELECT * FROM schools";
      $schools = mysqli_query($connect, $query);

      if (mysqli_num_rows($schools) > 0) {
          echo '<div class="row">';
          while ($school = mysqli_fetch_assoc($schools)) {
              echo '<div class="col-md-4 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">'.htmlspecialchars($school['School Name']).'</h5>
                          <p class="card-text">'.htmlspecialchars($school['City']).' | '.htmlspecialchars($school['Province']).'</p>
                          <p><strong>Email:</strong> '.htmlspecialchars($school['Email']).'</p>
                          <p><strong>Phone:</strong> '.htmlspecialchars($school['Phone']).'</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                          <form action="updateSchool.php" method="GET">
                            <input type="hidden" name="id" value="'.$school['id'].'">
                            <button class="btn btn-primary btn-sm">Update</button>
                          </form>
                          <form action="deleteSchool.php" method="GET">
                            <input type="hidden" name="id" value="'.$school['id'].'">
                            <button class="btn btn-danger btn-sm" name="deleteSchool">Delete</button>
                          </form>
                        </div>
                      </div>
                    </div>';
          }
          echo '</div>';
      } else {
          echo '<p>No schools found.</p>';
      }
    ?>
  </div>
</body>
</html>
