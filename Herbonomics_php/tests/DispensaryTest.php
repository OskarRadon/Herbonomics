<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	require_once 'src/Dispensary.php';

	$server = 'mysql:host=localhost;dbname=herbonomics_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

	class DispensaryTest extends PHPUnit_Framework_TestCase
	{
		protected function tearDown()
		{
			Dispensary::deleteAll();
		}

		function test_getters()
		{
			//Arrange
			$name = "Alberta Street Dispensary";
			$id = 1;
			$website = "www.absgh.com";
			$email = "alberta@absgh.com";
			$username = "alberta";
			$password = "hello";
			$test_dispensary = new Dispensary($name, $website, $email, $username, $password, $id);

			//Act
			$result1 = $test_dispensary->getName();
			$result2 = $test_dispensary->getWebsite();
			$result3 = $test_dispensary->getEmail();
			$result4 = $test_dispensary->getUsername();
			$result5 = $test_dispensary->getPassword();
			$result6 = $test_dispensary->getId();

			//Assert
			$this->assertEquals("Alberta Street Dispensary", $result1);
			$this->assertEquals("www.absgh.com", $result2);
			$this->assertEquals("alberta@absgh.com", $result3);
			$this->assertEquals("alberta", $result4);
			$this->assertEquals("hello", $result5);
			$this->assertEquals(1, $result6);
		}

		function test_save()
		{
			//Arrange
			$name = "Alberta Street Dispensary";
			$id = null;
			$website = "www.absgh.com";
			$email = "alberta@absgh.com";
			$username = "alberta";
			$password = "hello";
			$test_dispensary = new Dispensary($name, $website, $email, $username, $password, $id);

			//Act
			$test_dispensary->save();
			$result = Dispensary::getAll();
			//Assert
			$this->assertEquals([$test_dispensary], $result);
		}

		function test_getAll()
		{
			//Arrange
			$name = "Alberta Street Dispensary";
			$id = null;
			$website = "www.absgh.com";
			$email = "alberta@absgh.com";
			$username = "alberta";
			$password = "hello";
			$test_dispensary = new Dispensary($name, $website, $email, $username, $password, $id);
			$test_dispensary->save();

			$name2 = "Mississippi Street Dispensary";
			$website2 = "www.missdis.com";
			$email2 = "mississippi@msd.com";
			$username2 = "mississippi";
			$password2 = "hello1";
			$test_dispensary2 = new Dispensary($name2, $website2, $email2, $username2, $password2, $id);
			$test_dispensary2->save();

			//Act
			$result = Dispensary::getAll();

			//Assert
			$this->assertEquals([$test_dispensary, $test_dispensary2], $result);
		}
		function test_deleteAll()
		{
			//Arrange
			$name = "Alberta Street Dispensary";
			$id = null;
			$website = "www.absgh.com";
			$email = "alberta@absgh.com";
			$username = "alberta";
			$password = "hello";
			$test_dispensary = new Dispensary($name, $website, $email, $username, $password, $id);
			$test_dispensary->save();

			$name2 = "Mississippi Street Dispensary";
			$website2 = "www.missdis.com";
			$email2 = "mississippi@msd.com";
			$username2 = "mississippi";
			$password2 = "hello1";
			$test_dispensary2 = new Dispensary($name2, $website2, $email2, $username2, $password2, $id);
			$test_dispensary2->save();

			//Act
			Dispensary::deleteAll();
			//Assert
			$this->assertEquals([], Dispensary::getAll());
		}

		function test_find()
		{
			//Arrange
			$name = "Alberta Street Dispensary";
			$id = null;
			$website = "www.absgh.com";
			$email = "alberta@absgh.com";
			$username = "alberta";
			$password = "hello";
			$test_dispensary = new Dispensary($name, $website, $email, $username, $password, $id);
			$test_dispensary->save();

			$name2 = "Mississippi Street Dispensary";
			$website2 = "www.missdis.com";
			$email2 = "mississippi@msd.com";
			$username2 = "mississippi";
			$password2 = "hello1";
			$test_dispensary2 = new Dispensary($name2, $website2, $email2, $username2, $password2, $id);
			$test_dispensary2->save();

			//Act
			$result = Dispensary::find($test_dispensary->getId());

			//Assert
			$this->assertEquals($test_dispensary, $result);
		}

		function test_delete()
		{
			//Arrange
			$name = "Alberta Street Dispensary";
			$id = null;
			$website = "www.absgh.com";
			$email = "alberta@absgh.com";
			$username = "alberta";
			$password = "hello";
			$test_dispensary = new Dispensary($name, $website, $email, $username, $password, $id);
			$test_dispensary->save();

			$name2 = "Mississippi Street Dispensary";
			$website2 = "www.missdis.com";
			$email2 = "mississippi@msd.com";
			$username2 = "mississippi";
			$password2 = "hello1";
			$test_dispensary2 = new Dispensary($name2, $website2, $email2, $username2, $password2, $id);
			$test_dispensary2->save();

			//Act
			$test_dispensary->delete();
			$result = Dispensary::getAll();

			//Assert
			$this->assertEquals([$test_dispensary2], $result);
		}

		function test_update()
		{
			//Arrange
			$name = "Alberta Street Dispensary";
			$id = null;
			$website = "www.absgh.com";
			$email = "alberta@absgh.com";
			$username = "alberta";
			$password = "hello";
			$test_dispensary = new Dispensary($name, $website, $email, $username, $password, $id);
			$test_dispensary->save();

			$new_name = "Mississippi Street Dispensary";
			$new_website= "www.missdis.com";
			$new_email = "mississippi@msd.com";
			$new_username = "mississippi";
			$new_password = "hello1";
			//Act
			$test_dispensary->update($new_name, $new_website, $new_email, $new_username, $new_password);
			//Assert
			$this->assertEquals($new_name, $test_dispensary->getName());
			$this->assertEquals($new_website, $test_dispensary->getWebsite());
			$this->assertEquals($new_email, $test_dispensary->getEmail());
			$this->assertEquals($new_username, $test_dispensary->getUsername());
			$this->assertEquals($new_password, $test_dispensary->getPassword());
		}



  }
?>
