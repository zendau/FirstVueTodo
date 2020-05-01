<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
$message = [];

$link = mysqli_connect('eu-cdbr-west-02.cleardb.net', 'b51586fa1b116d', '153a6d0d',  'heroku_472a299a341907a'); 

if (!$link) {
printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
exit;
}


if ($result = mysqli_query($link, 'SELECT * FROM users')) {

    while( $row = mysqli_fetch_assoc($result) ){
        array_push($message, $row);
    }
}


if(isset($_GET['ID'])){
    exit(json_encode(["ID" => $_GET['ID']]));
}else if(isset($_GET['post'])){

    $message = [];
    if ($result = mysqli_query($link, 'SELECT * FROM posts')) {

        while( $row = mysqli_fetch_assoc($result) ){
            array_push($message, $row);
        }
    }
    
    exit(json_encode($message));

}else if(isset($_GET['newPost'])){

    $json_dec = json_decode($_GET['newPost']);
    $result = mysqli_query($link, "INSERT posts VALUES (null, '$json_dec->title', '$json_dec->body')");
    $res = mysqli_insert_id($link);
    exit(json_encode($res));
}else if(isset($_GET['removePost'])){

    $query ="DELETE FROM posts WHERE id = '$_GET[removePost]'";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    exit(json_encode($_GET['removePost']));

}else if(isset($_GET['userLogin'])){
    

    $token = bin2hex(random_bytes(30));
    $data = json_decode($_GET['userLogin']);
    $result = mysqli_query($link, "SELECT * FROM users WHERE login = '$data->login'");
    if($row = mysqli_fetch_assoc($result)){
        $temp_query = mysqli_query($link, "SELECT * FROM users WHERE pass = '$data->pass'");
        if($temp_row = mysqli_fetch_assoc($temp_query)){
            $row['token'] = $token;
            $result = mysqli_query($link, "UPDATE users SET token='$token' WHERE login = '$data->login'");
            exit(json_encode($row));
        }else {
            exit(json_encode(['error' => "Не верный пароль"]));
        }
    }else {
        exit(json_encode(['error' => "Данный аккаунт не найден"]));
    }
    
}else if(isset($_GET['userReg'])){
    $data = json_decode($_GET['userReg']);
    
    $result = mysqli_query($link, "SELECT * FROM users WHERE login = '$data->login'");
    $token = bin2hex(random_bytes(30));
    if($row = mysqli_fetch_assoc($result)){
        exit(json_encode("Данный логин уже занят"));
    }else {
        $result = mysqli_query($link, "SELECT * FROM users WHERE email = '$data->email'");
        if($row = mysqli_fetch_assoc($result)){
            exit(json_encode("Данная почта уже занята"));
        }else {
            $result = mysqli_query($link, "INSERT users VALUES (null, '$data->login', '$data->pass', '$data->email', '$token')");
            $res = mysqli_insert_id($link);
            $result = mysqli_query($link, "INSERT todo VALUES ('$res', '{}')");
            exit(json_encode($res));
        }
        
    }
    

    
    
    
}else if(isset($_GET['checkUser'])) {

    $result = mysqli_query($link, "SELECT * FROM users WHERE token = '$_GET[checkUser]'");
    if($row = mysqli_fetch_assoc($result)){
        exit(json_encode($row));
    }else {
        exit(json_encode("Bad token"));
     }
}else if(isset($_GET['todo'])){

    $result = mysqli_query($link, "SELECT data FROM todo WHERE id = '$_GET[todo]'");
    $row = mysqli_fetch_assoc($result);
    exit(json_encode($row['data']));

}else if(isset($_GET['newTodo'])){

    $result = mysqli_query($link, "UPDATE todo set data = '$_GET[newTodo]'  WHERE id = '$_GET[idUser]'");
    exit(json_encode($_GET['newTodo']));

}else if(isset($_GET['typeTodo'])){

    $result = mysqli_query($link, "UPDATE todo set data = '$_GET[typeTodo]'  WHERE id = '$_GET[idUser]'");
    exit(json_encode($_GET['typeTodo']));

}




mysqli_close($link);


?>

<!DOCTYPE html><html lang=en><head><meta charset=utf-8><meta http-equiv=X-UA-Compatible content="IE=edge"><meta name=viewport content="width=device-width,initial-scale=1"><link rel=icon href=/favicon.ico><title>test</title><link href=/css/chunk-096a0a0a.50942434.css rel=prefetch><link href=/css/chunk-5064cae9.cdf70087.css rel=prefetch><link href=/css/chunk-605697bc.0379afd3.css rel=prefetch><link href=/js/chunk-096a0a0a.53266809.js rel=prefetch><link href=/js/chunk-2d22d746.d109ff47.js rel=prefetch><link href=/js/chunk-5064cae9.7a4a7e4d.js rel=prefetch><link href=/js/chunk-605697bc.bd9d09d9.js rel=prefetch><link href=/css/app.9ef6ad97.css rel=preload as=style><link href=/css/chunk-vendors.73152c73.css rel=preload as=style><link href=/js/app.5e347edd.js rel=preload as=script><link href=/js/chunk-vendors.d7d2db4f.js rel=preload as=script><link href=/css/chunk-vendors.73152c73.css rel=stylesheet><link href=/css/app.9ef6ad97.css rel=stylesheet></head><body><noscript><strong>We're sorry but test doesn't work properly without JavaScript enabled. Please enable it to continue.</strong></noscript><div id=app></div><script src=/js/chunk-vendors.d7d2db4f.js></script><script src=/js/app.5e347edd.js></script></body></html>