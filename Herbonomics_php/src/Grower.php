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

    function setEmail($new_email)
    {
        $this->email = $new_email;
    }

    function getEmail()
    {
        return $this->email;
    }

    function setPassword($new_password)
    {
        $this->password = $new_password;
    }

    function getPassword()
    {
        return $this->password;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO growers (name, website, email, username, password) VALUES ('{$this->getName()}', '{$this->getWebsite()}', '{$this->getEmail()}', '{$this->getUsername()}', '{$this->getPassword()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_growers = $GLOBALS['DB']->query("SELECT * FROM growers;");
        $growers = array();

        foreach($returned_growers as $grower) {
            $id = $grower['id'];
            $name = $grower['name'];
            $website = $grower['website'];
            $email = $grower['email'];
            $username = $grower['username'];
            $password = $grower['password'];
            $new_grower = new Grower($id, $name, $website, $email, $username, $password);
            array_push($growers, $new_grower);
        }
        return $growers;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM growers;");
    }

    static function findById($search_id)
        {
            $found_grower = null;
            $growers = Grower::getAll();

            foreach($growers as $grower) {
                $grower_id = $grower->getId();
                if ($grower_id == $search_id) {
                    $found_grower = $grower;
                }
            }
            return $found_grower;
        }

}

 ?>
