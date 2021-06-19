<?php
require_once("../functions/config.php");

$msg="";
if(isset($_POST['submit'])){
    $name = escape($_POST['username']) ;
    $password = escape($_POST['password']);
    $query = query("Select * FROM user WHERE username = '$name' And password = '$password'");
    if(mysqli_num_rows($query) > 0){
        $result = fetch_array($query);
        $degree = $result['degree'];
        $fname = $result['firstname'];
        $sname = $result['lastname'];
        $fullname = $fname . " " . $sname;
        $email = $result['email'];
        $phone = $result['phone'];
        $msg ="<div class='alert alert-succes' style='margin-top:1rem'>Login successful
        <span style='color:#73ea73'>Redercting</span>
        </div>";

        $_SESSION['username'] = $name;
        $_SESSION['degree'] = $degree;
        $_SESSION['lname'] = $sname;
        $_SESSION['name']  = $fullname;
        $_SESSION['email'] = $email;
        $_SESSION['phone']  = $phone;
        header("Refresh:1;../home");

}

    else{
        $msg ="<div class='alert alert-danger' style='margin-top:1rem'> username or password are wrong</div>";
}
    

}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="../css/pages/signin.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../img/logo.png" type="image/png">

        <title>login</title>
    </head>
    <body>
        <div class="bage">
            <div class="form-title">
                <h1 class="form-title-head">Welecome to ubiclinic</h1>
                <p class="form-title-sub">Ubiclinic is website and system build to help doctors and their secretaries to manage and control patients easily and efficiently and promised to give a set of useful functions  </p>
                <a href="#" class="form-title-btn">know more</a>
                
            </div>
            
            <div class="form">
                <h1 class="form-head">
                    login 
                </h1>
                <form class="sign" method="POST">
                    <div class="form-group">
                    <input type="text" id="username" name="username" value="<?php inputvalue("username"); ?>" class="name input" placeholder="username" required> 
                    <label class="form-label"  for="username">username</label>
                </div>
                    <div class="form-group">
                    <input type="password" id="password" name="password" class="password input" placeholder="password" required>
                    <label class="form-label"  for="password">password</label></div>  
                    <button type="submit" name="submit" class="form-btn">submit</button>
                    <?php echo $msg;?>

                 
                </form>
            </div>

        </div>
    </body>
</html>