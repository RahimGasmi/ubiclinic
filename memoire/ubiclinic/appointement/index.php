<?php 
require_once("../functions/config.php");
$msg="";
$numtoday = numberapp();
$error = false;
if(isset($_POST['submit'])){

  $name = escape($_POST['lang']) ;
  $date = escape($_POST['date']) ;
  $time = escape($_POST['time']) ;
  $time .= ':00';
  $timestring = strtotime($time);


  $sql ="Select * FROM appointments WHERE `date` = '$date'";
  $result = query($sql);
  $sql2 ="Select * FROM appointments WHERE `patientid` = '$name' AND `date` = '$date'";
  $result2 = query($sql2);


  if(mysqli_num_rows($result) >0){

    while($row = fetch_array($result)){
        $today =$row['time'];
        $today = strtotime($today);
        $diff = $timestring - $today;
        $diff =abs($diff);
        if($diff<1800){

    $msg="<div class='alert alert-danger' style='margin-top: 60px;'>date already exist choose another date</div>";
    $error= true;
break;
}}}
if(mysqli_num_rows($result2) >0){
    $msg="<div class='alert alert-danger' style='margin-top: 60px;'>patient already exist in this day</div>";
    $error= true;

}

if(!$error){
  $sql ="INSERT INTO `appointments` (`patientid`, `date`, `time`) VALUES ('$name', '$date', '$time')";
  $result = query($sql);
  if ($result) {

      unset($_POST['submit']);
      rederict("#");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
          $msg="<div class='alert alert-danger' style='margin-top: 60px;'>something went wrong please try again</div>";
      }
}
} 
if(isset($_POST['submitu'])){
  $name = escape($_POST['lang']) ;
  $date = date("Y-m-d");
  $time = date("H:i:s");
  $sql ="INSERT INTO `appointments` (`patientid`, `date`, `time`) VALUES ('$name', '$date', '$time')";
  $result = query($sql);
  if ($result) {
      unset($_POST['submit']);
      rederict("#");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
          $msg="<div class='alert alert-danger' style='margin-top: 60px;'>something went wrong please try again</div>";
      }
}

?>
<html>
    <head>
        <link rel="stylesheet" href="../css/pages/appointement.css">
        <title>ubiclinic | add new appointement</title>
        <link rel="shortcut icon" href="../img/logo.png" type="image/png">
          <script src="../js/jQuery.js"></script>
<script src="../js/select/src/assets/js/jquery-searchbox.js"></script>

 
    </head>
    <body>
    <?php if(isset($_SESSION['username'])){?>

        <div class="content">

            <div id="popup-new">
              <div class="new-app">
                  <a href="#" class="remove-btn">X</a>

              <form method="POST" class="form" autocomplete="off">

                  
                      <div class="form-group">
                        <label class="form-label" for="name"">name</label>
                      <div class="select-wrap">
                        <select name="lang" class="js-searchBox" style="width:100%">
                        <?php 
    $query = query("Select * FROM patient");
    while($result = fetch_array($query)){
                          $id = $result['id'];
                          $fname = $result['firstname'];
                          $lname = $result['lastname'];
                          $name = $lname . " " . $fname;

$prodoct = <<<String
<option value="$id">$name</option>
String;
                      echo $prodoct;
                      }
                        ?>
                        </select>
                      </div>
                  </div>
                  
                  

                  
                      <div class="form-group">
                      <label class="form-label" for="date">choose date</label>
                      <input type="date" name="date" min="<?php echo date("Y-m-d");?>" class="input" required>
                  </div>

                  <div class="form-group">
                    <label class="form-label" for="time">choose time</label>
                    <input type="time" name="time" class="input" required>
                </div>
                <?php echo $msg;?>

                  <button class="form-btn" name="submit" type="submit">submit</button>
              </form>
          </div>
          </div>


          <div id="popup-urgent">
              <div class="new-app">
                  <a href="#" class="remove-btn">X</a>

              <form method="POST" class="form" autocomplete="off">

                  
                      <div class="form-group">
                        <label class="form-label" for="name"">name</label>
                      <div class="select-wrap">
                        <select name="lang" class="js-searchBox" style="width:100%">
                        <?php 
    $query = query("Select * FROM patient");
    while($result = fetch_array($query)){
                          $id = $result['id'];
                          $fname = $result['firstname'];
                          $lname = $result['lastname'];
                          $name = $lname . " " . $fname;

$prodoct = <<<String
<option value="$id">$name</option>
String;
                      echo $prodoct;
                      }
                        ?>
                        </select>
                      </div>
                  </div>

                  <button class="form-btn" name="submitu" type="submit">submit</button>
              </form>
          </div>
          </div>
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
                    <li class="side-nav-item active">
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

                <h2 class="title">today is <span class="date"><?php echo date("Y/m/d");?></span></h2>
                
                <h2 class="today">there is <span class="num"><?php echo $numtoday;?></span> waiting in the salle room</h2>
                    <div class="flext">

                    <a href="#popup-new" class="table-btn center margin-top-small">add new appointement</a>
                                        <a href="#popup-urgent" class="table-btn center margin-top-small">add an urgent appointement</a>

                                      </div>
                                      <div class="options">
                                      <h1 class="center-text center heading-secondary ">appointment list</h1>
                                      <div class="buttons" style="display: flex;">
                            <div id="today">today</div>      
                            <div id="all">all</div>      
                            </div>
                </div>
                <div style="overflow:auto;max-height:50rem;">
                    <div class="table" id="alltable" style="width:100%">
    
                        <div class="row tab-header">
                          <div class="cell">
                            num
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
                            begin
                          </div>
                          <div class="cell">
                            finish
                          </div>
                          <div class="cell">
                            remove
                          </div>
                        </div>
                        
                        <?php appointmentlist(); ?>


                    </div>
                    </div>
                    <div class="table" id="todaytable">
    
                        <div class="row tab-header">
                          <div class="cell">
                            num
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
                            begin
                          </div>
                          <div class="cell">
                            finish
                          </div>
                          <?php if($_SESSION['degree']=="doctor"){?>
                          <div class="cell">
                            use
                          </div>
                          <?php }?>
                          <div class="cell">
                            remove
                          </div>
                        </div>
                        
                        <?php appointmentlisttoday(); ?>


                    </div>
                    </div>
                    </div>
                    <script>

document.getElementById("all").addEventListener("click", function(){ 
  $("#todaytable").css("display", "none");
$("#alltable").css("display", "table");
 });
 document.getElementById("today").addEventListener("click", function(){ 
  $("#todaytable").css("display", "table");
$("#alltable").css("display", "none");
 });

</script>
                    <script>
                     $('.js-searchBox').searchBox({elementWidth:'100%'});
  

                    </script>
                                                    <?php }else{rederict("../signin/");}?>

                    </body>
                    </html>