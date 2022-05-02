<html>
<head>
    <title>Withdraw</title>
</head>
<?php
    session_start();
    $dbid = "team11";
    $dbpw = "team11";
    $db = "team11";
    $mysqli = mysqli_connect("localhost",$dbid,$dbpw,$db);

        # 디비연결체크
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n",mysqli_connect_error());
            exit();
        }
        else {

            mysqli_begin_transaction($mysqli, MYSQLI_TRANS_START_READ_WRITE);
            $sql2 = "DELETE FROM `uservaccinationinfo` 
                     WHERE `uservaccinationinfo`.`UserID`= '".$_SESSION['UserID']."'";
            $res2=mysqli_query($mysqli,$sql2);

            $sql1="DELETE FROM `userinfo` 
                   WHERE `userinfo`.`UserID` = '".$_SESSION['UserID']."' 
                   AND `userinfo`.`Password` = '".$_SESSION['pwd']."'";
            $res1 = mysqli_query($mysqli,$sql1);
            
            if($res1==TRUE && $res2==TRUE){
                mysqli_commit($mysqli);
                printf("Withdraw Success\n");
                echo "<br>";
                echo "<a href='Login.html'> Go Back TO Login";
            }
            else{
                mysqli_rollback($mysqli);
                printf("Can't remove record!%s",mysqli_connect_error());
                echo "<a href='Login.html'> Session Dismissed! Go Back TO Login";
            }
            #디비연결 끊기
            mysqli_close($mysqli);
            session_destroy();
        }
?>
</html>