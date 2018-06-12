<?php
    session_start();
    header('Content-Type: text/html; charset=utf-8');
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
     <link rel="stylesheet" type="text/css" href="styles/admin/admin.css">
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
                     if(isset($_POST['add']))
                     {
                         header('LOCATION:newBurger.php');
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
<div class="table-responsive">
    <table class="table thead-light table-hover">
  <thead class="bg-secondary">
    <tr class="table-head">
      <th scope="col">Restaurant</th>
      <th scope="col">Bewerter</th>
      <th scope="col">Burger</th>
      <th scope="col">Burger</th>
      <th scope="col">Service</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

<?php
    // SQL Connection
    $pdo = new PDO('mysql:host=localhost;dbname=burger', 'root', '');

    $sql = "SELECT * FROM rating";

        foreach ($pdo->query($sql) as $row) {
        
            //create row
            $tblRow = "<tr><th scope=\"row\">".$row['restaurant']."</td>";
            $tblRow .= "<td>".$row['bewerter']."</td>";
            $tblRow .= "<td>".$row['burger']."</td>";
            $tblRow .= "<td>".$row['rating']."</td>";
            $tblRow .= "<td>".$row['service']."</td>";
            $tblRow .= "<td><a href=\"#\"><i class=\"fas fa-cog change-btn\"></i></a>";
            $tblRow .=" <a href=\"#\"><i class=\"fas fa-trash-alt delete-btn\"></i></a></td></tr>";
            
            echo $tblRow;
        }
?>


  </tbody>
</table>
</div>
<form action="" method="post">
<button type="submit" name="add" class="btn btn-success btn-add">Add</button>
</form>
</div>




        
    </body> 
</html>