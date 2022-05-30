<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();

        
        $data = json_decode(file_get_contents("php://input"));
        $userID = $data->userID;
        $code = $data->code;
        $data1 = $data->data;

        $product_id = 0 ;
        $price = 0 ;

        if($code == 1){
            $product_id = $data1->productID;
            $quantity = $data1->quantity;

            $sql = "SELECT * from products where id = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$product_id]);
                    $c = $stmt->fetch();
                    $price = $quantity * $c['price'];
                    $sql = "INSERT INTO chart (`user_id`,`code`,`product_id`,`price`,`quantity`) VALUES (?,?,?,?,?)";
            		$stmt = $conn->prepare($sql);
            		$stmt->execute([$userID,$code,$product_id,$price,$quantity]);
            		$sql = "SELECT * from chart where user_id = ? and product_id = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$userID,$product_id]);
		            $product = $stmt->fetch();
            		$s = array(
                    'code'=>"1",
                    	'id'=>"".$product['id'],
                        'user_id'=>"".$userID,
                        'product_id'=>$product_id,
                        'price'=>"".$price,
                        'quantity'=>"".$quantity,
                    'message'=>'product was Added to chart successfully'
                );
                echo json_encode($s);
                    
        }
        elseif($code ==0){
            $price = $data1->price;
            $sql = "INSERT INTO chart (`user_id`,`code`,`product_id`,`price`,`quantity`) VALUES (?,?,?,?,?)";
            		$stmt = $conn->prepare($sql);
            		$stmt->execute([$userID,$code,$product_id,$price,1]);
            		$sql = "SELECT * from chart where user_id = ? and product_id = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$userID,$product_id]);
		            $product = $stmt->fetch();
            		$s = array(
                    'code'=>"1",
                    	'id'=>"".$product['id'],
                        'user_id'=>"".$userID,
                        'product_id'=>$product_id,
                        'price'=>"".$price,
                        'quantity'=>"1",
                    'message'=>'product was Added to chart successfully'
                );
                echo json_encode($s);
        }
        

      	
        
            		
            
        
?>