<?php
    /**
     * We includen hier alle libraries die we nodig hebben
     * voor het mvc-framework
     */
    require_once 'libraries/Core.php';
    require_once 'libraries/BaseController.php';
    require_once 'libraries/Database.php';
    require_once 'config/config.php';

    /**
     * Flash message helper
     * Gebruikt sessies om tijdelijke berichten weer te geven
     */
    function flash($name = '', $message = '', $class = 'alert alert-success')
    {
        if (!empty($name)) {
            if (!empty($message) && empty($_SESSION[$name])) {
                if (!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION[$name] = $message;
                $_SESSION[$name . '_class'] = $class;
            } elseif (empty($message) && !empty($_SESSION[$name])) {
                $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
                echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name . '_class']);
            }
        }
    }

    /**
     * Redirect helper
     * Verstuurt de gebruiker naar een andere URL
     */
    function redirect($url)
    {
        header('Location: ' . URLROOT . '/' . $url);
        exit();
    }

    /**
     * Maak een instantie of object van de Core-Class
     */
    $init = new Core();