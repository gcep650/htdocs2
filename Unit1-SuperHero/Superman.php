<?php
require_once("SuperHero.php");
class Superman extends SuperHero
{

    public function __construct()
    {
        parent::__construct("Superman", rand(1,1000));
    }
}

