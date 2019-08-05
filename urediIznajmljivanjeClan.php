<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['return']))
{
$ID_Knjige=intval($_GET['ID_Knjige']);
$Korisnik_ID=$_SESSION['Korisnik_ID'];

$sql="INSERT INTO  iznajmljivanje(Korisnik_ID,	Knjiga_ID, Datum_Iznajmljivanja) VALUES(:Korisnik_ID,:ID_Knjige , now() )";
$query = $dbh->prepare($sql);
$query->bindParam(':Korisnik_ID',$Korisnik_ID,PDO::PARAM_STR);
$query->bindParam(':ID_Knjige',$ID_Knjige,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Uspjesno";
header('location:iznajmljeneKnjigeClan.php');
}
else 
{
$_SESSION['error']="Greska";
header('location:iznajmljeneKnjigeClan.php');
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
    <title>Knjiznica | Iznajmljene knjige</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script>

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
<?php include('includes/headerUser.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Iznajmi knjigu</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class="panel panel-info">
<div class="panel-heading">
Iznajmi knjigu
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$ID_Knjige=intval($_GET['ID_Knjige']);
//$sql = "SELECT korisnici.Ime, korisnici.Prezime, knjige.ID_Knjige, knjige.Naziv,iznajmljivanje.Id_Iznajmljivanje,iznajmljivanje.Datum_Iznajmljivanja, iznajmljivanje.Datum_Iznajmljivanja, iznajmljivanje.Datum_Vracanja, 	iznajmljivanje.Status_Iznajmljivanja from iznajmljivanje inner join korisnici on iznajmljivanje.Korisnik_ID= korisnici.ID_Korisnik inner join knjige on iznajmljivanje.Knjiga_ID=knjige.ID_Knjige where Id_Iznajmljivanje=:Id_Iznajmljivanje";
$sql = "SELECT knjige.ID_Knjige, knjige.Naziv, knjige.Status, autori.Naziv_Autora as autnzv , izdavaci.Naziv as izdnzv from knjige inner join autori on knjige.Autor_ID= autori.ID_Autor inner join izdavaci on knjige.Izdavac_ID= izdavaci.ID_Izdavac where ID_Knjige=:ID_Knjige";
$query = $dbh -> prepare($sql);
$query->bindParam(':ID_Knjige',$ID_Knjige,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                   

<div class="form-group">
<label> Naziv knjige :</label>
<?php echo htmlentities($result->Naziv);?>
</div>

<div class="form-group">
<label> Naziv Autora :</label>
<?php echo htmlentities($result->autnzv);?>
</div>


<div class="form-group">
<label>Naziv Izdavača :</label>
<?php echo htmlentities($result->izdnzv);?>
</div>



</div>
 <?php if($result->Status==1){?>

<button type="submit" name="return" id="submit" class="btn btn-info">Iznajmi Knjigu </button>

 </div>

<?php }}} ?>
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
