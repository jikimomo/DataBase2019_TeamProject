<html>
    <head>
        <title>Vaccination Period</title>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Londrina+Outline|Open+Sans+Condensed:300" rel="stylesheet">
        <link rel="stylesheet" href="../Css/SearchVaccine.css">
    </head>
    <body>
        <div class=frame>
            <div class=header>
                <h1>You can search vaccination time </h1>
            </div> 
            <div class=content> 
                <?php
                    session_start();
                    $dbid = "team11";
                    $dbpw = "team11";
                    $db = "team11";
                    $mysqli = mysqli_connect("localhost",$dbid, $dbpw, $db);
                    if (mysqli_connect_errno()){
                        printf("Connect failed: %s",mysqli_connect_error());
                        exit();
                    }
                    else {
                        $sql = "SELECT * FROM Vaccineinfo GROUP BY VaccinationTime ORDER BY VaccinationTime ASC";
                        $res = mysqli_query($mysqli,$sql);
                        if($res){
                            $num = mysqli_num_rows($res);
                            $i = 0;
                            while($arrtime = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                $time[$i] = $arrtime['VaccinationTime'];
                                $i++;
                            } ?>  
                            <form action="vaccine.php" method="POST">
                                Vaccination time(month) :
                                <select name="vaccinetime">
                                    <?php
                                    for($i=0;$i<$num;$i++){
                                        echo "<option value=".$time[$i].">".$time[$i]."</option>";
                                    }?>
                                </select>
                                <input type=submit value="vaccine list" class='button'>
                            </form>
                        <?php
                        }else{
                            printf("Could not select record: %n",mysqli_error($mysqli));
                        }
                        mysqli_close($mysqli);
                    }?>
                <button type='button' onclick='history.back()' class='button'>go back</button>
            </div>
        </div>
    </body>
</html>

