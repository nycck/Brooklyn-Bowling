<?php

function isAdmin()
{
    return isset($_SESSION['user_email']) && $_SESSION['user_email'] === 'test123@gmail.com';
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}
