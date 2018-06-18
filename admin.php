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
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" integrity="sha256-HAaDW5o2+LelybUhfuk0Zh2Vdk8Y2W2UeKmbaXhalfA=" crossorigin="anonymous" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js" integrity="sha256-jGAkJO3hvqIDc4nIY1sfh/FPbV+UK+1N+xJJg6zzr7A=" crossorigin="anonymous"></script>
    </head>
    <body>
   


        <?php
                    if(isset($_POST['logout'])){
                        session_destroy();
                        header('LOCATION:index.php'); 
                        die();
                     }
                     if(isset($_POST['add']))
                     {
                         header('LOCATION:newBurger.php');
                         die();
                     }
                     if(isset($_POST['change_password']))
                     {
                         header('LOCATION:changePassword.php');
                         die();
                     }
                   
                     
                     ?>

    <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Rate a Burger  <img  class="logo" src="assets/logo.png"></a>


        <form class="form-inline my-2 my-lg-0" action="" method="post">
            <button type="submit" name="change_password" class="btn btn-dark btn-change-password"><i class="fas fa-lock"></i></button>
            <button type="submit" name="logout" class="btn btn-danger btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>

</nav>
    <div class="row">
        <div class="col">
    <?php

if(isset($_POST['executedelete']))
{
   
   try{
    $configs = include('config.php');
    $pdo = new PDO('mysql:host='.$configs['host'].';dbname='.$configs['db'].';charset=utf8', $configs['username'], $configs['password']);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM rating Where id=".$_POST['executedelete'];
    $pdo->exec($sql);


    echo "<div class=\"alert alert-success alert-dismissible fade show\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    Rating deleted <i class=\"fas fa-check\"></i>
  </div>";
   }
   catch(PDOException $e)
   {
       echo $sql . "<br>" . $e->getMessage();
   }
}

    ?>
    </div>
    </div>
    <br>
<div class="container">
<input class="form-control" id="myInput" type="text" placeholder="Search..">
<div class="table-wrapper-2">
<div class="table-responsive">
    <table id='table' class="table thead-light  table-hover">
  <thead class="bg-secondary">
    <tr class="table-head">
      <th scope="col">Restaurant</th>
      <th scope="col">Bewerter</th>
      <th scope="col">Burger</th>
      <th scope="col" class="rating">Burger</th>
      <th scope="col" class="rating">Service</th>
      <th scope="col" align=\"center\">Action</th>
    </tr>
  </thead>
  <tbody>

<?php

    include ("{$_SERVER['DOCUMENT_ROOT']}/rateaburger/table.php");
    // // SQL Connection
    // $pdo = new PDO('mysql:host=localhost;dbname=burger;charset=utf8', 'root', '');

    // $sql = "SELECT * FROM rating";

    //     foreach ($pdo->query($sql) as $row) {
            
    //         //create row
    //         $tblRow = "<tr><th scope=\"row\">".$row['restaurant']."</td>";
    //         $tblRow .= "<td>".$row['bewerter']."</td>";
    //         $tblRow .= "<td>".$row['burger']."</td>";

    //         //Seperate Rating 
    //         $partsBurger = explode('.',$row['rating']);
    //         $partsService = explode('.', $row['service']);

    //         //init Variable for TR
    //         $burgerrating = "";
    //         $servicerating = "";


    //         //Generate TR for Burgerrating
    //         for ($i = 1; $i <=  $partsBurger[0]; $i++) {
    //            $burgerrating .= "<span class=\"fas fa-star\"></span>";
    //         }

    //         if(!empty($partsBurger[1]))    
    //         {
    //             $burgerrating .= "<span class=\"fas fa-star-half\"></span>";
    //         }

    //         //Generate TR for Servicerating
    //         for ($i = 1; $i <=  $partsService[0]; $i++) {
    //             $servicerating .= "<span class=\"fas fa-star\"></span>";
    //          }
 
    //          if(!empty($partsService[1]))    
    //          {
    //              $servicerating .= "<span class=\"fas fa-star-half\"></span>";
    //          }
           
           
    //         $tblRow .= "<td class=\"rating\">".$burgerrating."</td>";
    //         $tblRow .= "<td class=\"rating\">".$servicerating."</td>";

    //         // $tblRow .= "<td>".$row['rating']."</td>";
    //         // $tblRow .= "<td>".$row['service']."</td>";
    //         // $tblRow .= "<td><a href=\"#\"><i class=\"fas fa-cog change-btn\"></i></a>";
    //         $tblRow .= "<td align=\"center\"><div class=\"btn-group\"><form class=\"form\">
    //                     <button name=\"alter\" value=\"".$row['id']."\" class=\"btn btn-primary btn-sm change-btn\"><i class=\"fas fa-cog \"></i></button>
    //                     </form>";
           
              


    //         $tblRow .=" <button name=\"delete\" value=\"".$row['id']."\" class=\"btn btn-danger btn-sm delete-btn\" data-toggle=\"modal\" data-target=\"#ModalCenter".$row['id']."\"><i class=\"fas fa-trash-alt \"   >
    //                     </i></button></div>";
            
    //         //add Modal window for every Entry in Table
    //         $modal = "<div class=\"modal fade\" id=\"ModalCenter".$row['id']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"ModalCenterTitle\" aria-hidden=\"true\">
    //         <div class=\"modal-dialog modal-dialog-centered\" role=\"document\">
    //         <div class=\"modal-content\">
    //             <div class=\"modal-header\">
    //             <h5 class=\"modal-title\" id=\"ModalCenterTitle\">Delete Entry ?!?</h5>
        
    //             </div>
    //             <div class=\"modal-body\">
    //             Willst du Pfeife diesen Eintrag wirklich löschen?😨
    //             </div>
    //             <div class=\"modal-footer\">
    //             <form action=\"\" method=\"post\" class=\"btn-group\">
    //             <button type=\"button\" class=\"btn btn-secondary btn-delete-close\" data-dismiss=\"modal\">Close</button>
                
    //             <button type=\"submit\" value=\"".$row['id']."\" name=\"executedelete\" class=\"btn btn-Danger btn-delete-execute\" id='delete'>Delete</button>
    //             </form>
    //                 </div>
    //             </div>
    //         </div>
    //     </div></td></tr>";
            
    //         $tblRow .= $modal;


    //         echo $tblRow;
        // }
?>


  </tbody>
</table>
</div>
    </div>

<form action="" method="post">
<div class="btn-group" role="group" aria-label="Basic example">

<button type="submit" name="add" class="btn btn-success btn-add"><i class="fas fa-plus"></i> Add</button>
<a href="assets/Burgermap.jpg"   data-toggle="lightbox" name="image" class="btn btn-dark btn-map" ><i class="fas fa-map"></i> Map</a>
</div>
</form>
</div>


<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


<script>
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
</script>
        
    </body> 
</html>