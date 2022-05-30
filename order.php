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
                            $sql = "INSERT INTO orders (`user_id`,`code`,`product_id`,`price`) VALUES (?,?,?,?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute([$userID,$c['code'],$c['product_id'],$c['price']]);

                            $sql = "delete from chart where id = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute([$c['id']]);
                            
                        }
                        $s= array(
                            'code'=>"1",
                            'total_price'=>"".$total_price,
                            'message'=>'order was confirmed successfully'
                        );
                        echo json_encode($s);
                    }
		            else{
                        $s = array(
                            'code'=>"-1",
                            'message'=>'Sorry your cart is empty'
                        );
                        echo json_encode($s);
                    }
            		
                
            
        
?>