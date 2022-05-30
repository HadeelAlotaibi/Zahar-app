<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();

        
        $data = json_decode(file_get_contents("php://input"));
        $product_id = $data->product_id;
        
            		
            		$sql = "SELECT * from products where id = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$product_id]);
                    $c = $stmt->fetch();
                                $s = array(
                                    'product_id'=>"".$c['id'],
                                    'name'=>$c['name'],
                                    'price'=>"".$c['price'],
                                    'URL'=>$c['image'],
                                    'type'=>$c['type']
                                );
                           
                       
                        echo json_encode($s);

            		
                
            
        
?>