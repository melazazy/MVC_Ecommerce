<?php

class Controller
{

    protected function view($view, $data = [])
    {
        if (file_exists("../app/views/layouts/" . $view . ".php")) {
            include "../app/views/layouts/" . $view . ".php";
        } else {
            include "../app/views/layouts/404.php";
        }
    }
    protected function loadmodel($model)
    {
        if (file_exists("../app/models/" . $model . ".php")) {
            include "../app/models/" . $model . ".php";
            return $model = new $model();
        }

        return false;
    }
}
