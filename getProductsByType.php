<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();

$data = json_decode(file_get_contents("php://input"));
$type = $data->type;     
            		
            		$sql = "SELECT * from products where type = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$type]);
                    if($stmt->rowCount()>0){
                        $products = $stmt->fetchAll();
                        foreach($products as $c){
                                $s[] = array(
                                    'product_id'=>"".$c['id'],
                                    'URL'=>$c['image'],
                                    'price'=>"".$c['price'],
                                    'type'=>$c['type'],
                                );
                            
                        }
                        echo json_encode($s);
                    }
		            else{
                        $s = array(
                            'code'=>"-1",
                            'message'=>'Sorry there is no products'
                        );
                        echo json_encode($s);
                    }
            		
                
            
        
?>