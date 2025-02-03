<?php

use Core\Database;
use Core\Validator;
use Core\App;

$email = $_POST['email'];
$password = $_POST['password'];

//validate the form inputs
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email address';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least 7 characters';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);
//Check if the account already exists
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();
if ($user) {
    //then someone with that email already exists and has an account.
    //if yes, redirect to home page
    header("location: /");
    exit();
} else {
    //if not, save one to the database, and then log the user in, and redirect
    $db -> query('insert into users (email, password) values (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ]);

    //mark that the user has logged in
    $_SESSION['user'] = [
        'email' => $email,
    ];
    header("location: /");
    exit();
}
