<?php session_start(); ?>
<html>
    <head>
        <title>ChangeMyInfo</title>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Londrina+Outline|Open+Sans+Condensed:300" rel="stylesheet"> 
        <link rel="stylesheet" href="../Css/Register.css">
    </head>
    <body>
        <div class=frame style="height: 500px;">
        <h1>Let's change my information</h1>
            <form action="Change.php" method="GET">
                ID : <?php echo $_SESSION['UserID']; ?> <br>
                Password <br> <input type='password' name="pwd" maxlength="30"><br>
                Re-enter Password <br> <input type='password' name="rpwd" maxlength="30"><br>
                Name <br> <input type='text' name="UserName" value= <?php echo "'".$_SESSION['UserName']."'" ?> maxlength="50"><br>
                Sex <br> 
                <select name="Sex">
                    <option value="0"> Female </option>
                    <option value="1"> Male </option>
                </select><br> 
                BirthDay <br>
                Year 
                <select name="Year">
                    <option value="2019"> 2019 </option>
                    <option value="2018"> 2018 </option>
                    <option value="2017"> 2017 </option>
                    <option value="2016"> 2016 </option>
                    <option value="2015"> 2015 </option>
                    <option value="2014"> 2014 </option>
                    <option value="2013"> 2013 </option>
                    <option value="2012"> 2012 </option>
                    <option value="2011"> 2011 </option>
                    <option value="2010"> 2010 </option>
                    <option value="2009"> 2009 </option>
                    <option value="2008"> 2008 </option>
                    <option value="2007"> 2007 </option>
                    <option value="2006"> 2006 </option>
                </select> 
                Month 
                <select name="Month"> 
                    <option value="01"> 01 </option>
                    <option value="02"> 02 </option>
                    <option value="03"> 03 </option>
                    <option value="04"> 04 </option>
                    <option value="05"> 05 </option>
                    <option value="06"> 06 </option>
                    <option value="07"> 07 </option>
                    <option value="08"> 08 </option>
                    <option value="09"> 09 </option>
                    <option value="10"> 10 </option>
                    <option value="11"> 11 </option>
                    <option value="12"> 12 </option>
                </select> 
                Day
                <select name="Day"> 
                    <option value="01"> 01 </option><option value="02"> 02 </option><option value="03"> 03 </option>
                    <option value="04"> 04 </option><option value="05"> 05 </option><option value="06"> 06 </option>
                    <option value="07"> 07 </option><option value="08"> 08 </option><option value="09"> 09 </option>
                    <option value="10"> 10 </option><option value="11"> 11 </option><option value="12"> 12 </option>
                    <option value="13"> 13 </option><option value="14"> 14 </option><option value="15"> 15 </option>
                    <option value="16"> 16 </option><option value="17"> 17 </option><option value="18"> 18 </option>
                    <option value="19"> 19 </option><option value="20"> 20 </option><option value="21"> 21 </option>
                    <option value="22"> 22 </option><option value="23"> 23 </option><option value="24"> 24 </option>
                    <option value="25"> 25 </option><option value="26"> 26 </option><option value="27"> 27 </option>
                    <option value="28"> 28 </option><option value="29"> 29 </option><option value="30"> 30 </option>
                    <option value="31"> 31 </option>
                </select> <br>
                Address <br> 
                <select name="Addr">
                    <option value="ewhadong"> ewhadong </option>
                    <option value="comgongdong"> comgongdong </option>
                    <option value="gongdaedong"> gongdaedong </option>
                </select> <br>
            
                Avatar <br> 
                <img src="../image/avatar1.PNG" width="30" height="60">
                <input type='radio' name='Avatar' value='0'>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <img src="../image/avatar2.PNG" width="30" height="60">
                <input type='radio' name='Avatar' value='1'>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <img src="../image/avatar3.PNG" width="30" height="60">
                <input type='radio' name='Avatar' value='2'> 
                
                <br><br>
                <input type=submit value='Change' class="button">
            </form>
        </div>
    </body>
</html>