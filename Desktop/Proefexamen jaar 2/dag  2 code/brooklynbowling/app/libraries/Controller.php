<?php

class Controller
{
    // Laad een model
    public function model($model)
    {
        require_once '../models/' . $model . '.php';
        return new $model();
    }

    // Laad een view
    public function view($view, $data = [])
    {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('View bestaat niet.');
        }
    }
}