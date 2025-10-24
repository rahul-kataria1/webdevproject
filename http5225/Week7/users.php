<?php
include('functions.php');
require('reusable/conn.php');
secure_page();

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($connect, "DELETE FROM users WHERE id=$id");
    set_message("User deleted!", "danger");
    header("Location: users.php");
    exit;
}

$users = mysqli_query($connect, "SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Users</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('reusable/nav.php'); ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h2>All Users</h2>
        <a href="addUser.php" class="btn btn-success">+ Add User</a>
    </div>
  <?php get_message(); ?>
  <table class="table table-bordered">
    <tr>
      <th>ID</th><th>Name</th><th>Email</th><th>Image</th><th>Action</th>
    </tr>
    <?php while($u = mysqli_fetch_assoc($users)): ?>
      <tr>
        <td><?= $u['id'] ?></td>
        <td><?= htmlspecialchars($u['name']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
        <td>
          <?php if($u['image']): ?>
            <img src="uploads/<?= $u['image'] ?>" width="60">
          <?php endif; ?>
        </td>
        <td>
          <a href="editUser.php?edit=<?= $u['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
          <a href="deleteUser.php?id=<?= $u['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>
</body>
</html>
