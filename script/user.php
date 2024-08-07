<?php
include 'demo.php';
include 'config.php';

if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    $data = [
        'email' => $email,
        'password' => $password,
        'returnSecureToken' => true
    ];

    $url = 'https://identitytoolkit.googleapis.com/v1/accounts:signUp?key=' . FIREBASE_API_KEY;
    $response = firebaseRequest($url, $data, 'POST');

    if (isset($response['error'])) {
        echo 'Error: ' . $response['error']['message'];
    } else {
        $uid = $response['localId'];
        $userData = [
            'username' => $username,
            'email' => $email
        ];
        writeToFirebase('users/' . $uid, $userData);
        
        session_start();
        $_SESSION['uid'] = $uid;
        $_SESSION['username'] = $username;

        echo 'User created successfully with username';
        header('Location: \hackathon-week-1\login');
    }
}


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = [
        'email' => $email,
        'password' => $password,
        'returnSecureToken' => true
    ];

    $url = 'https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword?key=' . FIREBASE_API_KEY;
    $response = firebaseRequest($url, $data, 'POST');

    if (isset($response['error'])) {
        echo 'Error: ' . $response['error']['message'];
    } else {
        session_start();
        $uid = $response['localId'];
        $userData = readFromFirebase('users/' . $uid);
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user_data'] = array(
            "id"	=> $response['localId'],
            "pame"	=> $userData['username'],
            "email"	=> $response['email']
        );
        echo 'User signed in successfully';
        header('Location: \hackathon-week-1\client');
    }
}
?>