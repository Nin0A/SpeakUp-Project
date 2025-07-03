<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

function getUsers() {
    return json_decode(file_get_contents(__DIR__ . '/../database/users.json'), true);
}

function saveUsers($users) {
    file_put_contents(__DIR__ . '/../database/users.json', json_encode($users, JSON_PRETTY_PRINT));
}

function register($username, $password) {
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            return ['error' => 'User already exists'];
        }
    }
    $users[] = ['username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)];
    saveUsers($users);
    return ['message' => 'User registered'];
}

function login($username, $password) {
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            return ['message' => 'Login successful'];
        }
    }
    return ['error' => 'Invalid credentials'];
}
