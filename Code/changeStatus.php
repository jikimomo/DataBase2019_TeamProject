<?php
$ses=session_start();
$dbid = "team11";
$dbpw = "team11";
$db = "team11";
$mysqli = mysqli_connect("localhost",$dbid,$dbpw,$db);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n",mysqli_connect_error());
    exit();
}
else{
    if($ses){
        $sql1="SELECT `Vaccination` FROM `uservaccinationinfo` WHERE `uservaccinationinfo`.`UserID` = '".$_SESSION['UserID']."' AND `uservaccinationinfo`.`VID` = ".$_GET['vid'];
        $res1=mysqli_query($mysqli, $sql1);
        if(mysqli_num_rows($res1)==1){
            $newArray = mysqli_fetch_array($res1, MYSQLI_ASSOC); 
            if($newArray['Vaccination']==1){
                $sql2="UPDATE `uservaccinationinfo` SET `Vaccination` = '0' WHERE `uservaccinationinfo`.`UserID` = '".$_SESSION['UserID']."' AND `uservaccinationinfo`.`VID` = ".$_GET['vid'];
                $res2 = mysqli_query($mysqli,$sql2);
            }else{
                $sql3="UPDATE `uservaccinationinfo` SET `Vaccination` = '1' WHERE `uservaccinationinfo`.`UserID` = '".$_SESSION['UserID']."' AND `uservaccinationinfo`.`VID` = ".$_GET['vid'];
                $res3 = mysqli_query($mysqli,$sql3);
            }

            if($res2==TRUE||$res3==TRUE){
                $prevPage = $_SERVER['HTTP_REFERER'];
                header('location:'.$prevPage);
            }else{
                echo "Can't change status";
            }
        }
        else{
            echo "Can't change status";
        }
    }
    else{
        echo "Session missed!";
    }
}
?>