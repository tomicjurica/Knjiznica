<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from knjige  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$_SESSION['delmsg']=" Izbrisano ";
header('location:.php');

}


    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Knjižnica | Iznajmljene Knjige</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/headerUser.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Iznajmljene knjige</h4>
    </div>
    

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Iznajmljene knjige 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Naziv knjige</th>
                                            <th>Datum iznajmljivanja</th>
                                            <th>Datum vracanja</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$Korisnik_ID=$_SESSION['Korisnik_ID'];
$sql = "SELECT korisnici.Ime, korisnici.Prezime, knjige.Naziv,iznajmljivanje.Id_Iznajmljivanje, iznajmljivanje.Datum_Iznajmljivanja, iznajmljivanje.Datum_Vracanja, 	iznajmljivanje.Status_Iznajmljivanja from iznajmljivanje inner join korisnici on iznajmljivanje.Korisnik_ID= korisnici.ID_Korisnik inner join knjige on iznajmljivanje.Knjiga_ID=knjige.ID_Knjige where iznajmljivanje.Korisnik_ID=:Korisnik_ID ";
$query = $dbh -> prepare($sql);
$query-> bindParam(':Korisnik_ID', $Korisnik_ID, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($result->Naziv);?></td>
                                            <td class="center"><?php echo htmlentities($result->Datum_Iznajmljivanja);?></td>
                                            <td class="center"><?php if($result->Status_Iznajmljivanja==1)
                                            {?>
                                            <span style="color:red">
                                             <?php   echo htmlentities("Nije vracena"); ?>
                                                </span>
                                            <?php } else {
                                            echo htmlentities($result->Datum_Vracanja);
                                        }
                                            ?></td>
                                            
                                         
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
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
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
<?php } ?>
