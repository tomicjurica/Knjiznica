<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['add']))
{
$naziv=$_POST['naziv'];
$datum=$_POST['datum'];
$author=$_POST['author'];
$izdavac=$_POST['izdavac'];
$brstranica=$_POST['brstranica'];

$sql="INSERT INTO  knjige(Naziv,Godina_Izdavanja, Autor_ID,Izdavac_ID, Br_Stranica) VALUES(:naziv,:datum,:author,:izdavac,:brstranica)";
$query = $dbh->prepare($sql);
$query->bindParam(':naziv',$naziv,PDO::PARAM_STR);
$query->bindParam(':datum',$datum,PDO::PARAM_STR);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->bindParam(':izdavac',$izdavac,PDO::PARAM_STR);
$query->bindParam(':brstranica',$brstranica,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Book Listed successfully";
header('location:knjige.php');
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
header('location:knjige.php');
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
    <title> Knjižnica  | Dodaj knjigu</title>
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
                <h4 class="header-line">Dodaj knjigu</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Knjiga
</div>
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Naziv knjige<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="naziv" autocomplete="off"  required />
</div>



<div class="form-group">
<label> Autor<span style="color:red;">*</span></label>
<select class="form-control" name="author" required="required">
<option value=""> Odaberi autora</option>
<?php 

$sql = "SELECT * from  autori ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option  value="<?php echo htmlentities($result->ID_Autor);?>"></option>
 <?php }} ?> 
</select>
</div>

<div class="form-group">
<label> Izdavač<span style="color:red;">*</span></label>
<select class="form-control" name="izdavac" required="required">
<option value=""> Odaberi izdavača</option>
<?php 
$sql = "SELECT * from  izdavaci ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option value="<?php echo htmlentities($result->ID_Izdavac);?>"><?php echo htmlentities($result->Naziv);?></option>
 <?php }} ?> 
</select>
</div>


<div class="form-group">
<label>Datum izdavanja<span style="color:red;">*</span></label>
<input class="form-control" type="text"  name="datum"  required="required" autocomplete="off"  />

</div>

 <div class="form-group">
 <label>Broj stranica<span style="color:red;">*</span></label>
 <input class="form-control" type="text" name="brstranica" autocomplete="off"   required="required" />
 </div>
<button type="submit" name="add" class="btn btn-info">Dodaj </button>

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
