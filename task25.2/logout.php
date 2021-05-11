<?
// Страница разавторизации 
start_session();
$link = mysqli_connect("localhost", "root", "root", "task25_users"); 

if(isset($_COOKIE["password_cookie_token"])){
 
    $update_password_cookie_token = mysqli_query($link, "UPDATE users SET cookie_token = '' WHERE login = '".$_SESSION["login"]."'");
     
    if($update_password_cookie_token){
        setcookie("password_cookie_token", "", time() - 3600);
        header("Location: login.php"); exit; 
    }else{
        
        echo "Ошибка ";
    }
}
/*
// Удаляем куки
setcookie("id", "", time() - 3600*24*30*12, "/");
setcookie("hash", "", time() - 3600*24*30*12, "/",null,null,true); // httponly !!! 
*/
// Переадресовываем браузер на страницу проверки нашего скрипта

?>
