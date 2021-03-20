<?php
session_start();

if(isset($_SESSION['username']))
{
    header("location: homepage.html");
    exit;
}


require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


  if(empty($err))
  {
      $sql = "SELECT id, username, password FROM users WHERE username = ?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "s", $param_username);
      $param_username = $username;


      // Try to execute this statement
      if(mysqli_stmt_execute($stmt))
      {
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
          {
            mysqli_stmt_bind_result($stmt, $id, $username, $password);
            if(mysqli_stmt_fetch($stmt))
            {

              // this means the password is corrct. Allow user to login
              session_start();
              $_SESSION["username"] = $username;
              $_SESSION["id"] = $id;
              $_SESSION["loggedin"] = true;

              //Redirect user to welcome page
              header("location: homepage.html");


            }

          }
          else{
            echo '<script>alert("Username or Password is Incorrect. Please try again.")</script>';
          }
        

      }
    
  }


}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv = "X-UA-Compatible" content= "ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- main css -->
    <link rel ="stylesheet" href = "./homepage.css">
    <link rel ="stylesheet" href = "./navBar.css">

    <!-- font awesome css -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- css for google font -->
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    
    <title>Welcome to Jeevan!</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

   

</head>
<body style="background-image: url(imgNew/phpimg.jpg)">

  <!-- The navigation panel -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom " >
    <a class="navbar-brand" href="./AboutJeevan.html">
      <div id="logo">
          <img src="./imgNew/logo1.png" alt="Not found">
      </div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <!-- <a class="nav-item nav-link active" href="./homepage.html" >Home <span class="sr-only">(current)</span></a> -->
        <!-- <a class="nav-item nav-link" href="./pharmacy.html">Pharmacy</a>
        <a class="nav-item nav-link" href="./bmi.html">BMI Calculator</a> -->
        <a class="nav-item nav-link " href="./register.php">Register<span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link active" href="login.php">Login</a>
        <a class="nav-item nav-link" href="./AboutJeevan.html">About&nbspJeevan</a>
        <!-- <a class="nav-item nav-link" href="./ContactUs.html">Contact&Us</a> -->
        
        
        <a href = "./logout.php" class="nav-item nav-link logout" > &nbsp&nbsp&nbspLOGOUT <i class="fa fa-sign-out"></i></a>
      </div>
    </div>
  </nav>


  <div class="container mt-4">
  <h3 class="modify1">Login Here:</h3>
  <hr>

  <form action="" method="post">
    <div class="form-group">
      <label class="modify1" for="exampleInputEmail1">Username</label>
      <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username" required>
    </div>
    <div class="form-group">
      <label class="modify" for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" required>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-success btn-lg" style="margin-top:20px">Login</button>
    </div>
  </form>



  </div>
</body>
</html>
