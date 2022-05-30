<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();

        
        $data = json_decode(file_get_contents("php://input"));
        $user_id = $data->user_id;
        $sub_id = $data->sub_id;


        $sql = "delete from subscribe where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$sub_id]);
      	
            		$s = array(
                    'code'=>"1",
                    'message'=>'subscribe was canceled'
                );
                echo json_encode($s);
            
        
?>