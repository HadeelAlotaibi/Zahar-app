<?php
header('Content-Type: application/json');
header('Content-Type: bitmap; charset=utf-8');
 include 'connection.php';

$data = json_decode(file_get_contents("php://input"));
        $email = $data->email;

$n=5;
function generateCode($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
}

$code = generateCode($n);


$query = "SELECT * FROM users WHERE email = ? ";
        $stmt = $conn->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        $count = $stmt->rowCount();

    if($count == 0){
        $s = array(
                    'code'=>"-1",
                    'message'=>'you have entered wrong email'
                );
                echo json_encode($s); 
    }
else{
$sql = "update users SET password = ? WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$code,$email]);
    $to      = $email;
    $subject = 'active ZAHER account';
    $message = 'Your verifaction code is :'. "\r\n" .$code;
    $headers = 'From: zaher2022@gmail.com'       . "\r\n" .
                 'active your account' . "\r\n" .
                 'by Zaher 2022';
                 
    mail($to, $subject, $message, $headers);

   $s = array(
                    'code'=>"1",
                    'message'=>'We have sent code to your email'
                );
                echo json_encode($s);
}
?>
