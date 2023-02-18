<?php 
  include_once "common/header.php";
  include_once "config/database.php";
  include_once "classes/Hobby.php";
?>
<?php
  $db = new Database();
  $connection = $db->connect();

  $hobby = new Hobby($connection);

    if(isset($_POST['createHobby'])){
      if (empty($_POST['hobbyName'])) {
        $nameErr = "Name Field Required!";
      }else if(!preg_match("/^[A-Za-z ]*$/",$_POST['hobbyName'])) {
        $nameErr = "Only letters and space allowed!";
      }
      else {            
        $hobby->name = $_POST['hobbyName'];   
        if ($hobby->create_hobby()) {
          header('location:hobby.php?Hobbycreate=success');
        } else {
          header('location:hobby-create.php?error=1');
        }               
      }
    }
?>
<div class="container">
  <h1 class="py-5 text-center">Web Development Task-2</h1>

  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header">
          <h4>Create Hobby List
            <a href="hobby.php" class="btn btn-primary float-end">Back</a>
          </h4>
        </div>
        <div class="card-body">
        <form action="hobby-create.php" method="post">
            <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger">Failed to Create Hobby</div>
            <?php endif; ?>
            <div class="form-group mb-4">
                <label for="hobbyName">Name</label>
                <p style="color:red"><?php echo empty($nameErr) ? '' : '*'.$nameErr; ?></p>
                <input type="text" class="form-control" name="hobbyName" id="hobbyName">
            </div>
            <hr>
            <div class="form-group">
              <input type="submit" class="btn btn-success" name="createHobby" value="SUBMIT">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once "common/footer.php";?>