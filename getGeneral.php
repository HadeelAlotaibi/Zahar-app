<?php
header('Content-Type: application/json');
header('Content-Type: bitmap; charset=utf-8');
include("connection.php");
$s = array();
        $data = json_decode(file_get_contents("php://input"));
        
        $user_id = $data->user_id;
        
        $query = "SELECT * FROM users WHERE id = ? ";
        $stmt = $conn->prepare($query);
        $stmt->execute([$user_id]);
        $row = $stmt->fetch();
        if ($row['image'] == "") {
                $s = array(
                    'code'=>"-1",
                    'message'=>'user did not uploaded image yet'
                );
                echo json_encode($s);
        }
        else{
             $s = array(
                    'code'=>"1",
                        'user_id'=>$user_id,
                        'image'=>$row['image'],
                    'message'=>'selected successfully'
                );
                echo json_encode($s);   
        }
                 
?>