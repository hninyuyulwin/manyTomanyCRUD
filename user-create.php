<?php 
ini_set("display_errors", 1);
  include_once "common/header.php";
  include_once "config/database.php";
  include_once "classes/User.php";
  include_once "classes/Hobby.php";
?>
<?php
  $db = new Database();
  $connection = $db->connect();

  $user = new User($connection);
  $hobby = new Hobby($connection);
  $hobbies = $hobby->get_all_data();

  if(isset($_POST['create'])){
    if (empty($_POST['name']) || empty($_POST['phone']) ||empty($_POST['gender']) ||empty($_POST['hobbies'])) {
      if (empty($_POST['name'])) {
        $nameErr = "Name Field Required!";
      }
      if (empty($_POST['phone'])) {
        $phoneErr = "Phone Field Required!";
      }
      if (empty($_POST['gender'])) {
        $genderErr = "Gender Field Required!";
      }
      if (empty($_POST['hobbies'])) {
        $hobbyErr = "Hobbies Field Required!";
      }
    }else if(!preg_match("/^[A-Za-z ]*$/",$_POST['name'])) {
      $nameErr = "Only letters and space allowed!";
    }else if(!preg_match("/^[0-9]{11}$/", $_POST['phone'])){
        $phoneErr = "Please fill valid Phone Numbers";
    }
    else {          
      $user->name = $_POST['name'];
      $user->phone = $_POST['phone'];
      $user->gender = $_POST['gender'];
      if ($user->create_user()) {
        $user_id = $user->last_insertUser;
        $hob = $_POST['hobbies'];
        foreach ($hob as $hobby_id) {
          $hobby->user_id = $user_id;
          $hobby->hobby_id = $hobby_id;
          $hobby->create_userHobby();
        }
        header('location:index.php?Usercreate=success');
      } else {
        header('location:user-create.php?error=1');
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
          <h4>Create User
            <a href="index.php" class="btn btn-secondary float-end">Back</a>
          </h4>
        </div>
        <div class="card-body">
          <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger">Failed to Create User</div>
          <?php endif; ?>
          <form action="user-create.php" method="post">
            <div class="form-group mb-4">
                <label for="name">Name</label>
                <p style="color:red"><?php echo empty($nameErr) ? '' : '*'.$nameErr; ?></p>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group mb-4">
                <label for="phone">Phone</label>
                <p style="color:red"><?php echo empty($phoneErr) ? '' : '*'.$phoneErr; ?></p>
                <input type="number" class="form-control" name="phone" id="phone">
            </div>
            <div class="form-group mb-4">
                <label class="mb-3">Gender</label><br>
                <p style="color:red"><?php echo empty($genderErr) ? '' : '*'.$genderErr; ?></p>
                <input type="radio" name="gender" value="Male" id="male">
                <label for="male" class="me-2">Male</label>
                <input type="radio" name="gender" value="Female" id="female">
                <label for="female">Female</label>
            </div>
            <div class="form-group mb-4">
                <label for="hobby" class="mb-3">Hobbies</label><br>
                <p style="color:red"><?php echo empty($hobbyErr) ? '' : '*'.$hobbyErr; ?></p>
                <?php foreach($hobbies as $hobby) : ?>
                <input type="checkbox" name="hobbies[]" value="<?php echo $hobby['id']?>" id="forhobby<?= $hobby['id'];?>">
                <label for="forhobby<?= $hobby['id'];?>" class="me-2"><?= $hobby['name'];?></label>
                <br>
                <?php endforeach;?>
            </div>
            <hr>
            <div class="form-group">
              <input type="submit" class="btn btn-success" name="create" value="SUBMIT">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once "common/footer.php";?>