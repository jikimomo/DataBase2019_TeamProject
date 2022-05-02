<html>
<head>
    <title>ChangeMyInfo</title>
</head>
<?php
    session_start();
    #비밀번호 재입력 체크
    $check1=true;
    if($_GET['pwd']!=$_GET['rpwd']){
        echo "Password is not correct with Re-entered Password";
        echo "<a href=ChangeMyInfo.php>Go back to change information";
        $check1=false;
    }

    #빈칸 있는지 체크
    $check2=true;
    if($_GET['pwd']==NULL || $_GET['UserName']==NULL || $_GET['Sex']==NULL || $_GET['Year']==NULL || $_GET['Month']==NULL || $_GET['Day']==NULL || $_GET['Addr']==NULL || $_GET['Avatar']==NULL){
        echo "Empty attributes exist Please Enter All Blank";
        echo "<a href=ChangeMyInfo.php>Go back to change information";
        $check2=false;
    }
    if($check1==true && $check2==true){
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
            #생일 포맷 설정
            $birth = $_GET['Year']."-".$_GET['Month']."-".$_GET['Day'];

            #유저 테이블에 insert
            $sql1 = "UPDATE `userinfo` 
                    SET 
                    `Password` = '".$_GET['pwd']."',
                    `UserName` = '".$_GET['UserName']."', 
                    `Sex` = '".$_GET['Sex']."', 
                    `Birth` = '".$birth."', 
                    `Address` = '".$_GET['Addr']."',
                    `Avatar` = '".$_GET['Avatar']."'
                    WHERE `userinfo`.`UserID` = '".$_SESSION['UserID']."' 
                    AND `userinfo`.`Password` = '".$_SESSION['pwd']."';";
            $res1 = mysqli_query($mysqli,$sql1);
            if($res1==False){
                printf("Could not change USER record: %s\n",mysqli_error($mysqli));
                #디비연결 끊기
                mysqli_close($mysqli);
            }
            else{
                #디비연결 끊기
                mysqli_close($mysqli);
                echo "
                <head>
                    <link href=\"https://fonts.googleapis.com/css?family=Indie+Flower|Londrina+Outline|Open+Sans+Condensed:300\" rel=\"stylesheet\">
                    <link rel=\"stylesheet\" href=\"../Css/SignUpSuccess.css\">
                </head>
                <body>
                    <div class=frame>
                        <div class=box style=\" width: 350px;height: 150px;\">
                            <h1>Success Change your information!</h1>
                            <a href='Logout.php' style=\"font-size : 30px;\"> You need to login again
                        </div>
                    </div>
                </body>";
            }
        }
    }
?>
</html>
