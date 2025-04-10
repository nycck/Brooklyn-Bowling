<?php

class BaseController
{
    /**
     * Controleer of de gebruiker is ingelogd.
     */
    protected function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    /**
     * Controleer of de gebruiker is ingelogd als admin.
     */
    protected function isAdmin()
    {
        return isset($_SESSION['user_email']) && $_SESSION['user_email'] === 'test123@gmail.com';
    }
}