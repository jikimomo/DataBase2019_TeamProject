<?php
    #로그인세션시작
    session_start();
    $dbid = "team11";
    $dbpw = "team11";
    $db = "team11";
    $mysqli = mysqli_connect("localhost",$dbid,$dbpw,$db);

    #디비 연결 체크
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n",mysqli_connect_error());
        exit();
    }
    else {
        #id와 pwd가 일치하는 row가 있는지 확인
        $sql = "SELECT 
                `UserID`, 
                `Password`, 
                `UserName`, 
                `Sex`, 
                `Birth`, 
                `Address`, 
                `avatar`, 
                TIMESTAMPDIFF(month,`Birth`, CURDATE()) AS `months`
                FROM `userinfo`
                WHERE `UserID`='".$_GET['Id']."' AND `Password`='".$_GET['pwd']."'";
        $res = mysqli_query($mysqli,$sql);
        if (mysqli_num_rows($res)==1) { #한 row가 일치하면

            #그 row를 newArray에 할당
            $newArray = mysqli_fetch_array($res, MYSQLI_ASSOC); 

            #세션 변수들 저장
            $_SESSION['UserID']=$newArray['UserID'];
            $_SESSION['pwd']=$newArray['Password'];
            $_SESSION['UserName']=$newArray['UserName'];
            $_SESSION['Sex']=$newArray['Sex'];
            $_SESSION['Birth']=$newArray['Birth'];
            $_SESSION['Addr']=$newArray['Address']; 
            $_SESSION['Ava']=$newArray['avatar'];
            $_SESSION['Months']=$newArray['months'];

            #메인메뉴로 이동
            echo "<script>location.href='MainMenu.php'</script>"; 
        }else { #일치하는 row가 없는 경우
            printf("Could not find record %s",mysqli_error($mysqli));
            echo "<br>";
            printf("Check Your Account Again\n");
            echo "<br>";
            echo "<a href='Login.html'> Go Back TO Login";
        }

    mysqli_close($mysqli);
}
?>
