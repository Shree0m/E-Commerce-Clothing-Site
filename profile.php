<?php
include 'component/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}else{
  $user_id = '';
  header('location:index.php');
};

if(isset($_POST['submit'])){

  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $number = $_POST['number'];
  $number = filter_var($number, FILTER_SANITIZE_STRING);

  if(!empty($name)){
     $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
     $update_name->execute([$name, $user_id]);
  }

  if(!empty($email)){
     $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
     $select_email->execute([$email]);
     if($select_email->rowCount() > 0){
        $message[] = 'email already taken!';
     }else{
        $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
        $update_email->execute([$email, $user_id]);
     }
  }

  if(!empty($number)){
     $select_number = $conn->prepare("SELECT * FROM `users` WHERE number = ?");
     $select_number->execute([$number]);
     if($select_number->rowCount() > 0){
        $message[] = 'number already taken!';
     }else{
        $update_number = $conn->prepare("UPDATE `users` SET number = ? WHERE id = ?");
        $update_number->execute([$number, $user_id]);
     }
  }
  
  $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
  $select_prev_pass = $conn->prepare("SELECT password FROM `users` WHERE id = ?");
  $select_prev_pass->execute([$user_id]);
  $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
  $prev_pass = $fetch_prev_pass['password'];
  $old_pass = sha1($_POST['old_pass']);
  $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
  $new_pass = sha1($_POST['new_pass']);
  $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
  $confirm_pass = sha1($_POST['confirm_pass']);
  $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

  if($old_pass != $empty_pass){
     if($old_pass != $prev_pass){
        $message[] = 'old password not matched!';
     }elseif($new_pass != $confirm_pass){
        $message[] = 'confirm password not matched!';
     }else{
        if($new_pass != $empty_pass){
           $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
           $update_pass->execute([$confirm_pass, $user_id]);
           $message[] = 'password updated successfully!';
        }else{
           $message[] = 'please enter a new password!';
        }
     }
  }  

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="css/style.css">
    <script defer src="script.js"></script>
    <title>Modern Threads</title>

</head>
<body>
    <?php include "component/header.php" ?>

    <section id="header">
        <h2>#Edit Profile</h2>
        <p></p>
    </section>

    <!-- ---------- Edit Profile Form Starts-------------- -->
    
<section>

    <?php
    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_profile->execute([$user_id]);
    if($select_profile->rowCount() > 0){
       $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    ?>

    <div id="snippetContent">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
  <div class="container">
    <div class="row gutters">
      <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
          <div class="card-body">
            <div class="account-settings">
              <div class="user-profile">
                <div class="user-avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Maxwell Admin">
                </div>
                <h5 class="user-name"><?= $fetch_profile['name']; ?></h5>
                <h6 class="user-email"><?= $fetch_profile['email']; ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
          <div class="card-body">
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h6 class="mb-2 text-primary">Personal Details</h6>
              </div>


          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <form action="" method="post">
                <div class="form-group">
                  <label for="fullName">User Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter user name">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="eMail">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email ID">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="number" name="number" placeholder="Enter phone number">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="old_pass">Old Password</label>
                  <input type="text" class="form-control" id="old_pass" name="old_pass" placeholder="Enter old password">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="new_pass">New Password</label>
                  <input type="text" class="form-control" id="new_pass" name="new_pass" placeholder="Enter new password">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="confirm_pass">Confirm New Password</label>
                  <input type="text" class="form-control" id="confirm_pass" name="confirm_pass" placeholder="Confirm new password">
                </div>
              </div>
            </div>
            <?php }?>

            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="text-right">
                  <input type="submit" id="submit" name="submit" value="Update" class="btn btn-primary">
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<style type="text/css">

.h3, h3 {
     font-size: 1.17rem;
}

div#snippetContent {
    border-style: groove;
    margin: 20px;
}

input#submit {
    width: auto;
    height: auto;
    position: relative;
}

h5.user-name {
    color: #010101;
    display: contents;
}

.account-settings .user-profile {
    margin: 0 0 1rem 0;
    padding-bottom: 1rem;
    text-align: center;
}

li a:hover{
    color: #088178;
    text-decoration: none;
}

a:hover {
    color: #0056b3;
    text-decoration: none;
}

.account-settings .user-profile .user-avatar {
    margin: 0 0 1rem 0;
}
.account-settings .user-profile .user-avatar img {
    width: 90px;
    height: 90px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
}
.account-settings .user-profile h5.user-name {
    margin: 0 0 0.5rem 0;
}
.account-settings .user-profile h6.user-email {
    margin: 0;
    font-size: 0.8rem;
    font-weight: 400;
    color: #9fa8b9;
}
.account-settings .about {
    margin: 2rem 0 0 0;
    text-align: center;
}
.account-settings .about h5 {
    margin: 0 0 15px 0;
    color: #007ae1;
}
.account-settings .about p {
    font-size: 0.825rem;
}
.form-control {
    border: 1px solid #cfd1d8;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    font-size: .825rem;
    background: #ffffff;
    color: #2e323c;
}

.card {
    background: #ffffff;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 0;
    margin-bottom: 1rem;
}
</style>

</section>

    <!-- ---------- Edit Profile Form Ends -------------- -->


    <section id="newsLetter">
        <div>
            <h2>Sign Up For Newsletter</h2>
            <h5>Get E-mail updates about our latest shop and <span> special offers</span></h5>
        </div>
        <div class="signUpinput">
            <input placeholder="Your email address" type="email" name="user" id="signUp">
            <button class="normal">Sign Up</button>
        </div>
    </section>


    <?php include "component/footer.php" ?>
</body>
</html>
