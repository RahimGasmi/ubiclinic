<?php 
require_once("../functions/config.php");
$msg1="";
if(isset($_POST['submit'])){

    $name = escape($_POST['name']) ;
    $usedfor = escape($_POST['usedfor']) ;
    $dose = escape($_POST['dose']) ;
    $period = escape($_POST['period']) ;

    $sql ="INSERT INTO `medicine` (`name` , `used-for` , `dose`, `period`) VALUES ('$name', '$usedfor', '$dose', '$period');";
    $result = query($sql);
    rederict("#");
  }
  if(isset($_POST['submitexam'])){

    $name = escape($_POST['examname']) ;
    $cost = escape($_POST['cost']) ;


    $sql ="INSERT INTO `examan` (`nomexam` , `cost`) VALUES ('$name', '$cost');";
    $result = query($sql);
    rederict("#");
  } 
  
?>
<html>

<head> 

    <link rel="stylesheet" href="../css/pages/medicine.css">
    <title>ubiclinic | medicine list</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/png">

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
            <div id="popup">
                <div class="new-medicine">
                    <a href="#" class="remove-btn">X</a>

                <form method="POST" class="form">
                    <div class="form-group">
                        <label class="form-label" for="name"> medecine name</label>
                        <input class="form-input" placeholder="enter a medicne name" name="name" class="name" type="text">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="usedfor">used for</label>
                        <input placeholder="what is used for" name="usedfor" class="form-input" type="text">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="usedfor">dose of medicine</label>
                        <input placeholder="calculated in mg" name="dose" class="form-input" type="number" min="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="usedfor">period in days</label>
                        <input placeholder="calculated in mg" name="period" class="form-input" type="number" min="0">
                    </div>
                    <button class="form-btn" name="submit" type="submit">submit</button>
                </form>
            </div>
            </div>

            <div id="popupexam">
                <div class="new-medicine">
                    <a href="#" class="remove-btn">X</a>

                <form method="POST" class="form">
                    <div class="form-group">
                        <label class="form-label" for="examname"> exam name</label>
                        <input class="form-input" placeholder="enter an exam name" name="examname" class="name" type="text">
                    </div>
                   
                    <div class="form-group">
                        <label class="form-label" for="cost">cost</label>
                        <input placeholder="in Da" name="cost" class="form-input" type="number" min="0">
                    </div>
                    <button class="form-btn" name="submitexam" type="submit">submit</button>
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

                        
<li class="side-nav-item active">
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
                    <h1 class="center-text heading-secondary margin-bottom-medium">resources List</h1>
    <div style="max-height:29rem;overflow-y: auto;">
    <h1 class="center-text third margin-bottom-small">Medicine List</h1>
                    <div class="table">
                        <div class="row tab-header">
                          <div class="cell">
                            Name
                          </div>
                          <div class="cell">
                            used for
                          </div>
                          <div class="cell">
                            dose
                          </div>
                          <div class="cell">
                            period
                          </div>
                          <div class="cell">
                            action
                          </div>
                        </div>
                        <?php medicinelist(); ?>

                        

                      </div>
                      </div>
                      <div class="flexx">
                      <a class="createbtn" href="#popup">add new medicine</a>
                      </div>>

                    
                      <div style="max-height:29rem;overflow-y: auto;">
                      <h1 class="center-text third margin-bottom-small">Exams List</h1>

                    <div class="table">
        
                        <div class="row tab-header">
                          <div class="cell">
                            Name
                          </div>
                          <div class="cell">
                            cost
                          </div>
                          <div class="cell">
                            action
                          </div>
                        </div>
                        <?php examlist(); ?>

                        

                      </div>
                      </div>
                      <div class="flexx">
                      <a class="createbtn" href="#popupexam">add new exam</a>
                      </div>
                </div>
                </div>
                <?php }else{rederict("../signin/");}?>

                </body>
                </html>