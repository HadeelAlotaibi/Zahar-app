<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();

        
        $data = json_decode(file_get_contents("php://input"));
        $order_id = $data->order_id;
        
            		
            		$sql = "SELECT * from orders where id = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$order_id]);
                    if($stmt->rowCount()>0){
                        $c = $stmt->fetch();
                            if($c['product_id'] == 0){
                                $s = array(
                                    'order_id'=>"".$c['id'],
                                    'code'=>"0",
                                    'imageURL'=>null,
                                    'price'=>"".$c['price']
                                );
                            }
                            else{
                                $sql = "SELECT * from products where id = ?";
                                $stmt = $conn ->prepare($sql);
                                $stmt->execute([$c['id']]);
                                $product = $stmt->fetch();
                                $s= array(
                                    'order_id'=>"".$c['id'],
                                    'code'=>"1",
                                    'imageURL'=>$product['image'],
                                    'price'=>"".$c['price']
                                );
                            }
                            
                       
                        echo json_encode($s);
                    }
		            else{
                        $s = array(
                            'code'=>"-1",
                            'message'=>'Sorry you does not request any orders'
                        );
                        echo json_encode($s);
                    }
            		
                
            
        
?>