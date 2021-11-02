<html>
<head>
    <title>Reservation - select time & vaccine</title>
    <meta charset="uft-8">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Londrina+Outline|Open+Sans+Condensed:300" rel="stylesheet">
    <link rel="stylesheet" href="../Css/ReservationTime.css">
</head>
    <body>
        <div class=frame>
            <?php
                session_start();
                $uid = $_SESSION['UserID'];
                if($_POST['hospid'] != 0) {
                    echo "
                    <div class=header>
                        <h1>Choose time you want to make reservation</h1>
                    </div>";    
                    $hid = $_POST['hospid'];
                    $_SESSION['hid'] = $hid;
                    $numofvac = $_SESSION['numofvac'];
                    for ($i = 0; $i < $numofvac; $i++) {
                        $vname[$i] = $_SESSION['VNAME'][$i];
                        $vid[$i] = $_SESSION['VID'][$i];
                    }

                    $dbid = "team11";
                    $dbpw = "team11";
                    $db = "team11";
                    $mysqli = mysqli_connect("localhost", $dbid, $dbpw, $db);

                    if (mysqli_connect_errno()) {
                        printf("Connect failed: %s", mysqli_connect_error());
                        exit();
                    } else {
                        $sql = "SELECT VID FROM Reservation_User WHERE UserID = '" . $uid . "'";
                        $res = mysqli_query($mysqli, $sql);
                        $num = mysqli_num_rows($res);
                        if ($num != 0) {
                            $j = 0;
                            while ($arrvid2 = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                $vid2[$j] = $arrvid2['VID'];
                                $j++;
                            }
                            for ($k = 0; $k < $num; $k++) {
                                for ($s = 0; $s < $numofvac; $s++) {
                                    if ($vid[$s] == $vid2[$k]) {
                                        $tmp = $vname[$s];
                                        $tmp = $tmp . "- already reserved";
                                        $vname[$s] = $tmp;
                                    }
                                }
                            }
                        }
                        $sql1 = "select ReservationTime from reservation_hospital where HospitalID = '" . $hid . "' AND Available = 1 GROUP BY ReservationTime";
                        $res1 = mysqli_query($mysqli, $sql1);
                        $sql2 = "select ReservationTime from reservation_hospital where UserID = '" . $uid . "'";
                        $res2 = mysqli_query($mysqli, $sql2);

                        if ($res1 && $res2) {
                            $i = 0;
                            $num1 = mysqli_num_rows($res1);
                            $num2 = mysqli_num_rows($res2);
                            while ($arrtime = mysqli_fetch_array($res1, MYSQLI_ASSOC)) {
                                $resertime[$i] = $arrtime['ReservationTime'];
                                $tmptime[$i] = $resertime[$i];
                                $i++;
                            }
                            if ($num2 != 0) {
                                $j = 0;
                                while ($arrtime2 = mysqli_fetch_array($res2, MYSQLI_ASSOC)) {
                                    $resertime2[$j] = $arrtime2['ReservationTime'];
                                    $j++;
                                }
                                for ($k = 0; $k < $num2; $k++) {
                                    for ($s = 0; $s < $num1; $s++) {
                                        if ($resertime[$s] == $resertime2[$k]) {
                                            $tmptime[$s] = $tmptime[$s] . "- already reserved";

                                        }
                                    }
                                }
                            }
                            ?>
                            <div class=content>
                                <form action="reservation.php" method="POST" style="margin-top:10px;">
                                    <table style="width:100%;">
                                        <tr><td style="text-align:center;">Reservation time</td>
                                        <td>
                                        <select name="resertime">
                                            <?php
                                            for ($i = 0; $i < $num1; $i++) {
                                                ?>
                                                <option value="<?= $resertime[$i]; ?>"><?= $tmptime[$i]; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        </td></tr>

                                        <tr><td style="text-align:center;">Vaccine</td>
                                        <td>
                                        <select name="vaccine">
                                            <?php
                                            for ($i = 0; $i < $numofvac; $i++) {
                                                ?>
                                                <option value="<?= $vid[$i]; ?>"><?= $vname[$i]; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        </td></tr>
                                    </table>
                                    <input type=submit value="reservation" class='button' style="margin-top:5px;">
                                </form>
                            </div>
                            <?php
                        }
                        mysqli_close($mysqli);
                    }
                }
                else{
                    echo "You didn't choose hospital.";
                }
                echo "
                <button type='button' onclick='location.href=\"MainMenu.php\"' class='button' style=\"margin-top:15px;\" > MainMenu </button>";
            ?>
        </div>
    </body>
</html>