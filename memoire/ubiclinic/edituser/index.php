<?php 
require_once("../functions/config.php");
?>
<html>

<head>
    <link rel="stylesheet" href="../css/pages/edituser.css">
    <title>ubiclinic | patient list</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/png">

</head>

<body>
<?php if(isset($_SESSION['username'])){?>

    <div class="content">
    <?php include("../functions/header.php");?>

        <div class="container">
          <div id="popup">
            <div class="new-medicine">
                <a href="#" class="remove-btn">X</a>

                <form method="POST" class="form">
                  <div class="form-group">
                      <label class="form-label" for="name"> name</label>
                      <input class="form-input" placeholder="enter a medicne name" name="name" class="name" type="text">
                  </div>
                  <div class="form-group">
                      <label class="form-label" for="age">age</label>
                      <input class="form-input" placeholder="enter a medicne name" name="age" class="name" type="number" min="0">
                  </div>
                  <div class="form-group">
                      <label class="form-label" for="phone">phone</label>
                      <input class="form-input" placeholder="enter a medicne name" name="phone" class="name" type="number" min="0">
                  </div>
                  <div class="form-group">
                      <label class="form-label" for="email">email</label>
                      <input class="form-input" placeholder="enter a medicne name" name="email" class="name" type="text">
                  </div>
                  <button class="form-btn" name="submit" type="submit">submit</button>
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
                <li class="side-nav-item active">
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
                <h1 class="center-text heading-secondary margin-bottom-medium">Patient List</h1>
                <div style="max-height:50rem;overflow-y: auto;">

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
                      <div class="cell">
                        action
                      </div>
                    </div>
                    <?php patientlist(); ?>

                    
                  </div>
                </div>
            </div>
        </div>
    </div>
    <?php }else{rederict("../signin/");}?>

</body>

</html>