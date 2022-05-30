<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();

        
        $data = json_decode(file_get_contents("php://input"));
        $product_id = $data->product_id;
        $price = $data->price;
            		
            		$sql = "update products set price = ? where id = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$price,$product_id]);
                                $s = array(
                                    'code'=>"1",
                                    'name'=>"products price was updated successfully"
                                );
                           
                       
                        echo json_encode($s);

            		
                
            
        
?>