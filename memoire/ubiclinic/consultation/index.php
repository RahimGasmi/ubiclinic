<?php 
require_once("../functions/config.php");
if(!isset($_GET['appid'])){
    rederict("../home/");
}
$idapp = $_GET['appid'];
$patientid = $_GET['patientid'];
$sql ="SELECT * FROM `appointments` WHERE `state`='complete' AND `appid`= $idapp AND 'patientid' = $patientid" ;
$result = query($sql); 
$sql2 ="SELECT * FROM `appointments` WHERE `appid`=$idapp AND `patientid`=$patientid";
$result2 = query($sql2); 
$sql2 ="SELECT * FROM `appointments` WHERE `appid`=$idapp AND `patientid`=$patientid";
$result2 = query($sql2); 
if(mysqli_num_rows($result) !=0 || mysqli_num_rows($result2) ==0 || !testapp($idapp,$patientid)){
    rederict("../home/");
}
if(isset($_POST['submit'])){
    $motif = escape($_POST['motif']) ;
    $type = escape($_POST['type']) ;
    $diagnose = escape($_POST['diagnose']) ;
    $bill = 0;
    foreach($_POST['exams'] as $exam){
        $query = query("Select cost FROM examan WHERE nomexam = '$exam'");
        $result = fetch_array($query);
        $bill += $result['cost'];
        

    }
    $sql ="INSERT INTO `consultation` (`idpatient`, `idapp`, `motif`, `type`, `diagnose` , `bill`) 
    VALUES ('$patientid', $idapp, '$motif', '$type', '$diagnose', '$bill');";
        $result = query($sql);
        $query = query("Select idcons FROM consultation WHERE idpatient = '$patientid' AND motif='$motif' AND type='$type'
        AND diagnose = '$diagnose'");
        $result = fetch_array($query);
        $consid= $result['idcons'];
        $sql ="UPDATE `appointments` SET `state`='complete' WHERE `appid`= $idapp";
            $result = query($sql);    
            $sql ="UPDATE `patient` SET `numvisite`=numvisite+1 WHERE id=$patientid";
            $result = query($sql);
    foreach($_POST['exams'] as $exam){
        $query = query("Select idexam FROM examan WHERE nomexam = '$exam'");
        $result = fetch_array($query);
        $examid= $result['idexam'];
        $sql ="INSERT INTO `examancons` (`idexam` , `idcons` , `idpat`) VALUES ('$examid', $consid, '$patientid');";
        $query = query($sql);

    }
    foreach($_POST['medicines'] as $medicine){
        $medicineid= $medicine;
        $sql ="INSERT INTO `medicinecons` (`idmedicine` , `idcons` , `idpat`) VALUES ('$medicineid', $consid, '$patientid');";
        $query = query($sql);

    }
    rederict("show.php?id=$consid");
  }
   
  
?>
<html>

<head> 
    <link rel="stylesheet" href="../css/pages/consultation.css">
    <link rel="stylesheet" href="../css/pages/patient.css">

    <title>ubiclinic | new consultation</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/png">
    <script src="../js/jQuery.js"></script>
    <script src="../js/select/src/assets/js/jquery-searchbox.js"></script>
    <link rel="stylesheet" href="../js/multiselect/jquery.multiselect.css">
<script src="../js/multiselect/jquery.multiselect.js"></script>
</style>
</head>

<body>
<?php if(isset($_SESSION['username'])){
        if($_SESSION['degree']=="secretaire"){
            rederict("../home/");
        }?>

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
                        <a href="../message" class="side-nav-link">
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
                    <h1 class="center-text heading-secondary margin-bottom-medium">create consultation</h1>

                    <form method="post" class="form">

                        <div class="left-form">
                        
    <div class="form-group">

            <svg class="icon-form">
                <use xlink:href="../css/icon/sprite.svg#icon-user-md"></use>
            </svg>

        <input type="text" name="motif" placeholder="motif" class="form-input" required>

    </div>
    <div>
    <div class="select-input">
        <svg class="icon-form smaller">
            <use xlink:href="../css/icon/sprite.svg#icon-file"></use>
        </svg>
   <select name="type" id="examan" style="color: gray;" required>
    <option value="" disabled selected hidden >Choose a consultation type</option>
        <option value="sha">Screening health assessment</option>
        <option value="pha">Periodic health assessment</option>
                <option value="rwe">return-to-work examination</option>
                <option value="prv">pre-return visit</option>
                <option value="sc">Spontaneous consultation</option>
                <option value="mp">Maternity protection</option>

      </select>
    </div>
</div>
<label class="label" for="exams">choose exams </label>
    <div class="form-group" style="position: relative;">
                        <select name="exams[]" class="demo" multiple required>
                          <?php examselect(); ?>

                          </select>
                    </div>
                        </div>
                        <div class="right-form">
                            <button type="submit" name="submit" class="btn-form margin-bottom-small">submit</button>
                            <div class="form-group">
        <svg class="icon-form">
            <use xlink:href="../css/icon/sprite.svg#icon-gears"></use>
        </svg>

    <input type="text" name="diagnose" placeholder="diagnose" class="form-input" required>

</div>

        </svg>
               <label class="label" for="medicines">choose medicines for treatement</label>

        <div class="form-group" style="position: relative;">
                        <select name="medicines[]" class="demo" multiple required>
                          <?php medicineselect(); ?>

                          </select>

</div>
                        </div>
                    </form>
                <script>
                    $('.js-searchBox').searchBox({elementWidth:'100%'});
                    $('select[multiple]').multiselect({
                        columns: 1, 
                        search : true,
                        searchText   : true,
                        searchValue  : false,
                        placeholder    : 'you can select multiple or search', // text to use in dummy input
      search         : 'Search',         // search input placeholder text
      selectedOptions: ' selected',      // selected suffix text
      selectAll      : 'Select all',     // select all text
      unselectAll    : 'Unselect all',   // unselect all text
      noneSelected   : 'None Selected',   // None selected text
  maxHeight          : 150,  // maximum height of option overlay
                    });

                   </script>
                    <div class="overview">
                        <h1 class="center-text heading-secondary margin-bottom-medium"> details of patient
                        </h1>
<?php 
$result = patientdetails($patientid);
$fname = $result['firstname'];
$lname = $result['lastname'];
$age = $result['age'];
$weight = $result['weight'];
$height = $result['height'];
$gender =$result['gender'];
$blood =$result['blood'];
?>
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
                </div>
                <?php }else{rederict("../signin/");}?>

                </body>
                </html>