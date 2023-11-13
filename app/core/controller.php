<?php

class Controller
{

    protected function view($view, $data = [])
    {
        if (file_exists("../app/views/layouts/" . $view . ".php")) {
            include "../app/views/layouts/" . $view . ".php";
            // } else if (file_exists("../app/views/admin/" . $view . ".php")) {
            //     include "../app/views/admin/" . $view . ".php";
            // } else if (file_exists("../app/views/auth/" . $view . ".php")) {
            //     include "../app/views/auth/" . $view . ".php";
            // } else if (file_exists("../app/views/user/" . $view . ".php")) {
            //     include "../app/views/user/" . $view . ".php";
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
