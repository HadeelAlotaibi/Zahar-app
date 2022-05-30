<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();

        
        $data = json_decode(file_get_contents("php://input"));
        $product_id = $data->product_id;
        $name = $data->name;
            		
            		$sql = "update products set name = ? where id = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$name,$product_id]);
                                $s = array(
                                    'code'=>"1",
                                    'name'=>"products name was updated successfully"
                                );
                           
                       
                        echo json_encode($s);

            		
                
            
        
?>