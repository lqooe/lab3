<?php
 include('connection.php');
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>ЛБ3</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
<h2>Лабораторная работа №3</h2>

<div class="wrapper1">
    
        <p><strong>Выберите дату чтоб узнать доход с проката</strong>

            <input name="selected_date" type=date id="selected_date1">
            <input class="buttons"  type="button" value="Узнать" onclick="getxml()"/>

  
    
        <p><strong>Выберите производителя, для просмотра его машин</strong>

            <select name='vend' id="vend">
                <option>Производители</option>
                <?php
        $sql = "SELECT * FROM iteh2lb1var7.vendors";

        foreach($dbh->query($sql) as $row)
                {
                $name_vend = $row['Name'];
                echo "<option value = '$name_vend'> $name_vend</option>";
                }
                ?>
        </p>
        </select>
        <input class="buttons" type="button" value="Посмотреть" onclick="getjson()">
   

   
        <p>
        <strong>Выберите дату чтоб получить доступные авто</strong>
            <input name="selected_date" type=date id="selected_date">

            <input class="buttons" type="button" value="Получить" onclick="gettxt()" />
        </p>
   
</div>

<div id="res">


</div>


    <script>
            var ajax = new XMLHttpRequest();

            function gettxt() {
                ajax.onreadystatechange = function() {
                    if (ajax.readyState === 4) {
                        if (ajax.status === 200) {
                            console.dir(ajax.responseText);
                            document.getElementById("res").innerHTML = ajax.response;
                        }
                    }
                }
                var dt = document.getElementById("selected_date").value;
                ajax.open("get", "avaible_car.php?selected_date=" + dt);
                ajax.send();
            }

            function getxml() {
                ajax.onreadystatechange = function() {
                    if (ajax.readyState === 4) {
                        if (ajax.status === 200) {

                            console.dir(ajax);
                            let rows = ajax.responseXML.firstChild.children;
                            let result = "<table border ='1'>";
                            result = result + "<tr><th>МАШИНА</th><th>ДОХОД</th></tr>";
                            for (var i = 0; i < rows.length; i++) {
                                result += "<tr>";
                                result += "<td>" + rows[i].children[0].firstChild.nodeValue + "</td>";
                                result += "<td>" + rows[i].children[1].firstChild.nodeValue + "</td>";
                               
                                result += "</tr>";
                            }
                            document.getElementById("res").innerHTML = result;
                        }
                    }
                }
                var dat1 = document.getElementById("selected_date1").value;
                ajax.open("get", "profit.php?selected_date=" + dat1);
                ajax.send();
            }

            function getjson() {
                ajax.onreadystatechange = function(){
                    let rows = JSON.parse(ajax.responseText);
                console.dir(rows);
                if (ajax.readyState === 4) {
                    if (ajax.status === 200) {
                        console.dir(ajax);
                        let result = "<table border ='1'>";
                        result = result + "<tr><th>ID_Cars</th><th>Name</th><th>Release_date</th><th>Race</th><th>Price</th></tr>";
                        for (var i = 0; i < rows.length; i++) {
                            result += "<tr>";
                            result += "<td>" + rows[i].ID_Cars+ "</td>";
                            result += "<td>" + rows[i].Name + "</td>";
                            result += "<td>" + rows[i].Release_date + "</td>";
                            result += "<td>" + rows[i].Race + "</td>";
                            result += "<td>" + rows[i].Price + "</td>";
                            result += "</tr>";
                         
                        }
                        document.getElementById("res").innerHTML = result;
                    }
                }
                };
                var vend = document.getElementById("vend").value;
                ajax.open("get", "vendor.php?vend=" + vend);
                ajax.send();
            }

    </script>
<!-- Изменение данных -->

<div class="wrapper2">
    <h3> Аренда</h3>

    <form method="get" action="rent.php" id="form">
        <p><strong>Выберите дату:</strong>

            <a style="margin-left: 0px;">Начало:</a>
            <input type="date" name= "start_date"  >
            <input type="time" name = "start_time"><br>

            <a style="margin-left: 153px;">Конец:</a>
            <input type="date" name="end_date">
            <input type="time" name="end_time" ><br>
        </p>
        <h3></h3>
        <p><strong>Выберите авто:</strong>
            <select name='selected_car'>
                <option>Автомобиль</option>
                <?php
                        $sqlSelect = "SELECT * FROM iteh2lb1var7.cars";
                        foreach ($dbh->query($sqlSelect) as $cell) {
                $name_car = $cell['Name'];
                echo "<option value = '$name_car'> $name_car</option>";
                }
                ?>
            </select>
        </p>
        <h3></h3>
        <p><strong>Введите цену:</strong>
            <input name="rental_price"  type="text" value="0" />
        </p>
        <h3></h3>
        <input class="buttons" type="submit" value="Арендовать" />
    </form>

        
</div>
<div class="wrapper3">
    <h3> Изменение пробега</h3>
    <form method="get" action="race_change.php" id="form">
        <p><strong>Выберите авто:</strong>
            <select name='carr'>
                <option>Автомобиль</option>
                <?php
                    $sqlSelect = "SELECT * FROM iteh2lb1var7.cars";
                    foreach ($dbh->query($sqlSelect) as $cell) {
                $name_car = $cell['Name'];
                
                echo "<option value = '$name_car'> $name_car</option>"; 
                }
                ?>
            </select>
        </p>
        <h3></h3>
        <p><strong>Введите пробег:</strong>
            <input name="racee"  type="text" value="0" />
        </p>
        <input class="buttons"   type="submit" value="Изменить" />   
    </form>
</div>

</body>

</html>