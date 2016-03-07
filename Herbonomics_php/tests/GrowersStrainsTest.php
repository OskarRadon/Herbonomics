<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/GrowersStrains.php";
    $server = 'mysql:host=localhost;dbname=herbonomics_test'; //Might need to alter localhost port
    $user = 'root';
    $password = 'root';
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
            $id = 1;
            $growers_id = 2;
            $strain_name = "Northern Lights";
            $pheno = "Indica";
            $thc = 22.14;
            $cbd = 0.18;
            $cgc = 1;
            $price = 1400;
            $test_growers_strains = new GrowersStrains($id, $growers_id, $strain_name, $pheno, $thc, $cbd, $cgc, $price);

            //Act
            $result1 = $test_growers_strains->getId();
            $result2 = $test_growers_strains->getGrowersId();
            $result3 = $test_growers_strains->getStrainName();
            $result4 = $test_growers_strains->getPheno();
            $result5 = $test_growers_strains->getThc();
            $result6 = $test_growers_strains->getCbd();
            $result7 = $test_growers_strains->getCgc();
            $result8 = $test_growers_strains->getPrice();

            //Assert
            $this->assertEquals($id, $result1);
            $this->assertEquals($growers_id, $result2);
            $this->assertEquals($strain_name, $result3);
            $this->assertEquals($pheno, $result4);
            $this->assertEquals($thc, $result5);
            $this->assertEquals($cbd, $result6);
            $this->assertEquals($cgc, $result7);
            $this->assertEquals($price, $result8);
        }
    }
?>
