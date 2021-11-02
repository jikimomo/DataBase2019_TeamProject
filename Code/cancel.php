<html>
<head>
    <title>Reservation - Manage Reservation</title>
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Londrina+Outline|Open+Sans+Condensed:300" rel="stylesheet">
    <link rel="stylesheet" href="../Css/CancelList.css">
</head>
    <body>
        <div class=frame style="height : 100px;">
            <?php
                session_start();
                $uid = $_SESSION['UserID'];
                $id = $_POST['reservation'];
                $vid = $_SESSION['vid'][$id];
                $drid = $_SESSION['DrID'][$id];
                $hid = $_SESSION['HospitalID'][$id];
                $time = $_SESSION['ReservationTime'][$id];

                $dbid = "team11";
                $dbpw = "team11";
                $db = "team11";
                $mysqli = mysqli_connect("localhost",$dbid, $dbpw, $db);

                if (mysqli_connect_errno()){
                    printf("Connect failed: %s", mysqli_connect_error());
                    exit();
                } else {
                    mysqli_begin_transaction($mysqli, MYSQLI_TRANS_START_READ_WRITE);
                    $sql1 = "update reservation_hospital set UserId = null, VID = NULL, Available = 1 WHERE hospitalID ='" . $hid . "' AND ReservationTime = '" . $time . "' AND DrID = '" . $drid . "' ";
                    $sql2 = "delete from reservation_user where UserID = '" . $uid . "' AND VID = '" . $vid . "' AND ReservationTime = '" . $time . "'";
                    $res1 = mysqli_query($mysqli, $sql1);
                    $res2 = mysqli_query($mysqli, $sql2);

                    if(!$res1 || !$res2){
                        mysqli_rollback($mysqli);
                        echo "
                        <div class=header>
                        <h1>Cancel is fail</h1>
                        </div>";
                    }else{
                        mysqli_commit($mysqli);
                        echo "
                        <div class=header>
                        <h1>Cancel is success</h1>
                        </div>";
                    }
                    mysqli_close($mysqli);
                }

                echo "<button type='button' onclick='location.href=\"MainMenu.php\"' class='button'> MainMenu </button><br>";
            ?>
        </div>
    </body>
</html>
