<?php 
require_once("../functions/config.php");
if(isset($_POST['submit']) and $_GET['theme']=="patient"){
    $name = escape($_POST['name']) ;
    $namearray = explode(" ",$name,2);
    $fname = $namearray[0];
    $lname = $namearray[1];
    $age = escape($_POST['age']);
    $phone = escape($_POST['phone']) ;
    $email = escape($_POST['email']);
    $weight = escape($_POST['weight']);
    $height = escape($_POST['height']);
    $id = $_GET['id'];
    $query = "UPDATE `patient` SET `firstname` = '$fname', `lastname` = '$lname', `age` = '$age', `email` = '$email', `phone` = '$phone' , `height` = '$height', `weight` = '$weight'  WHERE `patient`.`id` = $id";
query($query);
        rederict("../edituser");    
    }
    if(isset($_POST['submit']) and $_GET['theme']=="medicine"){
        $id = $_GET['id'];
        $name = escape($_POST['name']) ;
    $usedfor = escape($_POST['usedfor']) ;
    $dose = escape($_POST['dose']) ;
    $sql ="UPDATE `medicine` SET `name` = '$name', `used-for` = '$usedfor', `dose` = '$dose' WHERE `medicine`.`id` = $id";
    query($sql);
            rederict("../medicine");    
        }

?>
<html>

<head>
    <link rel="stylesheet" href="../css/pages/edituser.css">
    <title>ubiclinic | dashbord</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/png">

</head>

<body>
    <div class="content">
        <div class="container">
          <div id="modify">
            <div class="modify-form">
                <form method="POST" class="form-modify">
                    <?php if(isset($_GET['theme']) and $_GET['theme']=="patient"){?>
                  <div class="form-group">
                      <label class="form-label" for="name"> name</label>
                      <input class="form-input" placeholder="enter a new name" required name="name" value="<?php echo $_GET['name'];?>" type="text" >
                  </div>
                  <div class="form-group">
                      <label class="form-label" for="age">age</label>
                      <input class="form-input" placeholder="enter a new age" required name="age" value="<?php echo $_GET['age'];?>" type="number" min="0">
                  </div>
                  <div class="form-group">
                      <label class="form-label" for="phone">phone</label>
                      <input class="form-input" placeholder="enter a new phone" required name="phone" value="<?php echo $_GET['phone'];?>" type="number" min="0">
                  </div>
                  <div class="form-group">
                      <label class="form-label" for="email">email</label>
                      <input class="form-input" placeholder="enter a new email" required name="email" value="<?php echo $_GET['email'];?>" type="text">
                  </div>
                              <div class="form-group">
                              <label class="form-label" for="weight">weight</label>
                              <input type="number" name="weight" min="1" class="form-input"  value="<?php echo $_GET['weight'];?>" placeholder="enter your new width on kg">
                              </div>
                              <div class="form-group">
                              <label class="form-label" for="height">height</label>

                              <input type="number" name="height" min="1" class="form-input" value="<?php echo $_GET['height'];?>" placeholder="enter your new height on cm">
                              </div>
                  <?php }elseif(isset($_GET['theme']) and $_GET['theme']=="medicine"){
                       ?>
                       <div class="form-group">
                        <label class="form-label" for="name"> medecine name</label>
                        <input class="form-input" placeholder="enter a medicne name" value="<?php echo $_GET['name'];?>" name="name" class="name" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="usedfor">usedfor</label>
                        <input placeholder="what is used for" name="usedfor" value="<?php echo $_GET['usedfor'];?>" class="form-input" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="dose">dose</label>
                        <input placeholder="what is used for" name="dose" value="<?php echo $_GET['dose'];?>" class="form-input" type="number" required>
                    </div>
                    <?php } ?>
                  <button class="form-btn" name="submit" type="submit">submit</button>
              </form>
        </div>
        </div>