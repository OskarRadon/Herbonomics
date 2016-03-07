<?php

class Growers
{
    private $id;
    private $name;
    private $website;
    private $email;
    private $username;
    private $password;

    function __construct($id=null, $name, $website, $email, $username, $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->website = $website;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    function getId()
    {
        return $this->id;
    }

    function setName($)
}

 ?>
