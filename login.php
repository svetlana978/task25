<?php
session_start();

$token = hash('gost-crypto', random_int(0,999999));
$_SESSION["CSRF"] = $token;

// Страница авторизации 
// Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
} 


// Соединяемся с БД
$link=mysqli_connect("localhost", "root", "root", "test"); 
if(isset($_POST['submit']))
{
    if($_POST["token"] == $_SESSION["CSRF"])
    {
        //Начинаем проверку логина и пароля в БД

        // Вытаскиваем из БД запись, у которой логин равняется введенному
        $query = mysqli_query($link,"SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
        $data = mysqli_fetch_assoc($query); 
        // Сравниваем пароли
        if($data['user_password'] === md5(md5($_POST['password'])))
        {
            // Генерируем случайное число и шифруем его
            $hash = md5(generateCode(10));
    
            if(!empty($_POST['remember_me']))
            {
            
            // Записываем в БД новый хеш авторизации и IP
            mysqli_query($link, "UPDATE users SET user_hash='".$hash."' WHERE user_id='".$data['user_id']."'"); 
            // Ставим куки
            setcookie("id", $data['user_id'], time()+60*60*24*30, "/");
            setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!! 
            // Переадресовываем браузер на страницу проверки нашего скрипта
            header("Location: check.php"); exit();
            }
            else {
            print "Вы ввели неправильный логин/пароль";
            }
        }
    }
}
?>

<form method="post" action="">
<input type="text" name="login" placeholder="Логин" required><br/>
<input type="password" name="pass" required> <br/>
<input type="hidden" name="token" value="<?=$token?>"> <br/>
<input type="chekbox" name="remember_me" value="Запомнить меня"> <br/>
<input type="submit" value="Войти">
</form>