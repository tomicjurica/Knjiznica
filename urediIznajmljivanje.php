<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['return']))
{
$Id_Iznajmljivanje=intval($_GET['Id_Iznajmljivanje']);
$rstatus=0;
$sql="update iznajmljivanje set Status_Iznajmljivanja=:rstatus, Datum_Vracanja= now() where Id_Iznajmljivanje=:Id_Iznajmljivanje";
$query = $dbh->prepare($sql);
$query->bindParam(':Id_Iznajmljivanje',$Id_Iznajmljivanje,PDO::PARAM_STR);
$query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
$query->execute();

$_SESSION['msg']="Book Returned successfully";
header('location:iznajmljeneKnjige.php');



}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Kknjižnica| Detalji</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script>
// function for get student name
function dajClanove() {
$("#loaderIcon").show();
jQuery.ajax({
url: "dajClanove.php",
data:'ID_Korisnik='+$("#ID_Korisnik").val(),
type: "POST",
success:function(data){
$("#daj_calnove_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for book details
function getbook() {
$("#loaderIcon").show();
jQuery.ajax({
url: "dajKnjige.php",
data:'ID_Knjige='+$("#ID_Knjige").val(),
type: "POST",
success:function(data){
$("#dajKnjige_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script> 
<style type="text/css">
  .others{
    color:red;
}

</style>


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
                <h4 class="header-line">Iznajmljene knjige</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class="panel panel-info">
<div class="panel-heading">
    Detalji
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$Id_Iznajmljivanje=intval($_GET['Id_Iznajmljivanje']);
$sql = "SELECT korisnici.Ime, korisnici.Prezime, knjige.Naziv,iznajmljivanje.Id_Iznajmljivanje,iznajmljivanje.Datum_Iznajmljivanja, iznajmljivanje.Datum_Iznajmljivanja, iznajmljivanje.Datum_Vracanja, 	iznajmljivanje.Status_Iznajmljivanja from iznajmljivanje inner join korisnici on iznajmljivanje.Korisnik_ID= korisnici.ID_Korisnik inner join knjige on iznajmljivanje.Knjiga_ID=knjige.ID_Knjige where Id_Iznajmljivanje=:Id_Iznajmljivanje";

$query = $dbh -> prepare($sql);
$query->bindParam(':Id_Iznajmljivanje',$Id_Iznajmljivanje,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                   



<div class="form-group">
<label>Clan :</label>
<?php echo htmlentities($result->Ime);?>
</div>

<div class="form-group">
<label>Naziv knjige :</label>
<?php echo htmlentities($result->Naziv);?>
</div>


<div class="form-group">
<label>Datum iznajmljivanja :</label>
<?php echo htmlentities($result->Datum_Iznajmljivanja);?>
</div>


<div class="form-group">
<label> Ddatum povratka :</label>
<?php if($result->Status_Iznajmljivanja==1)
                                            {
                                                echo htmlentities("Nije vracena");
                                            } else {


                                            echo htmlentities($result->Datum_Vracanja);
}
                                            ?>
</div>

<?php 
if($result->Status_Iznajmljivanja==1)
{?>

<?php }else {
echo "";
}
?>
</div>
 <?php if($result->Status_Iznajmljivanja==1){?>

<button type="submit" name="return" id="submit" class="btn btn-info">Vrati knjigu </button>

 </div>

<?php } }} ?>
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
