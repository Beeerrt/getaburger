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
                    if(isset($_POST['safe'])){
                        $dataarray = array('restaurant','bewerter','burger','rating','service','anmerkung');
                        //check if all values are selected
                        foreach($dataarray as $parameter)
                        {
                            echo $_POST[$parameter];
                        }
                        
                        
                        $pdo = new PDO('mysql:host=localhost;dbname=burger;charset=utf8', 'root', '');
                        $statement = $pdo->prepare("INSERT INTO rating (restaurant,bewerter,burger,rating,service,anmerkung) VALUES (?, ?, ?,?,?,?)");
                        $statement->execute(array($_POST['restaurant'], $_POST['bewerter'], $_POST['burger'],$_POST['burgerrating'],$_POST['servicerating'],$_POST['anmerkung']));   
                        header('LOCATION:admin.php'); 
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
            <button type="submit" name="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>

    </nav>
    <br>

    <div class="container">
        <form action="" method="post">
        <div class="row">
            <div class="col">
                <h1>Add Burger Rating</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
            <div class="form-group">
                <label for="restaurant">Restaurant</label>
                <input type="text" class="form-control" name="restaurant" id="restaurant" placeholder="Restaurant" >
            </div>
            </div>
            <div class="col-sm">
            <div class="form-group">
                <label  for="bewerter">Bewerter</label>
                <input type="text" class="form-control" name="bewerter" id="bewerter" value="<?php echo $_SESSION['username'];?>" readonly>
            </div>
            </div>
            <div class="col-sm">
            <div class="form-group">
                <label for="burger">Burger</label>
                <input type="text" class="form-control" name="burger" id="burger" placeholder="Burger" >
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
            <div class="form-group">
                <label for="burgerrating">Rating Burger</label>
                <select class="custom-select" name="burgerrating" id="burgerrating" >
                    <option selected>Choose...</option>
                    <option value="0.5">0.5</option>
                    <option value="1.0">1.0</option>
                    <option value="1.5">1.5</option>
                    <option value="2.0">2.0</option>
                    <option value="2.5">2.5</option>
                    <option value="3.0">3.0</option>
                    <option value="3.5">3.5</option>
                    <option value="4.0">4.0</option>
                    <option value="4.5">4.5</option>
                    <option value="5.0">5.0</option>
                </select>
            </div>
            </div>
            <div class="col-sm">
            <div class="form-group">
                <label for="servicerating">Rating Service</label>
                <select class="custom-select" name="servicerating" id="servicerating" >
                    <option selected >Choose...</option>
                    <option value="0.5">0.5</option>
                    <option value="1.0">1.0</option>
                    <option value="1.5">1.5</option>
                    <option value="2.0">2.0</option>
                    <option value="2.5">2.5</option>
                    <option value="3.0">3.0</option>
                    <option value="3.5">3.5</option>
                    <option value="4.0">4.0</option>
                    <option value="4.5">4.5</option>
                    <option value="5.0">5.0</option>
                </select>
            </div>

            </div>
        </div>
        <div class="row">
        <div class="col">
            <label for="anmerkung">Anmerkung</label>
            <textarea class="form-control" name="anmerkung" id="anmerkung" rows="3"></textarea>
        </div>
        </div>
        
                    <button type="submit" name="safe" class="btn btn-success btn-safe"><i class="fas fa-save"></i> Safe</button>
                    <button type="submit" name="back" class="btn btn-danger btn-back"><i class="fas fa-caret-left"></i> Back</button>
                </form>
    </div>

</body>
</html>