<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=$_POST['password'];
$sql ="SELECT E_Mail,Lozinka,Tip_KorisnikaID,ID_Korisnik FROM korisnici WHERE E_Mail=:username and Lozinka=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
    foreach ($results as $result) {
        $_SESSION['Korisnik_ID']=$result->ID_Korisnik;
    if($result->Tip_KorisnikaID==1){
        $_SESSION['alogin']=$_POST['username'];
        echo "<script type='text/javascript'> document.location ='iznajmljeneKnjige.php'; </script>";
    }else {
        $_SESSION['login']=$_POST['username'];
        echo "<script type='text/javascript'> document.location ='iznajmljeneKnjigeClan.php'; </script>";
    }
}
} else{
    echo "<script>alert('Invalid Details');</script>";
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Knjižnica</title>
    <img src="assets/img/logoknjiznica.png" />

    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <!------MENU SECTION START-->
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
<div class="col-md-12">
</div>
</div>
             
<!--LOGIN PANEL START-->           
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
 PRIJAVA
</div>
<div class="panel-body">
<form role="form" method="post">

<div class="form-group">
<label>EMAIL</label>
<input class="form-control" type="text" name="username" required />
</div>
<div class="form-group">
<label>Lozinka</label>
<input class="form-control" type="password" name="password" required />
</div>
 <button type="submit" name="login" class="btn btn-info">Prijava </button>
</form>
 </div>
</div>
</div>
</div>  
<!---LOGIN PABNEL END-->            
             
 
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
 <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
