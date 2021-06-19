<?php 
require_once("../functions/config.php");
if(!isset($_GET['id'])){
    rederict("../home/");
}

$conid = $_GET['id'];
$sql = "SELECT * FROM consultation , patient WHERE consultation.idpatient=patient.id AND idcons=$conid";
$query = query($sql);
if(mysqli_num_rows($query) ==0){
    rederict("../home/");

}
$typename = "";
$result = fetch_array($query);
        $fname = $result['firstname'];
        $lname = $result['lastname'];
        $motif = $result['motif'];
        $type = $result['type'];
        $diagnose = $result['diagnose'];
	$bill = $result['bill'];
        $datecreation = $result['datecreated'];
        $idpatient = $fname ." ".  $lname;

        switch ($type) {
            case 'sha':
            $typename = 'Screening health assessment';
            break;
            case 'pha':
            $typename = 'Periodic health assessment';
            break;
            case 'rwe':
            $typename = 'return-to-work examination';
            break;
            case 'prv':
            $typename = 'pre-return visit';
            break;
            case 'sc':
            $typename = 'Spontaneous consultation';
            break;
            case 'mp':
            $typename = 'Maternity protection';
            break;
            default:
              $typename = "";
          }
        $_SESSION['lang'] = $fname ." " . $lname;

?>
<html>
    <head>
        <link rel="stylesheet" href="../css/pages/show.css">
        <title>ubiclinic | consultation for <?php echo $fname . " " . $lname ;?></title>
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
                        <h1 class="center-text heading-secondary">Consultation for <?php echo $fname . " " . $lname ;?></h1>

                        <svg class="main-icon">
                            <use xlink:href="../css/icon/sprite.svg#icon-user-circle"></use>
                        </svg>
                    </div>
                    <div class="grid margin-top-small">
                        <div class="flexc databox">
                            <h1>id consultation</h1>
                            <h1 class="data"><?php echo $_GET['id'];?></h1>
                        </div>
                        <div class="flexc">
                            <h1>date creation</h1>
                            <h1 class="data"><?php echo $datecreation;?></h1>
                        </div>
<div class="flexc margin-top-smalll">
<div class="flex">
<h1 style="margin-right: 1rem;">bill</h1>
<svg class="money">
                                    <use xlink:href="../css/icon/sprite.svg#icon-money"></use>
                                </svg>
</div>
                            
                            <h1 class="glyphicon glyphicon-remove"><?php echo $bill;?> DA</h1>
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
                            <h1>motif</h1>
                            <h1 class="data"><?php echo $motif;?></h1>
                        </div>
                        <div class="flexc databox">
                            <h1>diagnose</h1>
                            <h1 class="data"><?php echo $diagnose;?></h1>
                        </div>
                    </div>
                    <div class="grid margin-top-small">
                        <div class="flexc databox">
                            <h1>type of the consultation</h1>
                            <h1 class="data"><?php echo $typename;?></h1>
                        </div>
                    </div>
                    <h1>list of exams used in consultation</h1>
                    <div class="gridc">
                            <?php 
                            $sql = "SELECT * FROM examan , examancons WHERE examan.idexam=examancons.idexam AND idcons=$conid";
                            

                            $query = query($sql);
                            
                            if (mysqli_num_rows($query) > 0) {
                                    while($result = fetch_array($query)){
                                        $name = $result['nomexam'];
                                        
                                        echo "<h1 class='data' style='display:block;'>$name</h1>";
                                    }}else{echo $conid . "notthing";}
                            ?>
                        </div>
                            <h1>list of treatement medicines</h1>
                            <div class="gridc">
                            <?php 
                            $sql = "SELECT * FROM medicine , medicinecons WHERE medicine.id=medicinecons.idmedicine AND idcons=$conid";
                        
                            $query = query($sql);
                            $medicnelist = array();
                            if (mysqli_num_rows($query) > 0) {
                                    while($result = fetch_array($query)){
                                        $name = $result['name'];
                                        $usedfor = $result['used-for'];
                                        $medicneid =$result['idmedicine'];
                                        array_push($medicnelist,$medicneid);
                                        echo "<h1 class='data' style='display:block;'>$name  </h1>";
                                    }}else{echo $conid . "notthing";}
                                    $_SESSION['medicines'] = $medicnelist
                            ?>
                        </div>
                            <a href="../prespiction.php" class="createbtn">create prescription</a>
                        
</div>
                        
</div>
</div>
</div>
<?php }else{rederict("../signin/");}?>

</body>
</html>