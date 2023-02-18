<?php 
  include_once "common/header.php";
  include_once "config/database.php";
  include_once "classes/User.php";

?>
<div class="container">
  <h1 class="py-5 text-center">Web Development Task-2</h1>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>User List
            <a href="hobby.php" class="btn btn-secondary float-end">Hobby</a>
            <a href="user-create.php" class="btn btn-primary float-end me-2">Create User</a>
          </h4>
        </div>
        <div class="card-body">
          <?php if(isset($_GET['Usercreate'])) : ?>
            <div class="alert alert-success">Created Success!</div>
          <?php endif;?>

          <?php if(isset($_GET['Useredit'])) : ?>
            <div class="alert alert-success">Edited Success!</div>
          <?php endif;?>

          <?php if(isset($_GET['Userdelete'])) : ?>
            <div class="alert alert-success">Deleted Success!</div>
          <?php endif; ?>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Hobby</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $db = new Database();
              $connection = $db->connect();
              $user = new User($connection);
              $res = $user->get_all_userhobby();              
              if(!empty($res)){
                foreach ($res as $value) {
            ?>
            <tr>
              <td><?= $value['id']?></td>
              <td><?= $value['name']?></td>
              <td><?= $value['phone']?></td>
              <td><?= $value['gender']?></td>
              <td><?= $value['hobbies']?></td>
              <td>
                <a href="user-edit.php?id=<?= $value['id'];?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="user-delete.php?id=<?= $value['id'];?>" class="btn btn-sm btn-danger"
                onclick="return confirm('Are you sure you want to delete?')">Delete</a>
              </td>
            </tr>              
            <?php
                }
              }else{
            ?>
            <tr>
              <td colspan="6" class="text-center">
                No Data Available Yet!
              </td>
            </tr>
            <?php
              }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once "common/footer.php";?>