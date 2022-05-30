<?php
    include("connection.php");
    $s = array();
    
    $row = null;
    $data = json_decode(file_get_contents("php://input"));
    $user_id = $data->user_id;
    $period = $data->period;


        $query = "SELECT * FROM users WHERE id = ? ";
        $stmt = $conn->prepare($query);
        $stmt->execute([$user_id]);
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if($count > 0){
            $sql = "update users set subscribed=1,subscribed_period=? where id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$period,$user_id]);
                        $s = array(
                            'code' => "1",
                                'id' => "".$row['id'],
                                'name' => $row['name'],
                                'phone' => "".$row['phone'],
                                'email' => $row['email'],
                                'subscribed' => $row['subscribed'],
                                'subscribed_period' => $row['subscribed_period'],
                            'message' => 'subscribe successfully'
                        );
                        echo json_encode($s);
                
                }
                else{
                        $s = array(
                        'code'=>"-1",
                        'message'=>'user not found'
                            );
                        echo json_encode($s);
                }
?>