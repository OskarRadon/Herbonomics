<?php
    Class Dispensary
    {
        private $name;
        private $id;
        private $website;
        private $email;
        private $username;
        private $password;

        function __construct($name, $website, $email, $username, $password, $id=null)
        {
            $this->name = $name;
            $this->website = $website;
            $this->email = $email;
            $this->username = $username;
            $this->password = $password;
            $this->id = $id;
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

        function setWebsite($new_website)
        {
            $this->website = $new_website;
        }

        function getWebsite()
        {
            return $this->website;
        }

        function setEmail($new_email)
        {
            $this->email = $new_email;
        }

        function getEmail()
        {
            return $this->email;
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


		function save()
		{
			$existing_dispensaries = $GLOBALS['DB']->query("SELECT * FROM dispensaries");
			$GLOBALS['DB']->exec("INSERT INTO dispensaries (name, website, email, username, password) VALUES ('{$this->getName()}', '{$this->getWebsite()}', '{$this->getEmail()}', '{$this->getUsername()}', '{$this->getPassword()}');");
			$this->id = $GLOBALS['DB']->lastInsertId();
		}

		static function getAll()
		{
			$returned_dispensaries = $GLOBALS['DB']->query("SELECT * FROM dispensaries");
			$dispensaries = array();
			foreach($returned_dispensaries as $dispensary){
				 $name = $dispensary['name'];
				 $website = $dispensary['website'];
				 $email = $dispensary['email'];
				 $username = $dispensary['username'];
				 $password = $dispensary['password'];
				 $id = $dispensary['id'];
				 $new_dispensary = new Dispensary($name, $website, $email, $username, $password, $id);
				 array_push($dispensaries, $new_dispensary);
			}
			return $dispensaries;
		}

		static function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE FROM dispensaries");
		}

        static function find($id)
        {
            $all_dispensaries = Dispensary::getAll();
            $found_dispensary = null;
            foreach($all_dispensaries as $dispensary) {
                $dispensary_id = $dispensary->getId();
                if ($dispensary_id == $id) {
                    $found_dispensary = $dispensary;
                }
            }
            return $found_dispensary;
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM dispensaries WHERE id = {$this->getId()};");
        }

        function update($new_name, $new_website, $new_email, $new_username, $new_password)
		{
            $GLOBALS['DB']->exec("UPDATE dispensaries SET name = '{$new_name}', website = '{$new_website}', email = '{$new_email}', username = '{$new_username}', password = '{$new_password}' WHERE id={$this->getId()};");
            $this->setName($new_name);
            $this->setWebsite($new_website);
            $this->setEmail($new_email);
            $this->setUsername($new_username);
            $this->setPassword($new_password);
		}

        static function signIn($username, $password)
        {
            $all_dispensaries = Dispensary::getAll();
            $user = null;
            foreach($all_dispensaries as $dispensary){
                $dispensary_username = $dispensary->getUsername();
                $dispensary_password = $dispensary->getPassword();
                if($dispensary_username == $username && $dispensary_password == $password) {
                    $user = $dispensary;
                }
            }
            return $user;
        }

        function saveId()
        {
            $_SESSION['id'] = $this->id;
            $_SESSION['type'] = "dispensary";
        }

        static function signOut()
        {
            $_SESSION['id'] = null;
            $_SESSION['type'] = null;
        }

        function addGrower($grower_id)
        {
         $GLOBALS['DB']->exec("INSERT INTO dispensaries_growers (dispensary_id, grower_id) VALUES ({$this->getId()}, {$grower_id}) ;");
        }

        function getGrowers()
        {
         $query = $GLOBALS['DB']->query("SELECT growers.* FROM dispensaries JOIN dispensaries_growers ON (dispensaries.id = dispensaries_growers.dispensary_id) JOIN growers ON (dispensaries_growers.grower_id = growers.id) WHERE dispensaries.id = {$this->getId()}; ");
         $returned_growers = array();
         $returned_growers = $query->fetchAll(PDO::FETCH_ASSOC);
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

       function checkFollow($grower_id)
       {
         $existing_follows = $GLOBALS['DB']->query("SELECT * FROM dispensaries_growers");
         			foreach ($existing_follows as $follow) {
         				if ($follow['grower_id'] == $grower_id and $follow['dispensary_id'] == $this->getId()) {
         					return true;
         				}
         			}
              return false;
       }

    }

 ?>
