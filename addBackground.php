<?php

header('Content-Type: application/json');
header('Content-Type: bitmap; charset=utf-8');
include("connection.php");

$s = array();  
        $data = json_decode(file_get_contents("php://input"));
        $image = $data->base;
        $name = $data->text;
        $image = str_replace('data:image/png;base64,','',$image);
        $image = str_replace('data:image/jpg;base64,','',$image);
        $image = str_replace('data:image/jpeg;base64,','',$image);
        $image = str_replace(' ', '+', $image);
        $decoded_string = base64_decode($image);
        $path = 'images/'.$user_id.'.jpg';
        $file = fopen($path,'wp');
        $is_written = fwrite($file,$decoded_string);
        fclose($file);

        $query = "SELECT * FROM background ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0){

            	$sql = "update background set image=? where id = 1";
            	$stmt = $conn->prepare($sql);
                $stmt->execute([$path]);
                 $s = array(
                    'code'=>"1",
                        'image'=>$path,
                    'message'=>'image added successfully'
                );
                echo json_encode($s);
        }
        else{
        $sql = "INSERT INTO background (`image`) VALUES (?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([$path]);
                $s = array(
                    'code'=>"1",
                        'image'=>$path,
                    'message'=>'image added successfully'
                );
                echo json_encode($s);
        }
?>