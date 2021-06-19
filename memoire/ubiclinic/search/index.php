
<?php 
require_once("../functions/config.php");

  
?>
<html>
<?php if(isset($_SESSION['username']) and isset($_GET['search'])){?>
<head>

    <link rel="stylesheet" href="../css/pages/search.css">
    <title>ubiclinic |  search for  <?php echo $_GET['search'];?></title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/png">

</style>
</head>

<body>


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
                <h1 class="center-text heading-secondary margin-bottom-medium">search for : <?php echo $_GET['search'];?></h1>

                <div class="search-cards">
                <?php searchlist($_GET['search']); ?>
                </div>
                </div>
                </div>
                </div>
                <?php }else{rederict("../signin/");}?>

                </body>
                </html>
                