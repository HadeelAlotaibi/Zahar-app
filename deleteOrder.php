<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();

        
        $data = json_decode(file_get_contents("php://input"));
        $order_id = $data->order_id;
        
            		
            		$sql = "delete from orders where id = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$order_id]);

                                $s= array(
                                    'code'=>"1",
                                    'message'=>"Order was deleted successfully"
                                );
                        echo json_encode($s);
            		
                
            
        
?>