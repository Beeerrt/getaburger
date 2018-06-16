<?php
    //Include Config File
    $configs = include('config.php');
    // SQL Connection
    $pdo = new PDO('mysql:host=localhost;dbname=burger;charset=utf8', $configs['username'], $configs['password']);

    $sql = "SELECT * FROM rating";

        foreach ($pdo->query($sql) as $row) {
            
            //create row
            $tblRow = "<tr><th scope=\"row\">".$row['restaurant']."</td>";
            $tblRow .= "<td>".$row['bewerter']."</td>";
            $tblRow .= "<td>".$row['burger']."</td>";

            //Seperate Rating 
            $partsBurger = explode('.',$row['rating']);
            $partsService = explode('.', $row['service']);

            //init Variable for TR
            $burgerrating = "";
            $servicerating = "";

            
            //Generate TR for Burgerrating
            for ($i = 1; $i <=  $partsBurger[0]; $i++) {
               $burgerrating .= "<span class=\"fas fa-star\"></span>";
            }

            if(!empty($partsBurger[1]))    
            {
                $burgerrating .= "<span class=\"fas fa-star-half\"></span>";
            }

            //Generate TR for Servicerating
            for ($i = 1; $i <=  $partsService[0]; $i++) {
                $servicerating .= "<span class=\"fas fa-star\"></span>";
             }
 
             if(!empty($partsService[1]))    
             {
                 $servicerating .= "<span class=\"fas fa-star-half\"></span>";
             }
           
           
            $tblRow .= "<td class=\"rating\">".$burgerrating."</td>";
            $tblRow .= "<td class=\"rating\">".$servicerating."</td>";

            // $tblRow .= "<td>".$row['rating']."</td>";
            // $tblRow .= "<td>".$row['service']."</td>";
            // $tblRow .= "<td><a href=\"#\"><i class=\"fas fa-cog change-btn\"></i></a>";
            $tblRow .= "<td align=\"center\"><div class=\"btn-group\"><form class=\"form\">
                        <button name=\"alter\" value=\"".$row['id']."\" class=\"btn btn-primary btn-sm change-btn\"><i class=\"fas fa-cog \"></i></button>
                        </form>";
           
              


            $tblRow .=" <button name=\"delete\" value=\"".$row['id']."\" class=\"btn btn-danger btn-sm delete-btn\" data-toggle=\"modal\" data-target=\"#ModalCenter".$row['id']."\"><i class=\"fas fa-trash-alt \"   >
                        </i></button></div>";
            
            //add Modal window for every Entry in Table
            $modal = "<div class=\"modal fade\" id=\"ModalCenter".$row['id']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"ModalCenterTitle\" aria-hidden=\"true\">
            <div class=\"modal-dialog modal-dialog-centered\" role=\"document\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                <h5 class=\"modal-title\" id=\"ModalCenterTitle\">Delete Entry ?!?</h5>
        
                </div>
                <div class=\"modal-body\">
                Willst du Pfeife diesen Eintrag wirklich löschen?😨
                </div>
                <div class=\"modal-footer\">
                <form action=\"\" method=\"post\" class=\"btn-group\">
                <button type=\"button\" class=\"btn btn-secondary btn-delete-close\" data-dismiss=\"modal\">Close</button>
                
                <button type=\"submit\" value=\"".$row['id']."\" name=\"executedelete\" class=\"btn btn-Danger btn-delete-execute\" id='delete'>Delete</button>
                </form>
                    </div>
                </div>
            </div>
        </div></td></tr>";
            
            $tblRow .= $modal;


            echo $tblRow;
        }
?>