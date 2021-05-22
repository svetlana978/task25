<?php
//require_once("app/db.php");

session_start();



if(isset($_COOKIE["password_cookie_token"]) && !empty($_COOKIE["password_cookie_token"])){
    
    $link = mysqli_connect("localhost", "root", "root", "task25_users"); 
    $select_user_data = mysqli_query($link,"SELECT login, password FROM users WHERE cookie_token = '".$_COOKIE["password_cookie_token"]."'");
 
    if(!$select_user_data){
        echo "<p class='mesage_error' >Ошибка выборки БД.</p>".$mysqli->error();
    }else{
 
        $array_user_data = mysqli_fetch_assoc($select_user_data);
 
        if($array_user_data){
             
            $_SESSION['login'] = $array_user_data["login"];
            $_SESSION['password'] = $array_user_data["password"];
 
        }
    }
 
}
?>

<html>
    <head>
        <title>Hello</title>
    </head>
    <body>
        <div>Hello!!</div>
    </body>
</html>