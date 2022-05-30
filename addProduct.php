<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();


        $data = json_decode(file_get_contents("php://input"));
        $name = $data->name;
        $price = $data->price;
        $image = $data->base;
        $type = $data->type;
        

        $image = str_replace('data:image/png;base64,','',$image);
        $image = str_replace('data:image/jpg;base64,','',$image);
        $image = str_replace('data:image/jpeg;base64,','',$image);
        $image = str_replace(' ', '+', $image);
        $decoded_string = base64_decode($image);
        $path = 'images/'.$name.'.jpg';
        $file = fopen($path,'wp');
        $is_written = fwrite($file,$decoded_string);
        fclose($file);



      		$sql = "SELECT * from products where name = ?";
            $stmt = $conn ->prepare($sql);
            $stmt->execute([$name]);
            if($stmt->rowCount()>0){
                        $s = array(
                'code'=>"-1",
                'data'=>null,
                'message'=>'sorry this product name is already exists'
            ); 
            echo json_encode($s);
             }
            else{
        
            		$sql = "INSERT INTO products (`name`,`price`,`image`,`type`) VALUES (?,?,?,?)";
            		$stmt = $conn->prepare($sql);
            		$stmt->execute([$name,$price,$path,$type]);
            		$sql = "SELECT * from products where name = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$name]);
		            $product = $stmt->fetch();
            		$s = array(
                    'code'=>"1",
                    	'id'=>"".$product['id'],
                        'name'=>$name,
                        'price'=>"".$price,
                        'URL'=>$path,
                        'type'=>$type,
                    'message'=>'product Added successfully'
                );
                echo json_encode($s);
            
        }
?>