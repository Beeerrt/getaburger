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
     <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
   </head>
<body>
<section class="intro">
        <div class="inner">
            <div class="content">
                <div class="header_reveal">
                <h1 class="header">Rate a Burger</h1>
                </div>
                <div class="login-page">
                <?php
                      

                    if(isset($_POST['login'])){
                             $username = $_POST['username']; $password = $_POST['password'];
                        echo $username;
                        echo $password;
                         
                        $pdo = new PDO('mysql:host=localhost;dbname=burger;charset=utf8', 'root', '');
                        $sql = "SELECT * FROM users Where username='".$username."' and password='".$password."';";
                        $res =  $pdo->query($sql);

                        if ($res->fetchColumn() > 0) {
                            $_SESSION['username'] = $username;
                            $_SESSION['logedIn'] = true; header('LOCATION:admin.php'); die();

                        }
                      else {
                          echo "<div class='alert alert-danger'>Username and Password do not match.</div>";
                        }


                        // if($username === 'admin' && $password === 'password'){
                        //  $_SESSION['logedIn'] = true; header('LOCATION:admin.php'); die();
                        // }
                        // {
                        //  echo "<div class='alert alert-danger'>Username and Password do not match.</div>";
                        // }

                     }
                ?>
                    <div class="form">
                     <form class="login-form" action="" method="post">
                        <input type="text"  id="username" name="username" placeholder="Username"/ autocomplete="off">
                        <input type="password" id="pwd" name="password" placeholder="Password"/ autocomplete="off">
                        <button type="submit" name="login">login</button>
                      </form>
                    </div>
                  </div>
            </div>
        </div>
    </section>

    <script>
        // JavaScript
        window.sr = ScrollReveal();
        sr.reveal('.form',{ duration: 1000 });
        sr.reveal('header_reveal',{ duration:1000}) ;
    </script>
</body>
</html>