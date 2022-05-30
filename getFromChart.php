<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();

        
        $data = json_decode(file_get_contents("php://input"));
        $userID = $data->userID;
        
            		
            		$sql = "SELECT * from chart where user_id = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$userID]);
                    if($stmt->rowCount()>0){
                        $cart = $stmt->fetchAll();
                        foreach($cart as $c){
                            if($c['product_id'] == 0){
                                $s[] = array(
                                    'code'=>"0",
                                    'imageURL'=>"",
                                    'price'=>"".$c['price']
                                );
                            }
                            else{
                                $sql = "SELECT * from products where id = ?";
                                $stmt = $conn ->prepare($sql);
                                $stmt->execute([$c['product_id']]);
                                $product = $stmt->fetch();
                                $s[] = array(
                                    'code'=>"1",
                                    'imageURL'=>$product['image'],
                                    'price'=>"".$c['price']
                                );
                            }
                            
                        }
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