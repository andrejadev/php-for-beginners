<?php

//log in the user if the credentials match
use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {
    $auth = new Authenticator();

    if ($auth->attempt($email, $password)) {
        redirect('/');
    } else {
        $form->error('email', 'The email and password does not exist.');
    }
}

Session::flash('errors', $form->errors());
Session::flash('old', [
    'email' => $_POST['email']
    ]);

return redirect('/login');
