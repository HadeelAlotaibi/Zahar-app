<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();

        
        $data = json_decode(file_get_contents("php://input"));
        $user_id = $data->user_id;


            		$sql = "SELECT * from subscribe where user_id = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$user_id]);
		            $subb = $stmt->fetchAll();

                    foreach($subb as $sub){
                        $s[] = array(
                                'sub_id'=>"".$sub['id'],
                                'user_id'=>"".$sub['user_id'],
                                'product_id'=>"".$sub['product_id'],
                                'imageURL'=>$sub['image'],
                                'price'=>"".$sub['price'],
                                'monthly'=>"".$sub['period']
                        );
                    }
            		
                echo json_encode($s);
            
        
?>