<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel="stylesheet">
</head>
<body>

<?php
 $server="localhost";
 $user="root";
 $password="";
 $db="users";

 $con=mysqli_connect($server,$user,$password,$db);
 $emailexist=0;
 $passdiff=0;
 $short=0;
 $emailval=0;
 $weakpass=0;

if(isset($_POST['submit'])){
   
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $email= mysqli_real_escape_string($con,$_POST['email']);
    $pass= mysqli_real_escape_string($con,$_POST['pass']);
    $cpass= mysqli_real_escape_string($con,$_POST['cpass']);

    $uppercase = preg_match('@[A-Z]@', $pass);
    $lowercase = preg_match('@[a-z]@', $pass);
    $number    = preg_match('@[0-9]@', $pass);
    $specialChars = preg_match('@[^\w]@', $pass);

    $hpass=password_hash($pass,PASSWORD_BCRYPT);
    $hcpass=password_hash($cpass,PASSWORD_BCRYPT);

    $emailcheck = " select * from user where email='$email' ";
    $query= mysqli_query($con,$emailcheck);
    $emailcount=0;
    $emailcount = mysqli_num_rows($query);
    $a=0;
    $atcount=0;
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailval=1;
    }else{
        $emailval=0;
    }
    if(!$emailval){

    }
    else if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
        $weakpass=1;
    }
    else{
    if($emailcount>0){
        $emailexist=1;
    }
    else{
        if($pass === $cpass)
        {
            $insertquery= "insert into user(name,email,pass) values('$name','$email','$hpass')";
            $iquery = mysqli_query($con,$insertquery);
            echo "";
            header("location:login.php");
        }
        else{
            $passdiff=1;
        }
    }
    }
}

?>
<div class="container">
        <h1>Register yourself</h1>
        <?php 
           /* if($emailval==0){
                echo "<p>Invalid email*</p>";
            }
            else if($short==1){
                echo "<p>Password is too short*</p>";
            }
            else if($emailexist==1){
                echo "<p>Email already exists*</p>";
            }
            else if($passdiff==1)
            {
                echo "<p>Passwords do not match*</p>";
            } */
        ?>
        <p id="error"></p>
        <script>
            var emailval= <?php echo $emailval ?>;
            var short = <?php echo $short ?>;
            var emailexist = <?php echo $emailexist ?>;
            var passdiff = <?php echo $passdiff ?>;
            var weakpass= <?php echo $weakpass ?>;
            var para = document.getElementById('error');
            para.innerHTML="";
            if(emailval==0)
            {
                para.innerHTML="<p>Invalid email*</p>";
            }
            else if(weakpass==1)
            {
                para.innerHTML="<p>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character</p>";
            }
            else if(emailexist==1)
            {
                para.innerHTML="<p>Email already exists*</p>";
            }
            else if(passdiff==1)
            {
                para.innerHTML= "<p>Passwords do not match*</p>";
            }
            setTimeout(clear,6000);
            function clear(){
                para.innerHTML="";
            }
            </script>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?> " method="post">
            <input type="text" name="name" id="name" placeholder="Enter your name" required>
            <input type="email" name="email" id="email" placeholder="Enter your Email" required>
            <input type="password" name="pass" id="pass" placeholder="Enter your Password" required>
            <input type="password" name="cpass" id="cpass" placeholder="Confirm Password" required>
            <button type="submit" name="submit" class="btn">Submit</button> 
        </form>
        <p class="last">Already Registered? <a href="login.php">Log in</a></p>
    </div>
    <?php
    $con->close();
    ?>
</body>
</html>