<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();

        
        $data = json_decode(file_get_contents("php://input"));
        $user_id = $data->user_id;
        $random = $data->random;
        $monthly = $data->monthly;

        $product_id = 0 ;


        if($random == 0){
            $product_id = $data->product_id;

        }
        elseif($random == 1){
                    $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 1";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute();
                    $product = $stmt->fetch();
                    $product_id = $product['id']; 
        }
        $sql = "SELECT * FROM products where id = ?";
        $stmt = $conn ->prepare($sql);
        $stmt->execute([$product_id]);
        $products = $stmt->fetch();

      	
        
            		$sql = "INSERT INTO subscribe (`user_id`,`product_id`,`image`,`price`,`period`) VALUES (?,?,?,?,?)";
            		$stmt = $conn->prepare($sql);
            		$stmt->execute([$user_id,$product_id,$products['image'],$products['price'],$monthly]);
            		$sql = "SELECT * from subscribe where user_id = ? and product_id = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$user_id,$product_id]);
		            $sub = $stmt->fetch();
            		$s = array(
                    'code'=>"1",
                    	'sub_id'=>"".$sub['id'],
                        'user_id'=>"".$sub['user_id'],
                        'product_id'=>"".$product_id,
                        'imageURL'=>$sub['image'],
                        'price'=>"".$sub['price'],
                        'monthly'=>"".$monthly,
                    'message'=>'subscribe was added successfully'
                );
                echo json_encode($s);
            
        
?>