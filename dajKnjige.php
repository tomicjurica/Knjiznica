<?php 
require_once("includes/config.php");
if(!empty($_POST["ID_Knjige"])) {
  $ID_Knjige=$_POST["ID_Knjige"];
 
    $sql ="SELECT * FROM knjige WHERE (ID_Knjige=:ID_Knjige)";
$query= $dbh -> prepare($sql);
$query-> bindParam(':ID_Knjige', $ID_Knjige, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
  foreach ($results as $result) {?>
  
<option value="<?php echo htmlentities($result->ID_Knjige);?>"><?php echo htmlentities($result->Naziv);?></option>
<b>Book Name :</b> 
<?php  
echo htmlentities($result->Naziv);
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
 else{?>
  
<option class="others"> Invalid ISBN Number</option>
<?php
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}



?>
