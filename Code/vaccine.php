<html>
    <head>
        <title>Vaccination Period</title>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Londrina+Outline|Open+Sans+Condensed:300" rel="stylesheet">
        <link rel="stylesheet" href="../Css/Vaccine.css">
    </head>
    <body>
        <div class=frame>
            <div class=header>
                <?php 
                $time = $_POST['vaccinetime'];
                session_start();
                echo "<h1>This is vaccine list you can get<br>vaccinated at".$time." Month.</h1>"; 
                ?>
            </div>
            <div class=content>
                <?php
                    $dbid = "team11";
                    $dbpw = "team11";
                    $db = "team11";
                    $mysqli = mysqli_connect("localhost",$dbid, $dbpw, $db);

                    if (mysqli_connect_errno()){
                        printf("Connect failed: %s",mysqli_connect_error());
                        exit();
                    } else {
                        $sql = "SELECT * FROM VaccineInfo WHERE VaccinationTime = '".$time."'";
                        $res = mysqli_query($mysqli,$sql);
                        if($res){
                            $num = mysqli_num_rows($res);
                            $i=0;
                            while($arr = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                $name[$i] = $arr['VName'];
                                $i++;
                            }
                            for($i=0; $i<$num; $i++){
                                printf("%s<br>\n", $name[$i]);
                            }
                        }else{
                            printf("Could not select record: %n",mysqli_error($mysqli));
                        }
                        mysqli_close($mysqli);
                    }
                ?>
            </div>
            <div class='buttons'>
                <button type='button' onclick='location.href="MainMenu.php"' class='button'> MainMenu </button>
                <button type='button' onclick='history.back()'class='button'>GoBack</button>
            </div>
        </div>
    </body>
</html>