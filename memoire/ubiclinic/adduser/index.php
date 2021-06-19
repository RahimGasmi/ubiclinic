<?php 

require_once("../functions/config.php");

$msg1=$msg2=$msg3=$msg4=$msg5=$msg6=$msg7="";
if(isset($_POST['submit'])){
    $fname = escape($_POST['firstname']) ;
    $lname = escape($_POST['lastname']) ;
    $age = escape($_POST['age']) ;
    if(isset($_POST['gender'])){
    $gender = escape($_POST['gender']) ;}
    if(isset($_POST['blood'])){
        $blood = escape($_POST['blood']) ;}
    $email = escape($_POST['email']);
    $phone = escape($_POST['phone']);
    $weight = escape($_POST['weight']);
    $height = escape($_POST['height']);
if(isset($_POST['weight'])){
        $weight = 0;}
if(isset($_POST['height'])){
        $height = 0;}
    if(empty($fname)){
        $msg1 = "<div class='alert alert-danger'> first name is required </div>";
    }
    else if(empty($lname)){
        $msg2 = "<div class='alert alert-danger'> last name is required </div>";
    }
    else if(empty($age)){
        $msg3 = "<div class='alert alert-danger'>age is required </div>";
    }
    else if(!isset($_POST['gender'])){
        $msg4 = "<div class='alert alert-danger'>gender is required </div>";

    }
    else if(!isset($_POST['blood'])){
        $msg5 = "<div class='alert alert-danger'>blood type is required </div>";

    }
    else if(empty($phone)){
        $msg6 = "<div class='alert alert-danger'>phone number is required </div>";
    }
else{
    $sql ="SELECT * FROM `patient` WHERE `firstname` = '$fname' AND `lastname` = '$lname' AND `age` = $age AND `gender` = '$gender' AND `phone` = $phone";
    $result = query($sql);
    if(mysqli_num_rows($result) < 1){
    $sql ="INSERT INTO `patient` (`firstname`, `lastname`, `age`, `gender`, `email`, `phone`, `blood`, `weight`, `height`) VALUES ('$fname', '$lname', '$age', '$gender', '$email', '$phone', '$blood', '$weight', '$height')";
    ;
	if (query($sql)) {
      $msg7="<div class='alert alert-succes'> patient added successfully</div>"; 
    header("Refresh:4;../edituser/");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}


} else { 

            $msg7="<div class='alert alert-danger' style='margin-top: 60px;'>patient already exist</div>";
        }
}
}
 

?> 
<html>
    <head>
        <link rel="stylesheet" href="../css/pages/adduser.css">
        <title>ubiclinic | add new user</title>
        <link rel="shortcut icon" href="../img/logo.png" type="image/png">

    </head> 
    <body>
    <?php if(isset($_SESSION['username'])){?>

        <div class="content">
        <?php include("../functions/header.php");?>
 
            <div class="container">
                <nav class="sidebar">
                    <ul class="side-nav">
                        <li class="side-nav-item">
                            <a href="../home" class="side-nav-link ">
                                <svg class="side-nav-icon">
                                    <use xlink:href="../css/icon/sprite.svg#icon-home"></use>
                                    <span>dashbord</span>
                                </svg>
                            </a>
                        </li>
                        <li class="side-nav-item active">
                            <a href="../adduser" class="side-nav-link">
                                <svg class="side-nav-icon">
                                    <use xlink:href="../css/icon/sprite.svg#icon-user-plus"></use>
                                    <span>add patient</span>
                                </svg>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="../edituser" class="side-nav-link">
                                <svg class="side-nav-icon">
                                    <use xlink:href="../css/icon/sprite.svg#icon-user-minus"></use>
                                    <span>patient list</span>
                                </svg>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="../appointement" class="side-nav-link">
                                <svg class="side-nav-icon">
                                    <use xlink:href="../css/icon/sprite.svg#icon-group"></use>
                                    <span>appointment list</span>
                                </svg>
                            </a>
                        </li> 
                        <?php if($_SESSION['degree']=="doctor"){?>

                        
                        <li class="side-nav-item">
                            <a href="../medicine" class="side-nav-link">
                                <svg class="side-nav-icon">
                                    <use xlink:href="../css/icon/sprite.svg#icon-stethoscope"></use>
                                    <span>resources list</span>
                                </svg>
                            </a>
                        </li> 
                        <?php } ?>
                        <li class="side-nav-item">
                            <a href="../message/" class="side-nav-link">
                                <svg class="side-nav-icon">
                                    <use xlink:href="../css/icon/sprite.svg#icon-envelope"></use>
                                    <span>messages</span>
                                </svg>
                            </a>
                        </li> 
                    </ul>
                    <div class="legal">
                        &copy; 2021 By abderragmen gasmi . for liscence project
                    </div>
                </nav>
                <div class="main">
                    <h1 class="center-text heading-secondary">enter a new patient</h1>

                    <svg class="main-icon">
                        <use xlink:href="../css/icon/sprite.svg#icon-user-circle"></use>
                    </svg>
                    <p class="paragraphe red">* means it required</p>
                    <form method="post" class="form">

                        <div class="left-form">
                            <div class="form-group">
    
                                    <svg class="icon-form">
                                        <use xlink:href="../css/icon/sprite.svg#icon-user-circle"></use>
                                    </svg>
    
                                <input type="text" name="firstname" placeholder="first name" class="form-input">
                                                            <div class="mark">*</div>
    
                            </div>
                            <?php echo $msg1;?>
                            <div class="form-group">
                                <svg class="icon-form">
                                    <use xlink:href="../css/icon/sprite.svg#icon-user-circle"></use>
                                </svg>
    
                            <input type="text" name="lastname" placeholder="last name" class="form-input">
                            <div class="mark">*</div>
    
                        </div>
                        <?php echo $msg2;?>
                        <div class="form-group">
                                <svg class="icon-form smaller">
                                    <use xlink:href="../css/icon/sprite.svg#icon-calendar"></use>
                                </svg>
    
                            <input type="number" name="age" placeholder="age" class="form-input" min="0">
                            <div class="mark">*</div>
    
                        </div>
                        <?php echo $msg3;?>
                        <!-- <div class="alert alert-danger">test</div> -->
                       
    
    
                        <div>
                            <div class="select-input">
                                <svg class="icon-form smaller">
                                    <use xlink:href="../css/icon/sprite.svg#icon-venus-mars"></use>
                                </svg>
                           <select name="gender" id="sex" style="color: gray;">
                            <option value="" disabled selected hidden >Choose a gender</option>
                                <option value="male">male</option>
                                <option value="female">female</option>
                              </select>
                              <div class="mark mark-select">*</div>
                            </div>
                        </div>
                        <?php echo $msg4;?>
                        <div>
                            <div class="select-input">
                                <svg class="icon-form smaller">
                                    <use xlink:href="../css/icon/sprite.svg#icon-tint"></use>
                                </svg>
                           <select name="blood" id="sex" style="color: gray;">
                            <option value="" disabled selected hidden >Choose a bloode</option>
                                <option value="O-">O-</option>
                                <option value="O+">O+</option>
                                <option value="A-">A-</option>
                                <option value="A+">A+</option>
                                <option value="B-">B-</option>
                                <option value="B+">B+</option>
                                <option value="AB-">AB-</option>
                                <option value="AB+">AB+</option>
                              </select>
                              <div class="mark mark-select">*</div>
                            </div>
                        </div>
                        <?php echo $msg5;?>
                        </div>
                        <div class="right-form">
                            <button type="submit" name="submit" class="btn-form margin-bottom-small">submit</button>
                            <div class="form-group">
    
                                <svg class="icon-form smaller">
                                    <use xlink:href="../css/icon/sprite.svg#icon-envelope"></use>
                                </svg>
    
                            <input type="email" name="email" class="form-input" placeholder="enter your email">
                            <div class="mark hidden">*</div>
    
                        </div>
                        <div class="form-group">
                            <svg class="icon-form smaller">
                                <use xlink:href="../css/icon/sprite.svg#icon-phone"></use>
                            </svg>
    
                        <input type="tel" name="phone" class="form-input" placeholder="enter your phone number">
                        <div class="mark">*</div>
    
                    </div>
                    <?php echo $msg6;?>
                    <div class="form-group">
                        <svg class="icon-form smaller">
                            <use xlink:href="../css/icon/sprite.svg#icon-weight"></use>
                        </svg>

                    <input type="number" name="weight" min="1" class="form-input" placeholder="enter your width on kg">
                    <div class="mark hidden">*</div>

                </div>
                <div class="form-group">
                    <svg class="icon-form smaller">
                        <use xlink:href="../css/icon/sprite.svg#icon-height"></use>
                    </svg>

                <input type="number" name="height" min="1" class="form-input" placeholder="enter your height on cm">
                <div class="mark hidden">*</div>

            </div>
            <?php echo $msg7;?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
           
        </script>
                                    <?php }else{rederict("../signin/");}?>

    </body>
</html>