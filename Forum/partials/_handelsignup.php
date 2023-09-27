<?php
$showAlert=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';

    $user_email=$_POST['signupemail'];
    $pass=$_POST['signupPassword'];
    $cpass=$_POST['signupcPassword'];
    
    $existsql="SELECT * FROM `users` WHERE user_email='$user_email'";
    $result = mysqli_query($conn,$existsql);
    $numrows = mysqli_num_rows($result);
    if($numrows > 0){
        $showError="Email already use";
    }
    else{
        if($pass==$cpass){
            $hash=password_hash($password, PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`)  VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn,$sql);

            if($result){
                $showAlert=true;
                header("location:/Forum/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError="Passwords do not match";     
        }
    }
    header("location:/Forum/index.php?signupsuccess=false&error=$showError");
    
}
?>