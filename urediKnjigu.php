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


$naziv=$_POST['naziv'];
$datum=$_POST['datum'];
$author=$_POST['author'];
$izdavac=$_POST['izdavac'];
$brstranica=$_POST['brstranica'];
$ID_Knjige=intval($_GET['ID_Knjige']);


$sql="update  knjige set Naziv=:naziv,Godina_Izdavanja=:datum,Autor_ID=:author,Izdavac_ID=:izdavac, Br_Stranica=:brstranica where ID_Knjige=:ID_Knjige";
$query = $dbh->prepare($sql);
$query->bindParam(':naziv',$naziv,PDO::PARAM_STR);
$query->bindParam(':datum',$datum,PDO::PARAM_STR);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->bindParam(':izdavac',$izdavac,PDO::PARAM_STR);
$query->bindParam(':brstranica',$brstranica,PDO::PARAM_STR);
$query->bindParam(':ID_Knjige',$ID_Knjige,PDO::PARAM_STR);
$query->execute();

header('location:knjige.php');


}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Knjižnica | Uredi Knjigu</title>
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
                <h4 class="header-line">Add Book</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Book Info
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$ID_Knjige=intval($_GET['ID_Knjige']);
$sql = "SELECT autori.ID_Autor,izdavaci.ID_Izdavac, knjige.Naziv, knjige.Godina_Izdavanja, knjige.Status, knjige.Br_Stranica, autori.Naziv_Autora, izdavaci.Naziv as nzv from knjige inner join autori on knjige.Autor_ID = autori.ID_Autor inner join izdavaci on knjige.Izdavac_ID=izdavaci.ID_Izdavac where knjige.ID_Knjige=:ID_Knjige";
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
<label>Naziv Knjige<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="naziv" value="<?php echo htmlentities($result->Naziv);?>" required />
</div>




<div class="form-group">
<label>Autor <span style="color:red;">*</span></label>
<input class="form-control" type="text" name="author" value="<?php echo htmlentities($result->ID_Autor);?>"  required="required" />
</div>

<div class="form-group">
<label>Izdavac<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="izdavac" value="<?php echo htmlentities($result->ID_Izdavac);?>"  required="required" />
</div>


<div class="form-group">
<label>Godina Izdavanja<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="datum" value="<?php echo htmlentities($result->Godina_Izdavanja);?>"  required="required" />
</div>

 <div class="form-group">
 <label>Broj stranica<span style="color:red;">*</span></label>
 <input class="form-control" type="text" name="brstranica" value="<?php echo htmlentities($result->Br_Stranica);?>"   required="required" />

 </div>
 <?php }} ?>
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
