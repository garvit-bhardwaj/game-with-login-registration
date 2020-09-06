<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel="stylesheet">
</head>
<body>
<?php

$server="localhost";
$user="root";
$password="";
$db="users";

$con=mysqli_connect($server,$user,$password,$db);

$passwrong=0;
$notexist=0;


if(isset($_POST['submit'])){
    $email= $_POST['email'];
    $pass=  $_POST['pass'];

    $emailcheck= "select * from user where email='$email' ";
    $query=mysqli_query($con,$emailcheck);
    $emcount=mysqli_num_rows($query);
    if($emcount)
    {
        $regpass= mysqli_fetch_assoc($query);
        $checkpass= $regpass['pass'];
        $succ= password_verify($pass,$checkpass);
        if($succ){
            $_SESSION['name']=$regpass['name'];
            header("location:game.php");
        } 
        else{
            $passwrong=1;
        }
    }
    else{
        $notexist=1;
    }
}

?>
    <div class="container">
    <h1>Login </h1>
    <?php
    
    if($notexist==1)
    {
        echo "<p>Email is not registered*</p>";
    }
    else if($passwrong==1)
    {
        echo "<p>Wrong Password*</p>";
    }

    ?>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?> " method="post">
            <input type="email" name="email" id="email" placeholder="Enter your registered Email" required>
            <input type="password" name="pass" id="pass" placeholder="Enter your registered Password" required>
            <button type="submit" name="submit" class="btn">Log in</button> 
        </form>
        <p class="last">New here? <a href="index.php">Register First</a></p>
    </div>
</body>
</html>