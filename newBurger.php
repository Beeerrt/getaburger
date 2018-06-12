<?php
    session_start();
    if(!isset($_SESSION['logedIn'])) {
        header('LOCATION:index.php'); die();
    }
?>

<html>
    <head>
    <meta http-equiv='content-type' content='text/html;charset=utf-8' />
     <title>Dashboard</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" type="text/css" href="styles/newBurger/newBurger.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    </head>
    <body>
    <?php
                    if(isset($_POST['submit'])){
                        session_destroy();
                        header('LOCATION:index.php'); 
                        die();
                     }
                     if(isset($_POST['back']))
                     {
                         header('LOCATION:admin.php');
                         die();
                     }
                ?>


    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Rate a Burger  <img  class="logo" src="assets/logo.png"></a>


        <form class="form-inline my-2 my-lg-0" action="" method="post">
            <button type="submit" name="submit" class="btn btn-danger">Logout</button>
        </form>

    </nav>
    <br>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Add Burger Rating</h1>
            </div>
        </div>
                <form action="" method="post">
                    <button type="submit" name="back" class="btn btn-success btn-back">Back</button>
                </form>
    </div>
</body>
</html>