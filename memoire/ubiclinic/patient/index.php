<?php 
require_once("../functions/config.php");
if(!isset($_GET['id'])){
    rederict("../home/");
}
$id = $_GET['id'];
$idpatient = $_GET['id'];
$result = patientdetails($id);
        $fname = $result['firstname'];
        $lname = $result['lastname'];
        $age = $result['age'];
        $phone = $result['phone'];
        $email = $result['email'];
        $datecreation = $result['datecreation'];        
        $weight = $result['weight'];
        $height = $result['height'];
        $gender =$result['gender'];
        $blood =$result['blood'];
        $numvisite =$result['numvisite'];

?>
<html>
    <head>
        <link rel="stylesheet" href="../css/pages/patient.css">
        <title>ubiclinic | patient <?php echo $fname . " " . $lname ;?></title>
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
                    <div class="main-title">
                        <h1 class="center-text heading-secondary">information patient</h1>

                        <svg class="main-icon">
                            <use xlink:href="../css/icon/sprite.svg#icon-user-circle"></use>
                        </svg>
                    </div>
                    <div class="grid margin-top-small">
                        <div class="flexc databox">
                            <h1>id patient</h1>
                            <h1 class="data"><?php echo $_GET['id'];?></h1>
                        </div>
                        <div class="flexc">
                            <h1>date creation</h1>
                            <h1 class="data"><?php echo $datecreation;?></h1>
                        </div>
                        
                    </div>
                    <div class="grid margin-top-small">
                        <div class="flexc databox">
                            <h1>first name</h1>
                            <h1 class="data"><?php echo $fname;?></h1>
                        </div>
                        <div class="flexc">
                            <h1>last name</h1>
                            <h1 class="data"><?php echo $lname;?></h1>
                        </div>
                    </div>
                    <div class="grid margin-top-small">
                        <div class="flexc databox">
                            <h1>age</h1>
                            <h1 class="data"><?php echo $age;?></h1>
                        </div>
                        <div class="flexc">
                            <h1>gender</h1>
                            <h1 class="data"><?php echo $gender;?></h1>
                        </div>
                    </div>
                    <div class="grid margin-top-small">
                        <div class="flexc databox">
                            <h1>weight</h1>
                            <h1 class="data"><?php echo $weight;?> kg</h1>
                        </div>
                        <div class="flexc  databox">
                            <h1>height</h1>
                            <h1 class="data"><?php echo $height;?> cm</h1>
                        </div>
                        <div class="flexc  databox">
                            <h1>blood</h1>
                            <h1 class="data"><?php echo $blood;?></h1>
                        </div>
                    </div>
                    <div class="grid margin-top-small">
                        <div class="flexc databox">
                            <h1>phone</h1>
                            <h1 class="data"><?php echo $phone;?></h1>
                        </div>
                        <div class="flexc">
                            <h1>email</h1>
                            <h1 class="data"><?php echo $email;?></h1>
                        </div>
                        
                    </div>
                    <h1>number of visite</h1> 
                            <h1 class="data"><?php echo $numvisite;?></h1>
                            
                            
                            <?php 
                            
                            if($_SESSION['degree']=='doctor'){
                                echo "<h1>previous consultation</h1> ";
                            echo "<div class='gridc'>";
                            $sql = "SELECT * FROM consultation WHERE idpatient = $idpatient";
                        
                            $query = query($sql);
                            $medicnelist = array();
                            $i = 1;
                            if (mysqli_num_rows($query) > 0) {
                                    while($result = fetch_array($query)){
                                        $idcons = $result['idcons'];

                                        echo "<div class='card'>
                                        <a href='../consultation/show.php?id=$idcons' class='data' style='display:block;'>
                                        Consultation number $i  </a></div>";
                                        $i++;
                                    }}else{echo "<h1 class ='previous'>the patient didnt make any consultation in clinic</h1>";}}
                            echo "</div>";
                            ?>
                            
</div>
</div>
</div>
<?php }else{rederict("../signin/");}?>

</body>
</html>