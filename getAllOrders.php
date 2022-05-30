<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();

        
      
        
            		
            		$sql = "SELECT * from orders";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([]);
                    if($stmt->rowCount()>0){
                        $cart = $stmt->fetchAll();
                        foreach($cart as $c){
                            $query = "SELECT * FROM users WHERE id = ? ";
                            $stmt = $conn->prepare($query);
                            $stmt->execute([$c['user_id']]);
                            $user_info = $stmt->fetch();
                            if($c['product_id'] == 0){
                                $s[] = array(
                                    'order_id'=>"".$c['id'],
                                    'code'=>"0",
                                    'imageURL'=>"",
                                    'email'=>$user_info['email'],
                                    'price'=>"".$c['price']
                                );
                            }
                            else{
                                $sql = "SELECT * from products where id = ?";
                                $stmt = $conn ->prepare($sql);
                                $stmt->execute([$c['product_id']]);
                                $product = $stmt->fetch();
                                $s[] = array(
                                    'order_id'=>"".$c['id'],
                                    'code'=>"1",
                                    'imageURL'=>$product['image'],
                                    'email'=>$user_info['email'],
                                    'price'=>"".$c['price']
                                );
                            }
                            
                        }
                        echo json_encode($s);
                    }
		            else{
                        $s = array(
                            'code'=>"-1",
                            'message'=>'there is no orders'
                        );
                        echo json_encode($s);
                    }
            		
                
            
        
?>