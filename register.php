<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST")
{

  if(empty(trim($_POST["username"])))
  {
    $username_err = "Username cannot be blank";
  }
  else
  {
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if($stmt)
    {
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      $param_username = trim($_POST['username']);

      if(mysqli_stmt_execute($stmt))
      {
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) == 1)
          {
              $username_err = "This username is already taken"; 
          }
          else{
              $username = trim($_POST['username']);
          }
      }
      else{
          echo "Something went wrong";
      }
    }
  }

  mysqli_stmt_close($stmt);


  if(empty(trim($_POST['password']))){
      $password_err = "Password cannot be blank";
  }
  elseif(strlen(trim($_POST['password'])) < 5){
      $password_err = "Password cannot be less than 5 characters";
  }
  else{
      $password = trim($_POST['password']);
  }

  if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
      $password_err = "Passwords should match";
  }


  if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
  {
      $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
      $stmt = mysqli_prepare($conn, $sql);
      if ($stmt)
      {
          mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

          $param_username = $username;
          $param_password = $password;

          if (mysqli_stmt_execute($stmt))
          {
              header("location: login.php");
          }
          else{
              echo "Something went wrong... cannot redirect!";
          }
      }
      mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
}

?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">



    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <title>Welcome to Jeevan!</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel ="stylesheet" href = "homepage.css">
    <link rel ="stylesheet" href = "navBar.css">

  </head>
  <body style="background-image: url(imgNew/phpimg.jpg)">

  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom " >
    <a class="navbar-brand" href="./AboutJeevan.html">
      <div id="logo">
          <img src="./imgNew/logo1.png" alt="Jeevan">
      </div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">

        <a class="nav-item nav-link active" href="./register.php">Register<span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link" href="./login.php">Login</a>
        <a class="nav-item nav-link" href="./AboutJeevan.html">About Jeevan</a>
        
        
        <a href = "./logout.php" class="nav-item nav-link logout" > &nbspLOGOUT <i class="fa fa-sign-out"></i></a>
      </div>
    </div>
  </nav>


  <div class="container mt-4">
  <h3 class="modify">Register Here:</h3>
  <hr>
  <form action="" method="post">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4" class="modify">Username</label>
        <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="Username" required>
      </div>
      <div class="form-group col-md-6">
        <label for="inputPassword4" class="modify">Password</label>
        <input type="password" class="form-control" name ="password" id="inputPassword4" placeholder="Password" required>
      </div>
    </div>
    <div class="form-group">
        <label for="inputPassword4" class="modify">Confirm Password</label>
        <input type="password" class="form-control" name ="confirm_password" id="inputPassword" placeholder="Confirm Password" required>
      </div>
    <div class="form-group">
      <label for="inputAddress2" class="modify">Address</label>
      <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputCity" class="modify">City</label>
        <input type="text" class="form-control" id="inputCity">
      </div>
      <div class="form-group col-md-4">
        <label for="inputState" class="modify">State</label>
        <select id="inputState" class="form-control">
          <option selected>Choose...</option>
          <option>...</option>
        </select>
      </div>
      <div class="form-group col-md-2">
        <label for="inputZip" class="modify">Zip</label>
        <input type="text" class="form-control" id="inputZip">
      </div>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-success btn-lg" style="margin-top:20px">Register</button>
    </div>
  </form>
  </div>
  </body>
</html>
