<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['update']))
{

$ime=$_POST['ime'];
$prezime=$_POST['prezime'];
$email=$_POST['email'];
$lozinka=$_POST['lozinka'];
$adresa=$_POST['adresa'];
$brtel=$_POST['brtel'];
$tip=$_POST['tip'];
$ID_Korisnik=intval($_GET['ID_Korisnik']);


$sql="update  korisnici set Ime=:ime, Prezime=:prezime, E_Mail=:email, Lozinka=:lozinka, Adresa=:adresa,Br_Telefona=:brtel,Status=1,Tip_KorisnikaID=:tip where ID_Korisnik=:ID_Korisnik";
$query = $dbh->prepare($sql);
$query->bindParam(':ID_Korisnik',$ID_Korisnik,PDO::PARAM_STR);
$query->bindParam(':ime',$ime,PDO::PARAM_STR);
$query->bindParam(':prezime',$prezime,PDO::PARAM_STR);

$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':lozinka',$lozinka,PDO::PARAM_STR);
$query->bindParam(':adresa',$adresa,PDO::PARAM_STR);
$query->bindParam(':brtel',$brtel,PDO::PARAM_STR);
$query->bindParam(':tip',$tip,PDO::PARAM_STR);


$query->execute();
$_SESSION['updatemsg']="Uspjesno,$ID_Korisnik,$ime,$email,$lozinka,$adresa,$brtel,$tip ";
header('location:clanovi.php');



}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Knjižnica | Uredi autora</title>
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
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line"> Uredi </h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Član
</div>
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<?php 
$ID_Korisnik=intval($_GET['ID_Korisnik']);
$sql = "SELECT * from  korisnici where ID_Korisnik =:ID_Korisnik";
$query = $dbh -> prepare($sql);
$query->bindParam(':ID_Korisnik',$ID_Korisnik,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>   
<div class="form-group">
<label>Ime<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="ime" value="<?php echo htmlentities($result->Ime);?>"  required="required" />
</div>
<div class="form-group">
<label>Prezime<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="prezime" value="<?php echo htmlentities($result->Prezime);?>"  required="required" />
</div>
<div class="form-group">
<label>Email<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="email" value="<?php echo htmlentities($result->E_Mail);?>"  required="required" />
</div>
<div class="form-group">
<label>Lozinka<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="lozinka" value="<?php echo htmlentities($result->Lozinka);?>"  required="required" />
</div>
<div class="form-group">
<label>Adresa<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="adresa" value="<?php echo htmlentities($result->Adresa);?>"  required="required" />
</div>
<div class="form-group">
<label>Broj telefona<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="brtel" value="<?php echo htmlentities($result->Br_Telefona);?>"  required="required" />
</div>
<div class="form-group">
 <label>Tip Korisnika<span style="color:red;">*</span></label>
  <input type="radio" name="tip" value="1"> Administrator
  <input type="radio" name="tip" value="2"  checked="checked"> Clan<br>
  </div>

<?php }} ?>
</div>

<button type="submit" name="update" class="btn btn-info">Uredi </button>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>