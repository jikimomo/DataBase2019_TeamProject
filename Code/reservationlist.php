<html>
    <head>
        <title>Reservation - select hospital</title>
        <meta charset="uft-8">
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Londrina+Outline|Open+Sans+Condensed:300" rel="stylesheet">
        <link rel="stylesheet" href="../Css/ReservationList.css">
    </head>
<body>
    <div class=frame>
        <?php
            session_start();
            $i=0;
            $j=0;
            $Month = $_SESSION['Months'];
            $uid = $_SESSION['UserID'];
            $addr = $_SESSION['Addr'];

            $dbid = "team11";
            $dbpw = "team11";
            $db = "team11";
            $mysqli = mysqli_connect("localhost",$dbid, $dbpw, $db);


            if (mysqli_connect_errno()){ //1
                printf("Connect failed: %s",mysqli_connect_error());
                exit();
            }
            else { //1
                $sql1 = "SELECT vaccineinfo.VID, vaccineinfo.VName FROM vaccineinfo, uservaccinationinfo WHERE vaccineinfo.VaccinationTime = '".$Month."' AND uservaccinationinfo.userid = '".$uid."' AND uservaccinationinfo.Vaccination = 0 AND vaccineinfo.VID = uservaccinationinfo.VID";
                $res1 = mysqli_query($mysqli,$sql1);
                if($res1){ //2
                    $num1 = mysqli_num_rows($res1);
                    $_SESSION['numofvac']=$num1;
                    if($num1 == 0){ #개월 수에 해당하는 백신이 없는 경우 //3
                        echo "
                        <div class=header style=\"height: 100px;\"> 
                        <h1>There is no vaccine that can get a injection<br>in the current number of months.</h1>
                        </div>";
                    } //3
                    else { #개월 수에 해당하는 백신이 있는 경우 //3
                        echo "
                        <div class=header style=\"height: 50px;\">
                        <h1>This is hospital list you can make reservation.</h1>
                        </div>";
                        while($arrvid = mysqli_fetch_array($res1, MYSQLI_ASSOC)){
                            $_SESSION['VID'][$i++] = $arrvid['VID'];
                            $_SESSION['VNAME'][$j++] = $arrvid['VName'];
                        }
                        #예약 가능한 병원리스트
                        $sql2 = "SELECT reservation_hospital.HospitalID, hospitals.HospitalName, hospitals.Address, hospitals.OpenTime, hospitals.CallNum FROM Hospitals, Reservation_Hospital WHERE Hospitals.Address = '".$addr."' AND reservation_hospital.HospitalID = hospitals.HospitalID AND reservation_hospital.Available = 1 GROUP BY reservation_hospital.HospitalID";
                        $res2 = mysqli_query($mysqli, $sql2);
                        if($res2){ //5
                            $num2 = mysqli_num_rows($res2);
                            $i=0; $j=0; $k=0; $t=0; $s=0;
                            while($arrhosp = mysqli_fetch_array($res2, MYSQLI_ASSOC)) {
                                $hospid[$i++] = $arrhosp['HospitalID'];
                                $hospname[$j++] = $arrhosp['HospitalName'];
                                $address[$k++] = $arrhosp['Address'];
                                $opentime[$t++] = $arrhosp['OpenTime'];
                                $callnum[$s++] = $arrhosp['CallNum'];
                            }
                            $count = $num2;
                            $index = 0;
                            echo "
                            <div class=content>";
                            echo "
                                <form action=\"reservationtime.php\", method=\"POST\">
                                    <table style=\"width: 100%; text-align:center;\">
                                    <tr><td>Hospital Name</td><td>Address</td><td>Time</td><td>Phone Number</td><td>reservation</td></tr>";
                                    while($index < $count){
                                        echo "<tr>
                                            <td>".$hospname[$index]."</td>
                                            <td>".$address[$index]."</td>
                                            <td>".$opentime[$index]."</td>
                                            <td>".$callnum[$index]."</td>
                                            <td>
                                            <input type=\"radio\" name=\"hospid\" value=".$hospid[$index].">
                                            </td>
                                            </tr>";
                                        $index++;
                                    }
                                echo "
                                </table>
                                <input type=\"submit\" name=\"next\" value=\"time\" class='button' style=\"margin-top:10px;\">
                                </form>";
                            echo "
                            </div>";
                        }
                        else{ //5
                            printf("Could not select record: %n",mysqli_error($mysqli));
                            echo "<button type='button' onclick='history.back()'class='button' >Go Back</button>";
                        } //5
                    } //3
                }//2
                else{ //2
                    printf("Could not select record: %n",mysqli_error($mysqli));
                    echo "<br><button type='button' onclick='history.back()' class='button'>Go Back</button>";
                }//2
            mysqli_close($mysqli);
            }//1
        ?>
        <div class='buttons'>
        <button type='button' onclick='history.back()' class='button'>Go Back</button>
        </div>
    </div>
</body>
</html>