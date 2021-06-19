<?php 
require_once("../functions/config.php");
$msg1 = "";
$sender = $_SESSION['degree'];

$sql="UPDATE `message` SET seen='yes' WHERE sender <> '$sender'";
query($sql);
if($sender=="doctor"){$img="../img/nurse.png";}elseif($sender=="secretaire"){$img="../img/doctor.png";}
if(isset($_POST['submit'])){
    $msg = escape($_POST['msg']) ;
    $sql="INSERT INTO `message` (`sender`, `msg`) VALUES ('$sender', '$msg')";
    $result = query($sql);
    rederict("#");

}
?>
<html>
    <head>
        <link rel="stylesheet" href="../css/pages/messages.css">
        <title>ubiclinic | messages</title>
        <link rel="shortcut icon" href="../img/logo.png" type="image/png">

    </head>
    <body>
    <?php if(isset($_SESSION['username'])){?>

        <div class="content">
         
        <?php include("../functions/header.php");?>

            <div class="container">
                <div id="popup">
                    <div class="new-msg">
                        <a href="" class="remove-btn">X</a>
    
                    <form class="form" method="POST">
                        <div class="form-group">
                            <label class="form-label" for="msg"> message</label>
                            <textarea class="form-input" name="msg" placeholder="enter msg here" required></textarea>
                        </div>
                        <?php echo $msg1;?>

                        <button name="submit" class="form-btn" type="submit">submit</button>
                    </form>
                </div>
                </div>
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
                        <li class="side-nav-item">
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

                        <li class="side-nav-item active">
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
                    <h1 class="center-text heading-secondary margin-bottom-small">message recived</h1>

                    <div class="msg">
                        <?php
$sql = "SELECT * FROM message WHERE sender <> '$user' ORDER BY date DESC";
$query = query($sql);
  
   if (mysqli_num_rows($query) > 0) {
    while($result = fetch_array($query)){
        $id = $result['id'];
        $msg = $result['msg'];
        $date = $result['date'];
$prodoct = <<<String
<div class="msg-box">
<img class="msg-img" src="$img" alt="">
<div class="msg-content">
    <p class="message">$msg</p>
    <h3 class="date">$date</h3>
</div>
</div>
String;
    echo $prodoct;
    }}
                        ?>
                       
                    </div>
                    <div style="position: relative;"><a href="#popup" class="msg-btn">send a message</a></div>
</div>
</div>
</div>
<?php }else{rederict("../signin/");}?>

</body>
</html>