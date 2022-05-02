<?php
    session_start();
?>
<html>
    <head>
        <Title> MainMenu </title>
        <meta charset="uft-8">
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Londrina+Outline|Open+Sans+Condensed:300" rel="stylesheet">
        <link rel="stylesheet" href="../Css/MainMenu.css">
        <script language="javascript">
            function showPopup() { 
                window.open("popup.html", "a", "width=550, height=150, top=50"); 
            }
        </script>
    </head>
    <body>
            <div class=frame>
                <div class=header> 
                    <div class=bannerTitle>
                        <div style="font-size : 50;">VRSS</div>
                        <div style="font-size : 20;">Welcome to Vaccine Reservation Service System</div>
                    </div>
                </div>
                <div class=container>
                    <div class=userinfo>
                        <div class=title>My Information<br> </div>
                        <div class=content>
                            <?php 
                                if($_SESSION['Ava']==0){
                                    echo "<img src=\"../image/avatar1.png\" width=\"50\" height=\"100\">";
                                }else if($_SESSION['Ava']==1){
                                    echo "<img src=\"../image/avatar2.png\" width=\"50\" height=\"100\">";
                                }else{
                                    echo "<img src=\"../image/avatar3.png\" width=\"50\" height=\"100\">";
                                }
                            ?>
                            ============================
                            <div style="text-align: left;">
                                &nbsp;&nbsp;&nbsp;Name : <?php echo $_SESSION['UserName'];?> <br>
                                &nbsp;&nbsp;&nbsp;Sex : 
                                                        <?php 
                                                            if($_SESSION['Sex']==0){echo "Female";}
                                                            else{echo "Male";} 
                                                        ?><br>
                                &nbsp;&nbsp;&nbsp;Birth : <?php echo $_SESSION['Birth'];?><br>
                                &nbsp;&nbsp;&nbsp;Age : <?php echo $_SESSION['Months'];?>months<br>
                                &nbsp;&nbsp;&nbsp;Address : <?php echo $_SESSION['Addr'];?><br>
                            </div>
                        </div>
                    </div> 
                    <div class=myVaccineInfo>
                        <div class=title>My Vaccination Information <br> </div>
                        <div class=content style="height : 220px; width:290px; margin-left:15px; border: 0.7px solid #CECCCC; ">
                            <?php
                                $dbid = "team11";
                                $dbpw = "team11";
                                $db = "team11";
                                $mysqli = mysqli_connect("localhost",$dbid,$dbpw,$db);
                                if (mysqli_connect_errno()) {
                                    printf("Connect failed: %s\n",mysqli_connect_error());
                                    exit();
                                }
                                else{
                                    $sql="SELECT V.VID, V.Vname, U.Vaccination FROM `uservaccinationinfo` AS U, `vaccineinfo` AS V WHERE U.VID=V.VID AND U.UserID='".$_SESSION['UserID']."'";
                                    $res = mysqli_query($mysqli,$sql);
                                    if($res){
                                        echo "<table  style=\"width: 100%;\">";
                                        while($newArray=mysqli_fetch_array($res,MYSQLI_ASSOC)){
                                            $vname=$newArray['Vname'];
                                            $vaccination=$newArray['Vaccination'];
                                            $vid=$newArray['VID'];
                                            if($vaccination==0){
                                                echo "<tr>
                                                <td>".$vname."</td>
                                                <td style=\"text-align : center\"> X </td>
                                                <td style=\"text-align : center\">
                                                <input type='button' name='changeStatus' value='changeStatus' onClick=\"location.href='changeStatus.php?vid=$vid'\" class=\"changeStatus\">
                                                </td></tr>
                                                ";
                                            }
                                            else{
                                                echo "<tr>
                                                <td>".$vname."</td>
                                                <td style=\"text-align : center\"> O </td>
                                                <td style=\"text-align : center\">
                                                <input type='button' name='changeStatus' value='vaccinated' class=\"changeStatus\" onClick=\"location.href='changeStatus.php?vid=$vid'\" style=\"background-color: #A7A8AA\">
                                                </td></tr>";
                                            }
                                        }
                                        echo "</table>";
                                    }
                                }
                            ?>   
                        </div>  
                        <input type='button' name='VaccinationPeriod' value='VaccinationPeriod' onClick="location.href='searchvaccine.php'" class="button" style="margin-top : 5px; width : 130px;">
                    </div>
                    <div class=findHospital>
                        <div class=title>findHospital</div>
                        <div class=content>
                            You live in <?php echo $_SESSION['Addr']; ?><br>
                            Let's find hosipitals near your address! <br> 
                            <input type='button' name='findHospital' value='findHospital' onClick="location.href='reservationlist.php'" class="button" style="margin-top : 5px;">
                        </div>
                    </div>
                    <div class=myReservation>
                        <div class=title>myReservation</div>
                        <div class=content style="height : 90px; width:255px;"> 
                            <?php
                                $sql1="SELECT V.Vname, H.HospitalName, R.ReservationTime FROM `reservation_user` AS R, `vaccineinfo` AS V, `hospitals` AS H WHERE R.VID=V.VID AND R.HospitalID=H.HospitalID AND R.UserID='".$_SESSION['UserID']."'";
                                $res1 = mysqli_query($mysqli,$sql1);
                                if($res1){
                                    while($newArray1=mysqli_fetch_array($res1,MYSQLI_ASSOC))
                                    {
                                        $vname=$newArray1['Vname'];
                                        $hname=$newArray1['HospitalName'];
                                        $rtime=$newArray1['ReservationTime'];
                                        echo $vname." / ".$hname." / ".$rtime."<br>";
                                    }
                                }
                            ?>  
                        </div>
                        <input type='button' name='findHospital' value='Manage My Reservation' onClick="location.href='cancellist.php'" class="button" style="margin-top : 5px; width : 130px;">
                    </div>
                </div>
                <div class=footer>
                    <input class="button" type='button' name='Logout' value='Logout' onClick="location.href='Logout.php'" style="margin-top : 5px; ">
                    <input class="button" type='button' name='ChangeMyInfo' value='ChangeMyInfo' onClick="location.href='ChangeMyInfo.php'" style="margin-top : 5px;">
                    <input class="button" type='button' name='Withdraw' value='Withdraw' style="margin-top : 5px;" onclick="showPopup();">
                </div>
            </div>
    </body>
</html>

