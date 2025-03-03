<?php

//log in the user if the credentials match
use Core\Authenticator;
use Http\Forms\LoginForm;

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$singedIn = (new Authenticator)->attempt($attributes['email'], $attributes['password']);

if (!$singedIn) {
    $form->error('email', 'No matching account found for this email and password.')->throw();
}
redirect('/');
