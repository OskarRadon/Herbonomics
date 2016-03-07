<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	require_once 'src/Dispensary.php';

	$server = 'mysql:host=localhost;dbname=_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

	class DispensaryTest extends PHPUnit_Framework_TestCase
	{
		protected function tearDown()
		// {
		// 	Dispensary::deleteAll();
		//
		// }

		function test_getters()
		{
			//Arrange
			$dispensary_name = "Nike";
			$id = 1;
			$test_dispensary = new Dispensary($dispensary_name, $id);
			//Act
			$result1 = $test_dispensary->getDispensaryName();
			$result2 = $test_dispensary->getId();
			//Assert
			$this->assertEquals("Nike", $result1);
			$this->assertEquals(1, $result2);
		}
  }
?>
