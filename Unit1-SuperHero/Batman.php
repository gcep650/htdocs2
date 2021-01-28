<?php
require_once("SuperHero.php");
class Batman extends SuperHero
{

    public function __construct()
    {
        parent::__construct("Batman", rand(1,1000));
    }
}

