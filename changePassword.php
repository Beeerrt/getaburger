<?php
    session_start();
    if(!isset($_SESSION['logedIn'])) {
        header('LOCATION:index.php'); die();
    }
?>

<html>
    <head>
    <meta http-equiv='content-type' content='text/html;charset=utf-8' />
     <title>Change Password</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- <link rel="stylesheet" type="text/css" href="styles/newBurger/newBurger.css"> -->
     <link rel="stylesheet" type="text/css" href="styles/changePassword/changePassword.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
     
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    </head>
    <body>
    <?php
            if(isset($_POST['logout'])){
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
            <button type="submit" name="logout" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>

    </nav>
    <div class="row">
        <div class="col">
    <?php
                $configs = include('config.php');
                    if(isset($_POST['safe'])){
                        //check if password is equal 
                        if($_POST['password1'] == $_POST['password2'])
                        {

                            //check 8 charackter
                            if(strlen($_POST['password1']) > '7')
                            {
                                //safe password
                                $configs = include('config.php');
                                $pdo = new PDO('mysql:host='.$configs['host'].';dbname='.$configs['db'].';charset=utf8', $configs['username'], $configs['password']);
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "Update  users set password='".$_POST['password1']."' Where username='".$_SESSION['username']."'";
                                $pdo->exec($sql);
                           
                           
                                    echo "<div class=\"alert alert-success alert-dismissible fade show\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                                    Password changed successfully <i class=\"fas fa-exclamation-triangle\"></i>
                                    </div>";

                            }
                            else
                            {
                                echo "<div class=\"alert alert-danger alert-dismissible fade show\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                                    Passwords must atleast 8 Characters long <i class=\"fas fa-exclamation-triangle\"></i>
                                    </div>";
                            }
                        }
                        else
                        {
                            
                            echo "<div class=\"alert alert-danger alert-dismissible fade show\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                                    Passwords must be identical <i class=\"fas fa-exclamation-triangle\"></i>
                                    </div>";
                        }

                        // header('LOCATION:admin.php'); 
                     }
    ?>
    </div>
 </div>
    <br>

    <div class="container">
        <form action="" method="post">
        <div class="row">
            <div class="col">
                <h1>Change Password</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm profil">
                <i class="fas fa-user-circle fa-10x"></i>
            </div>
        </div>
        <div class="row">
        
            <div class="col-sm ">
            <div class="form-group">
                <label for="password1">New Password</label>
                <input type="password" class="form-control" name="password1" id="password1" placeholder="new Password" >
                    </div>
            </div>
            <div class="col-sm">
            <div class="form-group">
                <label for="password2">Confirm Password</label>
                <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password" >
            </div>
        </div>
        </div>
            <button type="submit" name="safe" class="btn btn-success btn-safe"><i class="fas fa-save"></i> Safe</button>
            <button type="submit" name="back" class="btn btn-danger btn-back"><i class="fas fa-caret-left"></i> Back</button>
        </form>
    </div>

</body>
</html>