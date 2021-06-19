<div class="header">
            <a href="../home" class="logo">
                <img src="../img/logo.png" alt="logo" class="logo-img">
                <img src="../img/logo-text.png" alt="logo-text" class="logo-text">
            </a>
            <form action="../search" method="GET" class="search">
                <input type="text" class="search-input" placeholder="search patient" id="search" name="search">
                <button class="search-btn">
                    <svg class="search-icon">
                        <use xlink:href="../css/icon/sprite.svg#icon-magnifying-glass"></use>
                    </svg>
                </button>
            </form>
            <nav class="user-nav">
                <div class="user-nav-icon-box">
                    <input type="checkbox" name="enable" id="enable">
                    <label for="enable" class="notify">
                        <svg class="user-nav-icon">
                            <use xlink:href="../css/icon/sprite.svg#icon-chat"></use>
                        </svg>
                        <?php
                        $user = $_SESSION['degree'];
                        $sql = "SELECT count(*) FROM message WHERE sender <> '$user' AND seen <> 'yes'";
                        $result = query($sql);
$row = mysqli_fetch_row($result);
$notification = $row[0]; 
                        ?>
                        <span class="user-notification"><?php echo $notification; ?></span></label>
                    <div class="notification">
                        <?php
                        if($user=="doctor"){$img="../img/nurse.png";}elseif($user=="secretaire"){$img="../img/doctor.png";}
                        $sql = "SELECT * FROM message WHERE sender <> '$user' AND seen <> 'yes' ORDER BY date DESC LIMIT 3";
   $query = query($sql);
  
   if (mysqli_num_rows($query) > 0) {
    while($result = fetch_array($query)){
        $id = $result['id'];
        $sender = $result['sender'];
        $msg = $result['msg'];
        $date = $result['date'];
$prodoct = <<<String
<div class="notification-card">
                            <div class="user-box">
                                <img src="$img" alt="logo" class="notification-photo">
                                <div class="user-box-content">
                                    <p class="user-box-name">$sender</p>
                                    <p class="user-box-date">$date</p>
                                </div>
                            </div>
                            <p class="desc-msg">$msg</p>

                        </div>
String;
    echo $prodoct;
    }
echo "                        <a href='../message/' class='notification-btn'>See all</a>
";
}else{
        echo "<h1 class='nomsg'>there is no new msg</h1>";
    }
                        ?>                        
                    </div>
                </div>

                <div class="user-nav-user">
                    <input type="checkbox" name="logout" id="logout">
                    <label for="logout" class="user-nav-user">
                        <?php if($_SESSION['degree']=="doctor"){ ?>
                        <img src="../img/doctor.png" alt="logo" class="user-nav-user-photo">
                        <?php }elseif($_SESSION['degree']=="secretaire"){ ?>
                            <img src="../img/nurse.png" alt="logo" class="user-nav-user-photo">
<?php }?>
                        <span class="user-name"><?php echo $_SESSION['username']; ?></span></label>
                    <div class="param">
                        <a class="logout" href="../functions/logout.php">
                            <svg class="logout-icon">
                                <use xlink:href="../css/icon/sprite.svg#icon-power-off"></use>
                            </svg>
                            <p class="logout-name">
                                logout
                            </p>
                        </a>
                    </div>
                </div>
            </nav>
        </div>