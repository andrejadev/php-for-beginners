<?php

use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

//validate the form inputs
$errors = [];
if(!Validator::email($email)){
    $errors['email'] = 'Please enter a valid email address';
}

if(!Validator::string($password,1, 255)){
    $errors['password'] = 'Please provide a password of at least 7 characters';
}

if(!empty($errors)){
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

//Check if the account already exists
    //if yes, redirect to login page
    //if not, save one to the database, and then log the user in, and redirect