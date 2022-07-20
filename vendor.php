<?php
        include('connection.php');
        if(isset($_GET["vend"]))
        {
            $vend = $_GET["vend"];
           
            try{
              
              $sql_get_vend = "SELECT * FROM iteh2lb1var7.vendors";
              
              foreach($dbh->query($sql_get_vend) as $row)
              {
                if ($vend==$row['Name'])
                {
                  $idVendor=$row['ID_Vendors'];
                }
              }
              
                $sql_getId = "SELECT * FROM iteh2lb1var7.cars WHERE FID_Vendors= :".$idVendor;
                $sth = $dbh->prepare($sql_getId);
                $sth->execute((array(':'.$idVendor => $idVendor)));
                
                $cursor = $sth->fetchAll(PDO::FETCH_OBJ);
                echo json_encode($cursor);

            }
            catch(PDOException $e)
            {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
        ?>
