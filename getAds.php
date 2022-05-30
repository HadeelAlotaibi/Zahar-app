<?php
header('Content-Type: application/json');
include("connection.php");
$s = array();

        
            		
            		$sql = "SELECT * from ads ";
		            $stmt = $conn ->prepare($sql);
		            $stmt->execute();
                    if($stmt->rowCount()>0){
                        $ads = $stmt->fetchAll();
                        foreach($ads as $c){
                                $s[] = array(
                                    'URL'=>$c['image'],
                                    'text'=>$c['text']
                                );
                            
                        }
                        echo json_encode($s);
                    }
		            else{
                        $s = array(
                            'code'=>"-1",
                            'message'=>'Sorry there is no ads'
                        );
                        echo json_encode($s);
                    }
            		
                
            
        
?>