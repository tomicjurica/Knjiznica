<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['issue']))
{
$ID_Korisnik=strtoupper($_POST['ID_Korisnik']);
$ID_Knjige=$_POST['ID_Knjige'];
$sql="INSERT INTO  iznajmljivanje(Korisnik_ID,	Knjiga_ID, Datum_Iznajmljivanja) VALUES(:ID_Korisnik,:ID_Knjige , now() )";
$query = $dbh->prepare($sql);
$query->bindParam(':ID_Korisnik',$ID_Korisnik,PDO::PARAM_STR);
$query->bindParam(':ID_Knjige',$ID_Knjige,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Book issued successfully ";
header('location:iznajmljeneKnjige.php');
}
else 
{
$_SESSION['error']="Something went wrong. Please try again $ID_Korisnik,$ID_Knjige ";
header('location:iznajmljeneKnjige.php');
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
    <title>Knjižnica| Iznajmi Knjigu</title>
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
$("#get_student_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for book details
function dajKnjige() {
$("#loaderIcon").show();
jQuery.ajax({
url: "dajKnjige.php",
data:'ID_Knjige='+$("#ID_Knjige").val(),
type: "POST",
success:function(data){
$("#get_book_name").html(data);
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
                <h4 class="header-line">Iznajmi knjigu </h4>
                
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

<div class="form-group">
<label>Student id<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="ID_Korisnik" id="ID_Korisnik" onBlur="dajClanove()" autocomplete="off"  required="required" />
</div>

<div class="form-group">
<span id="get_student_name" style="font-size:16px;"></span> 
</div>





<div class="form-group">
<label>Naslov knjige<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="ID_Knjige" id="ID_Knjige" onBlur="dajKnjige()"  required="required" />
</div>

<div class="form-group">
<span id="get_book_name" style="font-size:16px;"></span> 
</div>

<button type="submit" name="issue" id="submit" class="btn btn-info">Iznajmi knjigu </button>

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
