<?php

include("db.php");

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM task WHERE id = $id";

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    // echo 'yo can edit';
    $row = mysqli_fetch_array($result);
    $title = $row['title'];
    $description = $row['description'];
  }

}

if(isset($_POST['update'])) {
  // echo "updating";
  $id = $_GET['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];

  $query = "UPDATE task SET title = '$title', description = '$description' WHERE id = $id";


  mysqli_query($conn, $query);

  $_SESSION['message'] = "Task updated successfully";
  $_SESSION['message_type'] = "warning";

  header("Location: index.php");
}

?>

<?php include("includes/header.php"); ?>

<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form action="edit.php?id=<?= $_GET['id'] ?>" method="POST">
          <div class="form-group mt-3">
            <input type="text" name="title" value="<?= $title; ?>" class="form-control" placeholder="Update title">
          </div>
          <div class="form-group mt-3">
            <textarea name="description" rows="2" class="form-control" placeholder="Update description"><?= $description; ?>
            </textarea>
          </div>

          <div class="d-grid gap-2 mt-3">
            <button class="btn btn-success" name="update">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include("includes/footer.php"); ?>
