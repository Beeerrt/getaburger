<?php
    session_start();
    echo isset($_SESSION['login']);
    if(isset($_SESSION['login'])) {
      header('LOCATION:index.php'); die();
    }
?>
<!DOCTYPE html>
<html>
   <head>
     <meta http-equiv='content-type' content='text/html;charset=utf-8' />
     <title>Login</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" type="image/x-icon" href="assets/logo.ico">
     <link rel="stylesheet" type="text/css" href="styles/main.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   </head>
<body>
<section class="intro">
        <div class="inner">
            <div class="content">
                <h1 class="header">Rate a Burger</h1>
                <div class="login-page">
                <?php
                    if(isset($_POST['submit'])){
                             $username = $_POST['username']; $password = $_POST['password'];
                        if($username === 'admin' && $password === 'password'){
                         $_SESSION['logedIn'] = true; header('LOCATION:admin.php'); die();
                        }
                        {
                         echo "<div class='alert alert-danger'>Username and Password do not match.</div>";
                        }

                     }
                ?>
                    <div class="form">
                     <form class="login-form" action="" method="post">
                        <input type="text"  id="username" name="username" placeholder="Username"/>
                        <input type="password" id="pwd" name="password" placeholder="Password"/>
                        <button type="submit" name="submit">login</button>
                      </form>
                    </div>
                  </div>
            </div>
        </div>
    </section>
</body>
</html>