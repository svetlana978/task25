<?php
function register(array $data)
{
    $values = [
        $data['login'],
        password_hash($data['password'], PASSWORD_ARGON2ID),
        (new DateTime())->format('Y-m-d H:i:s')
    ];
    return insert($values);
}

function validate(array $request)
{
    $errors = [];
    
    if (!isset($request['login']) || empty($request['login'])) {
        $errors[]['login'] = 'Логин не указано';
    }
    if (!isset($request['password']) || empty($request['password'])) {
        $errors[]['password'] = 'Пароль не указан';
    }
    if (!isset($request['repeat-password']) || empty($request['repeat-password'])) {

        $errors[]['repeat-password'] = 'Нужно повторить пароль';

    } elseif ((isset($request['password']) && isset($request['repeat-password'])) && ($request['password'] != $request['repeat-password'])) {

        $errors[]['repeat-password'] = 'Пароли не совпадают';
    }
    return $errors;
}

function isLoginAlreadyExists(string $login)
{
    if (getUserByLogin($login)) {
        return true;
    }
    return false;
}