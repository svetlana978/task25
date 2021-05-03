<?php
/**

 * @return PDO

 */

function get_connection()
{
    
    return new PDO('mysql:host=database;port=3307;dbname=registration', 'root', 'root');
}

function insert(array $data)
{
    $query = 'INSERT INTO users (login, password, created_at) VALUES(?, ?, ?)';
    $db = get_connection();
    $stmt = $db->prepare($query);
    return $stmt->execute($data);
}