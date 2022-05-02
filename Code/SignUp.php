<?php
    #비밀번호 재입력 체크
    $check1=true;
    if($_GET['pwd']!=$_GET['rpwd']){
        echo "Password is not correct with Re-entered Password";
        echo "<a href=SignUp.html>Go back to Sign Up";
        $check1=false;
    }

    #빈칸 있는지 체크
    $check2=true;
    if($_GET['Id']==NULL || $_GET['pwd']==NULL || $_GET['UserName']==NULL || $_GET['Sex']==NULL || $_GET['Year']==NULL || $_GET['Month']==NULL || $_GET['Day']==NULL || $_GET['Addr']==NULL || $_GET['Avatar']==NULL){
        echo "Empty attributes exist Please Enter All Blank";
        echo "<a href=SignUp.html>Go back to Sign Up";
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

            mysqli_begin_transaction($mysqli, MYSQLI_TRANS_START_READ_WRITE);
            #유저 테이블에 insert
            $sql1 = "INSERT INTO `userinfo` (`UserID`, `Password`, `UserName`, `Sex`, `Birth`, `Address`, `Avatar`) VALUES ('".$_GET['Id']."', '".$_GET['pwd']."', '".$_GET['UserName']."', '".$_GET['Sex']."', '".$birth."', '".$_GET['Addr']."', ".$_GET['Avatar'].")";
            $res1 = mysqli_query($mysqli,$sql1);

            $res2 = FALSE;
            $vaccine = 0;
            for($vid=1; $vid<=34; $vid++){
                $sql2 = "INSERT INTO `uservaccinationinfo` (`UserID`, `VID`, `Vaccination`) VALUES ('".$_GET['Id']."', ".$vid.", ".$vaccine.")";
                $res2=mysqli_query($mysqli,$sql2);
                if($res2==False){
                    break;
                }
            }

            if ($res2 == TRUE && $res1 == TRUE) { #회원가입 성공시
                mysqli_commit($mysqli);
                echo "<script>location.href='SignUpSuccess.html'</script>"; 
            }else { #회원가입 실패시
                mysqli_rollback($mysqli);
                echo "user id is already used!!";
                echo "<button type='button' onclick='history.back()'class='button' >Go Back</button>";
            }
            #디비연결 끊기
            mysqli_close($mysqli);
        }
    }
?>