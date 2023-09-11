<?php
require('../app/core/Printing.php');
class App{
    public function __construct()
    {   
        $pp = new Printing();
        $url = $this->splitUrl();
        $pp->printarray($url);
    }

    private function splitUrl(){
        return explode("/",trim($_GET['url'],"/"));
    }
}