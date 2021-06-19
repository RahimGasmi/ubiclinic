<?php
function rederict($location){
    header("Location:$location");
}
function query($sql){
    global $connection;
    return mysqli_query($connection,$sql);
}
function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection,$string);
}
function fetch_array($result){
return mysqli_fetch_array($result);
}

function inputvalue($string){
  if(isset($_POST[$string])){
    echo $_POST[$string];
  }
}


function patientlist(){
    $query = query("Select * FROM patient");
    while($result = fetch_array($query)){
        $id = $result['id'];
        $fname = $result['firstname'];
        $lname = $result['lastname']; 
        $name = $lname . " " . $fname;
        $age = $result['age'];
        $phone = $result['phone'];
        $gender = $result['gender'];
        $email= $result['email'];
        $blood = $result['blood'];
        $height = $result['height'];
        $weight = $result['weight'];
        // this is for making a big string
$prodoct = <<<String
<div class="row">

<a class="cell" href="../patient/?id=$id">
 $name
 </a>
<div class="cell" data-title="Age">
  $age
</div>
<div class="cell" data-title="gender">
  $gender
</div>
<div class="cell" data-title="blood">
  $blood
</div>
<div class="cell" data-title="Occupation">
  $phone
</div>
<div class="cell email" data-title="Location">
  $email
</div>
<div class="cell" data-title="action">
  <div class="flex">
  <a href="../functions/modify.php?theme=patient&id=$id&name=$name&age=$age&phone=$phone&email=$email&height=$height&weight=$weight" target="_blank"><span class="glyphicon glyphicon-modify">modify</span></a>
    <a href="../functions/remove.php?id=$id&theme=patient" ><span class="glyphicon glyphicon-remove">remove</span></a>
  </div>
  </div>
</div>
String;
    echo $prodoct;
    }

   
}
function patientlistlimit(){
  $query = query("Select * FROM patient Limit 6");
  while($result = fetch_array($query)){
      $id = $result['id'];
      $fname = $result['firstname'];
      $lname = $result['lastname'];
      $name = $lname . " " . $fname;
      $age = $result['age'];
      $phone = $result['phone'];
      $gender = $result['gender'];
      $blood = $result['blood'];
      $email= $result['email'];
      // this is for making a big string
$prodoct = <<<String
<div class="row">
                          <div class="cell" data-title="Name">
                            $name
                          </div>
                          <div class="cell" data-title="Age">
                           $age
                          </div>
                          <div class="cell" data-title="gender">
                           $gender
                          </div>
                          <div class="cell" data-title="blood">
                           $blood
                          </div>
                          <div class="cell" data-title="phone">
                            $phone
                          </div>
                          <div class="cell" data-title="Location">
                            $email
                          </div>
                        </div>
String;
  echo $prodoct;
  }

 
}
function patientselect(){
  $query = query("Select * FROM patient");
  while($result = fetch_array($query)){
      $id = $result['id'];
      $fname = $result['firstname'];
      $lname = $result['lastname'];
      $name = $lname . " " . $fname;
      // this is for making a big string
$prodoct = <<<String
<option value="$id">$name</option>
String;
  echo $prodoct;
  }

 
}
function examselect(){
  $query = query("Select * FROM examan");
  while($result = fetch_array($query)){
      $id = $result['id'];
      $name = $result['nomexam'];
      $mix = $id . $name;
      // this is for making a big string
$prodoct = <<<String
<option value="$name">$name</option>
String;
  echo $prodoct;
  }

 
}
function appointmentlist(){
    $query = query("Select * FROM appointments , patient WHERE appointments.patientid = patient.id ORDER BY date , time");
    $i=1;
    while($result = fetch_array($query)){
        $id = $result['appid'];
        $idpatient = $result['patientid'];
        $fname = $result['firstname'];
        $lname = $result['lastname'];
        $name = $lname . " " . $fname;
        $age = $result['age'];
        $phone = $result['phone'];
        $date= $result['date'];
        $time= $result['time'];
        $end = strtotime("+30 minutes",strtotime($time));
        $end = date('H:i:s', $end);

        // this is for making a big string
$prodoct = <<<String
<div class="row">
<div class="cell" data-title="number">
  $i
</div>
<a class="cell" href="../patient/?id=$idpatient">
 $name
 </a>
<div class="cell" data-title="age">
  $age
</div>

<div class="cell" data-title="phone">
  $phone
</div>
<div class="cell" data-title="date">
  $date
</div>
<div class="cell" data-title="time">
  $time
</div>
<div class="cell" data-title="finish">
  $end
</div>
<div class="cell" data-title="action">
                              <a href="../functions/remove.php?id=$id&theme=app"><span class="glyphicon glyphicon-remove">X</span></a>

                              </div>
</div>
String;
    echo $prodoct;
    $i++;
    }

   
}
function appointmentlisttoday(){
  $query = query("Select * FROM appointments , patient WHERE appointments.patientid = patient.id ORDER BY time");
  $i=1;
  while($result = fetch_array($query)){
    if(mysqli_num_rows($query) !=0){

    if($result['date'] == date("Y-m-d")){
      $id = $result['appid'];
      $idpatient = $result['patientid'];
      $fname = $result['firstname'];
      $lname = $result['lastname'];
      $name = $lname . " " . $fname;
      $age = $result['age'];
      $state = $result['state'];
      $phone = $result['phone'];
      $date= $result['date'];
      $time= $result['time'];
      $end = strtotime("+30 minutes",strtotime($time));
      $end = date('H:i:s', $end);
      if($_SESSION['degree']!="secretaire"){
if($state =="waiting"){
$prodoct = <<<String
<div class="row">
<div class="cell" data-title="number">
$i
</div>
<a class="cell" href="../patient/?id=$idpatient">
$name
</a>
<div class="cell" data-title="age">
$age
</div>

<div class="cell" data-title="phone">
$phone
</div>
<div class="cell" data-title="date">
$date
</div>
<div class="cell" data-title="time">
$time
</div>
<div class="cell" data-title="finish">
$end
</div>

<div class="cell" data-title="action">
<a href="../consultation/?appid=$id&patientid=$idpatient"><span class="glyphicon glyphicon-modify">enter</span></a>
</div>
<div class="cell" data-title="action">
                            <a href="../functions/remove.php?id=$id&theme=app"><span class="glyphicon glyphicon-remove">X</span></a>
                            </div>
</div>
String;
  echo $prodoct;
}else{$prodoct = <<<String
<div class="row">
<div class="cell" data-title="number">
$i
</div>
<a class="cell" href="../patient/?id=$idpatient">
$name
</a>
<div class="cell" data-title="age">
$age
</div>

<div class="cell" data-title="phone">
$phone
</div>
<div class="cell" data-title="date">
$date
</div>
<div class="cell" data-title="time">
$time
</div>
<div class="cell" data-title="finish">
$end
</div>

<div class="cell" data-title="action">
<span class="glyphicon glyphicon-doc">finish</span>
</div>
<div class="cell" data-title="action">
                            <a href="../functions/remove.php?id=$id&theme=app"><span class="glyphicon glyphicon-remove">X</span></a>
                            </div>
</div>
String;
  echo $prodoct;}
}else{
 
$prodoct = <<<String
<div class="row">
<div class="cell" data-title="number">
$i
</div>
<a class="cell" href="../patient/?id=$idpatient">
$name
</a>
<div class="cell" data-title="age">
$age
</div>

<div class="cell" data-title="phone">
$phone
</div>
<div class="cell" data-title="date">
$date
</div>
<div class="cell" data-title="time">
$time
</div>
<div class="cell" data-title="finish">
$end
</div>

<div class="cell" data-title="action">
                            <a href="../functions/remove.php?id=$id&theme=app"><span class="glyphicon glyphicon-remove">X</span></a>
                            </div>
</div> 
String;
  echo $prodoct;
}
  $i++;
  }}}

 
}
function numberapp(){
  $query = query("Select * FROM appointments");
  $i = 0;
  if(mysqli_num_rows($query) !=0){
  while($result = fetch_array($query)){
    if($result['date'] == date("Y-m-d")){
    $i++;}
  }}

 return $i;
}
function testapp($idapp,$patientid){
  $query = query("SELECT * FROM `appointments` WHERE `appid`=$idapp AND `patientid`=$patientid");
$result = fetch_array($query);
    if($result['date'] == date("Y-m-d")){
      return true;
  }
return false;

}
function appointmentlistlimit(){
  $query = query("Select * FROM appointments , patient WHERE appointments.patientid = patient.id Limit 6");
  $i=1;
  while($result = fetch_array($query)){
      $id = $result['appid'];
      $fname = $result['firstname'];
      $lname = $result['lastname'];
      $name = $lname . " " . $fname;
      $age = $result['age'];
      $phone = $result['phone'];
      $date= $result['date'];
      $time= $result['time'];
      // this is for making a big string
$prodoct = <<<String
<div class="row">
                        <div class="cell" data-title="number">
                          $i
                        </div>
                        <div class="cell" data-title="name">
                          $name
                        </div>
                        <div class="cell" data-title="age">
                          $age
                        </div>
                        <div class="cell" data-title="phone">
                          $phone
                        </div>
                        
                        <div class="cell" data-title="date">
                          $date
                        </div>
                        <div class="cell" data-title="time">
                          $time
                        </div>
                        </div>
String;
  echo $prodoct;
  $i++;
  }
}
function medicinelist(){
  $query = query("Select * FROM medicine");
  while($result = fetch_array($query)){
      $id = $result['id'];
      $name = $result['name'];
      $used= $result['used-for'];
      $dose= $result['dose'];
      $period= $result['period'];
      // this is for making a big string
$prodoct = <<<String
<div class="row">
                          <div class="cell" data-title="Name">
                            $name
                          </div>
                          <div class="cell" data-title="usedfor">
                            $used
                          </div>
                          <div class="cell" data-title="dose">
                            $dose mg
                          </div>
                          <div class="cell" data-title="period">
                            $period 
                          </div>
                          <div class="cell" data-title="action">
                          <a href="../functions/remove.php?id=$id&theme=medicine"><span class="glyphicon glyphicon-remove">X</span></a>
                      
                            </div>
                        </div>
String;
  echo $prodoct;
  }}
  function examlist(){
    $query = query("Select * FROM examan");
    while($result = fetch_array($query)){
        $id = $result['idexam'];
        $name = $result['nomexam'];
        $cost= $result['cost'];

  $prodoct = <<<String
  <div class="row">
                            <div class="cell" data-title="Name">
                              $name
                            </div>
                            <div class="cell" data-title="cost">
                              $cost DA
                            </div>

                            <div class="cell" data-title="action">
                            <a href="../functions/remove.php?id=$id&theme=examan"><span class="glyphicon glyphicon-remove">X</span></a>
                              </div>
                          </div>
  String;
    echo $prodoct;
    }
 
} 
function medicineselect(){
  $query = query("Select * FROM medicine");
  while($result = fetch_array($query)){
      $id = $result['id'];
      $name = $result['name'];
      // this is for making a big string
$prodoct = <<<String
<option value="$id">$name</option>
String;
  echo $prodoct;
  }

 
}
function searchlist($name){
  $sql = "SELECT * FROM patient  WHERE firstname like '$name%' OR lastname like '$name%'";
  $query = query($sql);
  if (mysqli_num_rows($query) > 0) {
      while($result = fetch_array($query)){
          $id = $result['id'];
          $fname = $result['firstname'];
          $lname = $result['lastname'];
          $fullname = $lname . " " . $fname;
          $age = $result['age'];
          $phone = $result['phone'];
          // this is for making a big string
$prodoct = <<<String
  <div class="card">
                        <svg class="card-icon">
                            <use xlink:href="../css/icon/sprite.svg#icon-user"></use>
                        </svg>
                        <h1 class="card-name">name is : $fullname</h1>
                        <h2 class="card-age">age is : $age</h2>
                        <h2 class="card-phone">phone is :$phone</h2>
                        <a href="../patient/?id=$id" style="align-self:start;" class="seemore">see patient document</a>
                    </div>
String;
      echo $prodoct;
      }}
    
}
function patientdetails($id){
  $sql = "SELECT * FROM `patient` WHERE id=$id";
  $query = query($sql);
      $result = fetch_array($query);
      return $result;
}
?>
