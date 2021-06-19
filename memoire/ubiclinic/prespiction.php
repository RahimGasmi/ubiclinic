<?php 
require_once("functions/config.php");
if(!isset($_SESSION['lang'])){
    rederict("home/");
}
?>
<html>
    <head>
<link rel="stylesheet" href="css/pages/prespiction.css?ver=<?php echo rand(111,999)?>">
    </head> 
    <body>
    <?php if(isset($_SESSION['username'])){
        if($_SESSION['degree']=="secretaire"){
            rederict("home/");
        }?> 
        <div id="content">
        <div class="header">
            <div class="details">
            <h1 class="clinic-name">ubiclinic</h1>
            <div class="doctor-details">
                <svg class="doctor-icon">
                    <use xlink:href="css/icon/sprite.svg#icon-user-md"></use>
                </svg>
            <h1 class="doctor-name">dr.<?php echo $_SESSION['lname'];?></h1>

            </div>
        </div>
            <img src="img/logowithtext.png" alt="" class="logo">
            <div class="phone-email">
                <div class="phone">
                    <div class="number"><?php echo $_SESSION['phone'];?></div>
                    <svg class="phone-icon">
                        <use xlink:href="css/icon/sprite.svg#icon-phone"></use>
                        </svg>
                </div>
                <div class="email">
                    <div class="email-adress"><?php echo $_SESSION['email'];?></div>
                    <svg class="email-icon">
                        <use xlink:href="css/icon/sprite.svg#icon-envelope"></use>
                        </svg>
                </div>
            </div>
        </div>
        <h1 class="title">prespiction</h1>
        <div class="date-patient">
            <div class="date">Date: <?php echo date("Y/m/d");?></div>
            <div class="patient">patient : <?php echo $_SESSION['lang'];?></div>
        </div>
        <div class="Medicine">
            <h1 class="medicne-title">medicine that you need</h1>
            <ul class="medicine-list">
            <?php 
             foreach($_SESSION['medicines'] as $selected){
                $sql ="SELECT * FROM `medicine` WHERE `id` = '$selected' ";
                $query = query($sql);
                    $result = mysqli_fetch_assoc($query);
                        
                        $name = $result['name'];
                        $usedfor = $result['used-for'];
                        $dose = $result['dose'];
                        $period = $result['period'];

                        // this is for making a big string
$prodoct = <<<String
              <li class="medicine-item">
              <div class="cont">
              <div class="medicine-name">$name : </div>
              
              <div class="dose">$dose mg each day</div>
              <div class="usedfor">for $usedfor</div>
              <div class="period">keep using for $period days</div></div>
          </li>
String;
                    echo $prodoct;
}

        ?>
                
            </ul>
        </div> 
        <?php 
        if(!empty($_SESSION['details'])){ ?>
            <h1 class="medicne-title" style="margin-bottom: 2rem;">extra reading</h1>
            
<div class="main">
<?php echo $_SESSION['details'];?>
                    </div>
                    <?php } ?>
        <div class="signature">
        <?php echo $_SESSION['lname'];?>
        </div>

    </div>
    <a onclick="Print()" class="print">Print</a>
    <script type="text/javascript">     
        function Print() {    
           var print = document.getElementById('content');
           var popupWin = window.open('', '_blank', 'width=640,height=600');
           popupWin.document.open();
           popupWin.document.write('<html><head><link rel="stylesheet" href="css/pages/prespiction.css"></head><body onload="window.print()">' + print.innerHTML + '</html>');
            popupWin.document.close();
                }
     </script>
    </body>
    <?php }else{rederict("../signin/");}?>

</html>