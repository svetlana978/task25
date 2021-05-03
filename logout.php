<?
// Страница разавторизации 
// Удаляем куки
setcookie("id", "", time() - 3600*24*30*12, "/");
setcookie("hash", "", time() - 3600*24*30*12, "/",null,null,true); // httponly !!! 
// Переадресовываем браузер на страницу проверки нашего скрипта
header("Location: /"); exit; 
?>

<form method="post" action="">
<input type="text" name="login" placeholder="Логин" required><br/>
<input type="password" name="pass" required> <br/>
<input type="hidden" name="token" value="<?=$token?>"> <br/>
<input type="chekbox" name="remember_me" value="Запомнить меня"> <br/>
<input type="submit" value="Войти">
</form>