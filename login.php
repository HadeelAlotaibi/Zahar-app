<?php
header('Content-Type: application/json');
    include("connection.php");
    $s = array();
    
    $row = null;
    $data = json_decode(file_get_contents("php://input"));
    $phone = $data->phone;
    $password = $data->password;

     if (!empty($phone) && !empty($password))
    {


        $query = "SELECT * FROM users WHERE phone = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$phone, $password ]);
        
        $count = $stmt->rowCount();
        if($count > 0){
        $row = $stmt->fetch();
                        $s = array(
                                'code' => "1",
                                'id' => "".$row['id'],
                                'name' => $row['name'],
                                'phone' => "".$row['phone'],
                                'email' => $row['email'],
                                'message' => 'Login successfully'
                        );
                        echo json_encode($s);
                
                }
                else{
                        $s = array(
                        'code'=>"-1",
                        'data'=>null,
                        'message'=>'phone and/or password is wrong'
                            );
                        echo json_encode($s);
                }
}
else{
        $s = array(
        'code'=>"-1",
        'data'=>null,
        'message'=>'you have to enter phone & password'
        );
        echo json_encode($s); 
}

?>