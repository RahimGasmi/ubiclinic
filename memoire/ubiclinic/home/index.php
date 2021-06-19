<?php 
require_once("../functions/config.php");
$sql = "Select count(*) FROM patient";
$result = query($sql);
$row = mysqli_fetch_row($result);
$patients = $row[0];
$sql = "Select count(*) FROM medicine";
$result = query($sql);
$row = mysqli_fetch_row($result);
$medicine = $row[0];
$sql = "Select count(*) FROM appointments";
$result = query($sql);
$row = mysqli_fetch_row($result);
$appointment = $row[0];
$appointementtoday = numberapp();
$sql = "Select count(*) FROM consultation";
$result = query($sql);
$row = mysqli_fetch_row($result);
$consultation = $row[0];
$sql = "Select count(*) FROM examan";
$result = query($sql);
$row = mysqli_fetch_row($result);
$examan = $row[0];
$today = date("Y-m-d");
$sql = "delete from message where date < DATE_SUB(NOW() , INTERVAL 15 DAY)";
query($sql);
?>
<html>
    <head>
        <link rel="stylesheet" href="../css/pages/home.css">
        <title>ubiclinic | dashbord</title>
        <link rel="shortcut icon" href="../img/logo.png" type="image/png">

    </head>
    <body>
    <?php if(isset($_SESSION['username'])){?>

        <div class="content">
        <?php include("../functions/header.php");?>

            <div class="container">
                <nav class="sidebar">
                    <ul class="side-nav">
                        <li class="side-nav-item active">
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
                        ubiclinic Dashbord
                    </div>
                    <h1 class="center-text heading-secondary">Statics of the clinic</h1>

                    <div class="cards">
                        <div class="card pat">
                            <div class="card-cont">
                                <div class="cont-number"><?php echo $patients; ?></div>
                                <div class="cont-name">Total patient</div>
                            </div>
                            <div class="card-icon">
                                <svg class="card-icon">
                                    <use xlink:href="../css/icon/sprite.svg#icon-user"></use>
                                </svg>
                            </div>
                        </div>
                        <div class="card app">
                            <div class="card-cont">
                                <div class="cont-number"><?php echo $appointment; ?></div>
                                <div class="cont-name">total appointement</div>
                            </div>
                            <div class="card-icon">
                                <svg class="card-icon">
                                    <use xlink:href="../css/icon/sprite.svg#icon-map"></use>
                                </svg>
                            </div>
                        </div>
                        <div class="card app">
                            <div class="card-cont">
                                <div class="cont-number"><?php echo $appointementtoday; ?></div>
                                <div class="cont-name">appointement today</div>
                            </div>
                            <div class="card-icon">
                                <svg class="card-icon">
                                    <use xlink:href="../css/icon/sprite.svg#icon-map"></use>
                                </svg>
                            </div>
                        </div>
                        <?php if($_SESSION['degree']=="doctor"){?>
                        <div class="card app">
                            <div class="card-cont">
                                <div class="cont-number"><?php echo $consultation; ?></div>
                                <div class="cont-name">total consultation</div>
                            </div>
                            <div class="card-icon">
                                <svg class="card-icon">
                                    <use xlink:href="../css/icon/sprite.svg#icon-file"></use>
                                </svg>
                            </div>
                        </div>
                        <div class="card tes">
                            <div class="card-cont">
                                <div class="cont-number"><?php echo $medicine; ?></div>
                                <div class="cont-name">total medicine</div>
                            </div>
                            <div class="card-icon"> 
                                <svg class="card-icon">
                                <use xlink:href="../css/icon/sprite.svg#icon-eyedropper"></use>
                            </svg></div>
                        </div>
                        <div class="card pat">
                            <div class="card-cont">
                                <div class="cont-number"><?php echo $examan; ?></div>
                                <div class="cont-name">total exams</div>
                            </div>
                            <div class="card-icon"> 
                                <svg class="card-icon">
                                <use xlink:href="../css/icon/sprite.svg#icon-flask"></use>
                            </svg></div>
                        </div>
                        <?php } ?>
                    </div>


                    <h1 class="center-text heading-secondary margin-bottom-small">list of patients registred</h1>
                    <div class="table">
    
                        <div class="row tab-header">
                          <div class="cell">
                            name
                          </div>
                          <div class="cell">
                            age
                          </div>
                          <div class="cell">
                            gender
                          </div>
                          <div class="cell">
                            blood
                          </div>
                          <div class="cell">
                            phone
                          </div>
                          <div class="cell">
                            email
                          </div>
                         
                        </div>
                        <?php patientlistlimit(); ?>

                        
                      </div>
                      <div class="table-place"><a href="../edituser" class="table-btn">See All</a></div>
                      <div class="clear"></div>
                      <h1 class="center-text heading-secondary margin-bottom-small">list of appointement </h1>
                      <div class="table">
      
                          <div class="row tab-header">
                          <div class="cell">
                              number
                            </div>
                            <div class="cell">
                              name
                            </div>
                            <div class="cell">
                              age
                            </div>
                            <div class="cell">
                              phone
                            </div>
                            <div class="cell">
                              date
                            </div>
                            <div class="cell">
                              time
                            </div>
                          </div>
                          <?php appointmentlistlimit(); ?>
                        </div>
                        <div class="table-place"><a href="../appointement" class="table-btn">See All</a></div>
                        <div class="clear"></div>
                </div>
            </div>
        </div>
        <script>
           
        </script>
                                            <?php }else{rederict("../signin/");}?>

    </body>
</html>