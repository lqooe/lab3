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
       
        <?php
        include('connection.php');
        if(isset($_GET["racee"]) && isset($_GET["carr"]))
        {

            $racee = $_GET["racee"];
            $carr = $_GET["carr"];

            $result = "";

            if (is_numeric($racee)){
               
                $res = $dbh->query("UPDATE iteh2lb1var7.cars SET Race='".$racee."' WHERE Name='".$carr."'");
            
            }

            try{
                $res = $dbh->query("SELECT * FROM iteh2lb1var7.cars");
		            
                foreach($res as $row) {

                    $result=$result."<tr><td>".$row['Name']."</td><td>".$row['Race']."</td></tr>";
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