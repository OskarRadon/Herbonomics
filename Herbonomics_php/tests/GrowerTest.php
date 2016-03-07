<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Grower.php";

    $server = 'mysql:host=localhost;dbname=herbonomics_test';
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
            //Arrange
            $name = "Chalice Farms";
            $website = "chalicefarms.com";
            $email = "chalice@farms.com";
            $username = "chalice";
            $password = "maryjane";
            $test_grower = new Grower($id = null, $name, $website, $email, $username, $password);
            $test_grower->save();

            //Act
            $name2 = "Urban Pharms";
            $website2 = "urbanpharms.com";
            $email2 = "urban@pharms.com";
            $username2 = "urban";
            $password2 = "fireweed";
            $test_grower2 = new Grower($id2 = null, $name2, $website2, $email2, $username2, $password2);
            $test_grower2->save();

            $result = Grower::findById($test_grower->getId());

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
            $test_grower->save();

            $db_output = Grower::getAll();
            $found_grower = $db_output[0];

            // Assert
            $this->assertEquals($found_grower->getName(), $result1);
            $this->assertEquals($found_grower->getWebsite(), $result2);
            $this->assertEquals($found_grower->getEmail(), $result3);
            $this->assertEquals($found_grower->getUsername(), $result4);
            $this->assertEquals($found_grower->getPassword(), $result5);
        }

        function test_deleteOneGrower()
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
            $test_grower->deleteOneGrower();
            $result = Grower::getAll();

            // Assert
            $this->assertEquals([$test_grower2], $result);
        }

        function test_search()
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

            $search_term = "Urban";

            //Act
			$result = Grower::search($search_term);

			//Assert
			$this->assertEquals([$test_grower2], $result);
		}

        function test_signIn()
        {
            //Arrange
            $name = "Chalice Farms";
            $website = "chalicefarms.com";
            $email = "chalice@farms.com";
            $username = "chalice";
            $password = "maryjane";
            $test_grower = new Grower($id = null, $name, $website, $email, $username, $password);
            $test_grower->save();

            $sign_in_username = "chalice";
    		$sign_in_password = "maryjane";

            //Act
            $result = Grower::signIn($sign_in_username, $sign_in_password);
			$db_output = Grower::getAll();
			$found_grower = $db_output[0];

            //Assert
            $this->assertEquals($found_grower, $result);

        }
}
?>
