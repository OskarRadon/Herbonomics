<?php

class Grower
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

    function setName($new_name)
    {
        $this->name = $new_name;
    }

    function getName()
    {
        return $this->name;
    }

    function setWebsite($new_web_name)
    {
        $this->website = $new_web_name;
    }

    function getWebsite()
    {
        return $this->website;
    }

    function setUsername($new_username)
    {
        $this->username = $new_username;
    }

    function getUsername()
    {
        return $this->username;
    }

    function setPassword($new_password)
    {
        $this->password = $new_password;
    }

    function getPassword()
    {
        return $this->password;
    }

}

 ?>
