<?php
    require_once './Classes/Data.php';
    $data = new Data('localhost', 'voting', 'root', '','candidate');
    $res=$data->read();
    if(isset($_GET['id'])){
        $voteID=$_GET['id'];
        $candidate = $data->readOne($voteID);
        $data->update('votes',$candidate['votes']+1,$_GET['id']);
        
        header("location:index.php");
    }

    //print_r($res);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
       echo" <div>";
            
            for($i=0; $i<count($res); $i++){
                echo  "<a href='./?id=". $res[$i]['id']."'>vote</a> "; 
                foreach($res[$i] as $key => $value){
                    if($key!='id' && $key!='image'){
                        echo $value.' ';
                    }
                }
                echo'<br>';
            }
        echo"</div>";
    ?>
    
</body>
</html>