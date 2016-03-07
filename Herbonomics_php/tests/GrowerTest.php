<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Grower.php";

    $server = 'mysql:host=localhost;dbname=herbonomics_test'; //Might need to alter localhost port
    $user = 'root';
    $password = 'root';
    $DB = new PDO($server, $user, $password);

    class GrowerTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Grower::deleteAll();
        }

        function testGetInfo()
        {
            //Arrange
            $id = 1;
            $name = "Chalice Farms";
            $website = "chalicefarms.com";
            $email = "chalice@farms.com";
            $username = "chalice";
            $password = "maryjane";
            $test_grower = new Grower($id, $name, $website, $email, $username, $password);

            //Act
            $result1 = $test_grower->getId();
            $result2 = $test_grower->getName();
            $result3 = $test_grower->getWebsite();
            $result4 = $test_grower->getUsername();
            $result5 = $test_grower->getPassword();

            //Assert
            $this->assertEquals($id, $result1);
            $this->assertEquals($name, $result2);
            $this->assertEquals($website, $result3);
            $this->assertEquals($username, $result4);
            $this->assertEquals($password, $result5);
        }

        function test_save()
        {
            // Arrange
            $name = "Chalice Farms";
            $website = "chalicefarms.com";
            $email = "chalice@farms.com";
            $username = "chalice";
            $password = "maryjane";
            $test_grower = new Grower($id = null, $name, $website, $email, $username, $password);

            // Act
            $test_grower->save();
            $result = Grower::getAll();

            // Assert
            $this->assertEquals($test_grower, $result[0]);
        }

        function test_getAll()
        {
            // Arrange
            $name = "Chalice Farms";
            $website = "chalicefarms.com";
            $email = "chalice@farms.com";
            $username = "chalice";
            $password = "maryjane";
            $test_grower = new Grower($id = null, $name, $website, $email, $username, $password);
            $test_grower->save();

            $name2 = "Urban Pharms";
            $website2 = "urbanpharms.com";
            $email2 = "urban@pharms.com";
            $username2 = "urban";
            $password2 = "fireweed";
            $test_grower2 = new Grower($id2 = null, $name2, $website2, $email2, $username2, $password2);
            $test_grower2->save();

            // Act
            $result = Grower::getAll();

            // Assert
            $this->assertEquals([$test_grower, $test_grower2], $result);
        }

        function testDeleteAll()
        {
			//Arrange
            $name = "Chalice Farms";
            $website = "chalicefarms.com";
            $email = "chalice@farms.com";
            $username = "chalice";
            $password = "maryjane";
            $test_grower = new Grower($id = null, $name, $website, $email, $username, $password);
            $test_grower->save();

            $name2 = "Urban Pharms";
            $website2 = "urbanpharms.com";
            $email2 = "urban@pharms.com";
            $username2 = "urban";
            $password2 = "fireweed";
            $test_grower2 = new Grower($id2 = null, $name2, $website2, $email2, $username2, $password2);
            $test_grower2->save();

            //Act
            Grower::deleteAll();
            $result = Grower::getAll();
            //Assert
            $this->assertEquals([], $result);
        }

        function test_findById()
        {
            $name = "Chalice Farms";
            $website = "chalicefarms.com";
            $email = "chalice@farms.com";
            $username = "chalice";
            $password = "maryjane";
            $test_grower = new Grower($id = null, $name, $website, $email, $username, $password);
            $test_grower->save();

            $name2 = "Urban Pharms";
            $website2 = "urbanpharms.com";
            $email2 = "urban@pharms.com";
            $username2 = "urban";
            $password2 = "fireweed";
            $test_grower2 = new Grower($id2 = null, $name2, $website2, $email2, $username2, $password2);
            $test_grower2->save();

            $result = Grower::findById($test_grower->getId());

            $this->assertEquals($test_grower, $result);
        }

        function test_findByName()
        {
            $name = "Chalice Farms";
            $website = "chalicefarms.com";
            $email = "chalice@farms.com";
            $username = "chalice";
            $password = "maryjane";
            $test_grower = new Grower($id = null, $name, $website, $email, $username, $password);
            $test_grower->save();

            $name2 = "Urban Pharms";
            $website2 = "urbanpharms.com";
            $email2 = "urban@pharms.com";
            $username2 = "urban";
            $password2 = "fireweed";
            $test_grower2 = new Grower($id2 = null, $name2, $website2, $email2, $username2, $password2);
            $test_grower2->save();

            //Act
            $result = Grower::findByName($test_grower->getName());

            //Assert
            $this->assertEquals($test_grower, $result);
        }

        function test_update()
        {
            // Arrange
            $name = "Chalice Farms";
            $website = "chalicefarms.com";
            $email = "chalice@farms.com";
            $username = "chalice";
            $password = "maryjane";
            $test_grower = new Grower($id = null, $name, $website, $email, $username, $password);
            $test_grower->save();

            $new_name = "Chalice Farmz";
            $new_website = "chalicefarms.org";
            $new_email = "chalice@farmz.org";
            $new_username = "chalicefarmz";
            $new_password = "ilovemaryjane";

            // Act
            $test_grower->update($new_name, $new_website, $new_email, $new_username, $new_password);
            $result1 = $test_grower->getName();
            $result2 = $test_grower->getWebsite();
            $result3 = $test_grower->getEmail();
            $result4 = $test_grower->getUsername();
            $result5 = $test_grower->getPassword();

            // Assert
            $this->assertEquals($new_name, $result1);
            $this->assertEquals($new_website, $result2);
            $this->assertEquals($new_email, $result3);
            $this->assertEquals($new_username, $result4);
            $this->assertEquals($new_password, $result5);
        }

    }
?>
