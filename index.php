<?php include("db.php") ?>

<?php include("./includes/header.php"); ?>

<!-- <h1>Hello world</h1> -->

<div class="container p-4">
  <div class="row">
    <div class="col-md-4">

      <?php if (isset($_SESSION['message'])) { ?>

        <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
          <?= $_SESSION['message'] ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

      <?php session_unset();
      } ?>

      <div class="card card-body">
        <form action="./save_task.php" method="POST">
          <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Task title" autofocus>
          </div>
          <div class="form-group">
            <textarea name="description" rows="2" class="form-control mt-3" placeholder="Task description"></textarea>
          </div>
          <div class="d-grid gap-2">
            <input type="submit" class="btn btn-success mt-3" name="save_task" value="Save Task">
          </div>
        </form>
      </div>
    </div>

    <div class="col-md-8">
      <thead>
        <table class="table table-bordered">
          <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Actions</th>
          </tr>
      </thead>
      <tbody>
        <!-- Consulta de datos (get) -->
        <?php
        $query = "SELECT * FROM task";
        $result_tasks = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['title'] ?></td>
            <td><?php echo $row['description'] ?></td>
            <td><?php echo $row['created_at'] ?></td>
            <td> <!-- Acciones de actualizar y eliminar datos -->
              <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="delete_task.php?id=<?= $row['id'] ?>" class="btn btn-danger">
                <i class="fas fa-trash-alt"></i>
              </a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
      </table>
    </div>

  </div>
</div>

<?php include("./includes/footer.php"); ?>
