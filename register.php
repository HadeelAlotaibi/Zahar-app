<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();
	    

        $data = json_decode(file_get_contents("php://input"));
        $name = $data->name;
        $phone = $data->phone;
        $password = $data->password;
        $email = $data->email;
        
      		$sql = "SELECT * from users where phone = ?";
            $stmt = $conn ->prepare($sql);
            $stmt->execute([$phone]);
            if($stmt->rowCount()>0){
                        $s = array(
                'code'=>"-1",
                'data'=>null,
                'message'=>'sorry this phone number is already exists'
            ); 
            echo json_encode($s);
             }
            else{
        
            		$sql = "INSERT INTO users (`name`,`phone`,`password`,`email`) VALUES (?,?,?,?)";
            		$stmt = $conn->prepare($sql);
            		$stmt->execute([$name,$phone,$password,$email]);
            		$sql = "SELECT * from users where phone = ?";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute([$phone]);
		            $user = $stmt->fetch();
            		$s = array(
                    'code'=>"1",
                    	'id'=>"".$user['id'],
                        'name'=>$name,
                        'phone'=>"".$phone,
                        'password'=>$password,
                        'email'=>$email,
                    'message'=>'User Added successfully'
                );
                echo json_encode($s);
            
        }
?>