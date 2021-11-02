<html>
<head>
    <title>Reservation - Manage Reservation</title>
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Londrina+Outline|Open+Sans+Condensed:300" rel="stylesheet">
    <link rel="stylesheet" href="../Css/CancelList.css">
</head>
    <body>
        <div class=frame>
            <?php
                session_start();
                $uid = $_SESSION['UserID'];

                $dbid = "team11";
                $dbpw = "team11";
                $db = "team11";
                $mysqli = mysqli_connect("localhost",$dbid, $dbpw, $db);

                if (mysqli_connect_errno()){//1
                    printf("Connect failed: %s",mysqli_connect_error());
                    exit();
                } //1
                else {//1
                    $sql1 = "select reservation_user.VID, reservation_user.HospitalID, reservation_user.ReservationTime, vaccineinfo.VName, hospitals.HospitalName, reservation_hospital.DrID from reservation_user, reservation_hospital, vaccineinfo, hospitals where  reservation_user.UserID = '".$uid."' AND reservation_user.VID = vaccineinfo.VID AND reservation_user.HospitalID = hospitals.HospitalID AND reservation_user.UserID = reservation_hospital.UserID AND reservation_user.VID = reservation_hospital.VID AND reservation_user.HospitalID = reservation_hospital.HospitalID AND reservation_user.ReservationTime = reservation_hospital.ReservationTime";
                    $res1 = mysqli_query($mysqli,$sql1);
                    $num1 = mysqli_num_rows($res1);
                    if($num1 != 0) {//2
                        echo "
                        <div class=header>
                        <h1>Let's Manage my reservation!</h1>
                        </div>";
                        $i = 0;
                        echo "
                        <div class=content>";
                        while ($arrres = mysqli_fetch_array($res1, MYSQLI_ASSOC)) {
                            $_SESSION['vid'][$i] = $arrres['VID'];
                            $_SESSION['HospitalID'][$i] = $arrres['HospitalID'];
                            $_SESSION['ReservationTime'][$i] = $arrres['ReservationTime'];
                            $_SESSION['DrID'][$i] = $arrres['DrID'];

                            $res[$i] = $arrres['VName'];
                            $res[$i] = $res[$i] . " / " . $arrres['HospitalName'];
                            $res[$i] = $res[$i] . " / " . $arrres['ReservationTime'];

                            $tmp[$i]['id'] = $i;
                            $i++;
                        }
            ?>
                        <form action="cancel.php" method="POST">
                            <br>Reservation :
                            <select name="reservation">
                                <?php
                                for($i=0;$i<$num1;$i++){
                                    ?>
                                    <option value="<?=$tmp[$i]['id'];?>"><?=$res[$i];?></option>
                                    <?php
                                }
            ?>
                            </select>
                            <input type=submit value="cancel" class="button" style="width:50px; margin-top:5px;">
                        </form>
            <?php
                        echo "
                        </div>";
                    }//2
                    else {//2
                        echo "
                        <div class=content>
                        There are not reservation list
                        </div>";
                    }//2
            mysqli_close($mysqli);
            }
                ?>
            <button type='button' onclick='history.back()' class="button" style="margin-top : 10px;">Go Back</button>
        </div>
    </body>
</html>