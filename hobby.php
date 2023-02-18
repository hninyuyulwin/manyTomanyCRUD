<?php 
  include_once "common/header.php";
  include_once "config/database.php";
  include_once "classes/Hobby.php";
?>

<div class="container">
  <h1 class="py-5 text-center">Web Development Task-2</h1>

  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header">
          <h4>Hobby List
            <a href="hobby-create.php" class="btn btn-primary float-end">Create Hobby</a>
          </h4>
        </div>
        <div class="card-body">

          <?php if(isset($_GET['Hobbycreate'])) : ?>
            <div class="alert alert-success">Created Success!</div>
          <?php endif;?>

          <?php if(isset($_GET['Hobbyedit'])) : ?>
            <div class="alert alert-success">Edited Success!</div>
          <?php endif;?>

          <?php if(isset($_GET['Hobbydelete'])) : ?>
            <div class="alert alert-success">Deleted Success!</div>
          <?php endif; ?>

          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $db = new Database();
              $connection = $db->connect();
              $hobby = new Hobby($connection);
              $result = $hobby->get_all_data();
              if(!empty($result)){
                  foreach($result as $value) {
            ?>
                <tr>
                  <td><?= $value['id'];?></td>
                  <td><?= $value['name'];?></td>
                  <td>
                    <a href="hobby-edit.php?id=<?= $value['id'];?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="hobby-delete.php?id=<?php echo $value['id']?>" class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure you want to delete this item')">Delete</a>
                  </td>
                </tr>              
            <?php
                }
              }else{
            ?>
                <tr>
                  <td colspan="3" class="text-center">
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