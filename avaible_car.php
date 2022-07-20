<?php
        include('connection.php');
        if(isset($_GET["selected_date"]))
        {

            $selected_date = $_GET["selected_date"];
            $allCost=0;
            $result="";

            try{
                $res = $dbh->query("SELECT * FROM iteh2lb1var7.cars");
		            
                foreach($res as $row) {

                    $arrayCar[$row["ID_Cars"]]=$row["Name"];
                    $availableCar[$row["ID_Cars"]] = "YES";
                }


                $sql_get_rent = $dbh->query("SELECT * FROM iteh2lb1var7.rent");
               
                foreach($sql_get_rent as $row){

                    if (($row['Date_start'] <= $selected_date)){ 
                      if (($row['Date_end'] >= $selected_date)){
                        
                        if ($selected_date != $row['Date_start']){
                        
                          $availableCar[$row["FID_Car"]] = "NOT";
                        }

                  }
                }

                }
                foreach($availableCar as $id => $status) {
				
                  $result .= "<tr><td>".$arrayCar[$id]."</td><td>".$availableCar[$id]."</td></tr>";
                 
                }
                $res_tbl = "<table ><tr><td>МАШИНА</td><td>ДОСТУПНОСТЬ</td></tr>";
                $res_tbl .= $result;
                echo $res_tbl;
            ;
            }
            catch(PDOException $e)
            {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
        ?>
