<?php
/**

 * @return PDO

 */

function get_connection()
{
    
    return new PDO('mysql:host=localhost;port=3307;dbname=task25_users', 'root', 'root');
}

function insert(array $data)
{
    $query = 'INSERT INTO users (login, password) VALUES(?, ?)';
    $db = get_connection();
    $stmt = $db->prepare($query);
    return $stmt->execute($data);
}