<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();

        
        $data = json_decode(file_get_contents("php://input"));
        $userID = $data->userID;
        $total_price = 0.0;
            		
            		$sql = "SELECT * from chart where user_id = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$userID]);
                    if($stmt->rowCount()>0){
                        $cart = $stmt->fetchAll();
                        foreach($cart as $c){
                            $total_price = $total_price + $c['price'];  
                        }
                        $s= array(
                            'code'=>"1",
                            'total_price'=>"".$total_price,
                            'message'=>'this is total price'
                        );
                        echo json_encode($s);
                    }
		            else{
                        $s = array(
                            'code'=>"-1",
                            'total_price'=>null,
                            'message'=>'Sorry your cart is empty'
                        );
                        echo json_encode($s);
                    }
            		
                
            
        
?>