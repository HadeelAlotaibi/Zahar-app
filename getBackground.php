<?php
header('Content-Type: application/json');
header('Content-Type: bitmap; charset=utf-8');
include("connection.php");
$s = array();        
        $query = "SELECT * FROM background WHERE id = 1 ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) {
                $s = array(
                    'code'=>"1",
                    'image'=>$row['image'],
                    'message'=>'selected successfully'
                );
                echo json_encode($s); 
        }
        else{
                $s = array(
                    'code'=>"-1",
                    'message'=>'user did not uploaded image yet'
                );
                echo json_encode($s);  
        }
                 
?>