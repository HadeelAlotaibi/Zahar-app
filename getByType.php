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
                        $s = array(
                'code'=>"-1",
                'message'=>'there is no products like this type'
            ); 
            echo json_encode($s);
             }
            else{
        
            		$sql = "SELECT * from products where type = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$type]);
		            $product = $stmt->fetchAll();
                    foreach ($product as $p) {
                       $s[] = array(
                        'code'=>"1",
                        'url'=>$p['design'],
                        'id'=>$p['id'],
                        'price'=>$p['price'],
                        'type'=>$p['type'],
                        'name'=>$p['name'],
                        'discount'=>$p['discount']
                );
                    }
            		
                echo json_encode($s);
            
        }
?>