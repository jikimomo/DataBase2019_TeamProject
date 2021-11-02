<html>
    <head>
        <title>Reservation - Reservation</title>
    </head>
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Londrina+Outline|Open+Sans+Condensed:300" rel="stylesheet">
    <link rel="stylesheet" href="../Css/ReservationTime.css">
    <body>
        <div class=frame>
            <?php
                session_start();
                $time = $_POST['resertime'];
                $vid = $_POST['vaccine'];
                $hid = $_SESSION['hid'];
                $uid = $_SESSION['UserID'];
                $drid = 0;

                $dbid = "team11";
                $dbpw = "team11";
                $db = "team11";
                $mysqli = mysqli_connect("localhost",$dbid, $dbpw, $db);

                if (mysqli_connect_errno()){
                    printf("Connect failed: %s",mysqli_connect_error());
                    exit();
                } else{
                    $sql = "SELECT COUNT(HospitalID) FROM reservation_hospital WHERE UserID = '".$uid."' AND ReservationTime = '".$time."' AND NOT HospitalID IN('".$hid."')";
                    $res = mysqli_query($mysqli, $sql);
                    $othernum = mysqli_fetch_row($res);
                    if($othernum[0]!=0){
                        echo "
                        <div class=header>
                        <h1>You already made reservation in other hospital at the same time</h1>
                        </div>";
                    }else {
                        $sql1 = "select DrID FROM reservation_hospital WHERE HospitalID = '".$hid."' AND ReservationTime= '".$time."' AND Available = 0";
                        $sql2 = "select DrNum FROM hospitals WHERE HospitalID = '".$hid."'";
                        $res1 = mysqli_query($mysqli, $sql1);
                        $res2 = mysqli_query($mysqli, $sql2);
                        $arrdrnum = mysqli_fetch_array($res2, MYSQLI_ASSOC);
                        $drnum = $arrdrnum['DrNum'];
                        $num = mysqli_num_rows($res1);

                        if ($num == 0) { #사용자가 원하는 시간에 예약이 하나도 없음
                            $drid = 1;
                        } else { #예약이 하나라도 존재
                            if ($drnum == 2 || ($drnum == 3 && $num == 1)) {
                                $arrother = mysqli_fetch_array($res1, MYSQLI_ASSOC);
                                $other = $arrother['DrID'];
                                if ($other == 1) {
                                    $drid = 2;
                                } else {
                                    $drid = 1;
                                }
                            } else {
                                $i = 0;
                                while ($arrother = mysqli_fetch_array($res1, MYSQLI_ASSOC)) {
                                    $other[$i++] = $arrother['DrID'];
                                }
                                if ($other[0] != 1 && $other[1] != 1) {
                                    $drid = 1;
                                } elseif ($other[0] != 2 && $other[1] != 2) { 
                                    $drid = 2;
                                } else {
                                    $drid = 3;
                                }
                            }
                        }

                        mysqli_begin_transaction($mysqli, MYSQLI_TRANS_START_READ_WRITE);
                        $sql3 = "UPDATE Reservation_hospital SET UserID = '" . $uid . "', VID = '" . $vid . "', Available = 0 WHERE HospitalID = '" . $hid . "' AND ReservationTime = '" . $time . "' AND DrID = '" . $drid . "'";
                        $sql4 = "insert into Reservation_User values ('" . $uid . "', '" . $vid . "', '" . $hid . "', '" . $time . "')";
                        $result3 = mysqli_query($mysqli, $sql3);
                        $result4 = mysqli_query($mysqli, $sql4);

                        if (!$result3 || !$result4) {
                            mysqli_rollback($mysqli);
                            echo "
                            <div class=header>
                            <h1>Reservation is fail<br>Check Vaccine you want to make reservation</h1>
                            </div>";
                        } else {
                            mysqli_commit($mysqli);
                            echo "
                            <div class=header>
                            <h1>Reservation is success</h1>
                            <div>";
                        }
                    }
                    mysqli_close($mysqli);
                }

                echo "<div class=buttons>
                <button type='button' onclick='location.href=\"MainMenu.php\"' class='button'> MainMenu </button>
                </div>";
            ?>
        </div>
    </body>
</html>
