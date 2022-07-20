<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
    <tr><td>FID_Car</td><td>НАЧАЛО АРЕНДЫ</td><td>КОНЕЦ АРЕНДЫ</td></tr>
<?php
        include('connection.php');
        
         if( isset($_GET['start_date'])&& isset($_GET['start_time']) && isset($_GET['end_date']) && isset($_GET['end_time']) && isset($_GET['selected_car']) && isset($_GET['rental_price']))
         {
            $start_date = $_GET["start_date"];
            $start_time = $_GET["start_time"];
            $end_date = $_GET["end_date"];
            $end_time = $_GET["end_time"];
            $selected_car = $_GET["selected_car"];
            $rental_price = $_GET["rental_price"];


            $result = "";

            try{
                $dbh->exec("set names utf8");
                $res = $dbh->query("SELECT * FROM iteh2lb1var7.cars");
		            
                foreach($res as $row) {

                    if($selected_car == $row["Name"])
                    {
                        $idCar = $row['ID_Cars'];
                    }
                }


                $dbh->query("INSERT INTO iteh2lb1var7.rent (FID_Car,Date_start,Time_start,Date_end,Time_end,Cost) VALUES('".$idCar."','".$start_date."','".$start_time."','".$end_date."','".$end_time."','".$rental_price."')");
                
                
                $res_rent = $dbh->query("SELECT * FROM iteh2lb1var7.rent");
		            
                foreach($res_rent as $row_rent) {

                    $result=$result."<tr><td>".$row_rent['FID_Car']."</td><td>".$row_rent['Date_start']."</td><td>".$row_rent['Date_end']."</td></tr>";
                }

                 echo $result;
            
            }
            catch(PDOException $e)
            {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
         }
        ?>

</table>
</body>
</html>
