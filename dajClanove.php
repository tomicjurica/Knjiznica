<?php 
require_once("includes/config.php");
if(!empty($_POST["ID_Korisnik"])) {
  $ID_Korisnik= strtoupper($_POST["ID_Korisnik"]);
 
    $sql ="SELECT * FROM korisnici WHERE ID_Korisnik=:ID_Korisnik";
$query= $dbh -> prepare($sql);
$query-> bindParam(':ID_Korisnik', $ID_Korisnik, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach ($results as $result) {
if($result->Status==0)
{
echo "<b>Ime Člana-</b>" .$result->Ime;
} else {
?>


<?php  
echo htmlentities($result->Ime);
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}
 else{
  
  echo "<span style='color:red'> Pogrešan ID. .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}



?>
