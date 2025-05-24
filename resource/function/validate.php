<?php 
use mysql_xdevapi\Exception;


// validatte php 
//
function addcry($name,$addre,$icon=""){
global $db;
  try {
  $sqladd ="INSERT INTO cry(name,addre,icon) VALUES(:name, :addre, :icon)";
  $stmt = $db->prepare($sqladd);
  $stmt->bindParam(':name',$name);
  $stmt->bindParam(':addre', $addre);
  $stmt->bindParam(':icon',$icon);
  $stmt->execute();
  }catch(Exception $e){
    echo"Fatal error : " . $e->getMessage();
  }
}
