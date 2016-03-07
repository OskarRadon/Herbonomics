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

    // protected function tearDown()
    // {
    //     Grower::deleteAll();
    // }

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

        // function test_getInfo()
        // {
        //     // Arrange
        //     $store_name = "Foot Locker";
        //     $id = 3;
        //     $store_phone = "503-111-2222";
        //
        //     $test_store = new Store($store_name, $store_phone, $id);
        //     // Act
        //     $result1 = $test_store->getStoreName();
        //     $result2 = $test_store->getStorePhone();
        //     $result3 = $test_store->getId();
        //     // Assert
        //     $this->assertEquals($store_name, $result1);
        //     $this->assertEquals($store_phone, $result2);
        //     $this->assertEquals($id, is_numeric($result3));
        // }


    }
?>
