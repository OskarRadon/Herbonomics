<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/GrowersStrains.php";
    $server = 'mysql:host=localhost;dbname=herbonomics_test'; //Might need to alter localhost port
    $user = 'root';
    $password = 'kontiki1234qwer';
    $DB = new PDO($server, $user, $password);
    class GrowersStrainsTest extends PHPUnit_Framework_TestCase

    {
    protected function tearDown()
    {
        GrowersStrains::deleteAll();
    }
        function testGetInfo()
        {
            //Arrange

        }
    }
?>
