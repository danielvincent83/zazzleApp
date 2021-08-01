
<?php
 session_start();

 include("header.php"); 
 
 if ( is_logged_in() ) {
    header('location: orders.php?Status=Accepted');
    die();
  }

  if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    // get their values
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ( validate_user_creds($username, $password) ) {
      $_SESSION['username'] = $username;
      header("Location: orders.php?Status=Accepted");
    } else {
      $status = "Incorrect login credentials.";
    }
    
  }
 ?>



<div class="container">
  <form role='form' action="index.php" method="post">
    <div class='form-group'>
      <label for="username">Username:</label>
      <input type="text" class='form-control'  name="username">
    </div>
    <div class='form-group'>
      <label for="password">Password:</label>
      <input type="password" class='form-control'  name="password">
    </div>
  
    <input type="submit" value="Login" class="btn btn-primary pull-right" name='loginForm'>

    <?php if( isset($status)) : ?>
    <p><?php echo $status; ?></p>
    <?php endif; ?>

  </form>
</div>

  <?php include("footer.php"); ?>

