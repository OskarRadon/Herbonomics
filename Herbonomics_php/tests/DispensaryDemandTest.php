<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	require_once 'src/DispensaryDemand.php';

	$server = 'mysql:host=localhost;dbname=herbonomics_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

	class DispensaryDemandTest extends PHPUnit_Framework_TestCase
	{
		protected function tearDown()
		{
			DispensaryDemand::deleteAll();
		}

		function test_getters()
        {
        //Arrange
        $strain_name = "Blue Dream";
        $dispensary_id = 1;
        $pheno = "Indica";
        $quantity = 1;
        $id = 1;
        $test_dispensary_demand = new DispensaryDemand($strain_name, $dispensary_id, $pheno, $quantity, $id);

        //Act
        $result1 = $test_dispensary_demand->getStrainName();
        $result2 = $test_dispensary_demand->getDispensaryId();
        $result3 = $test_dispensary_demand->getPheno();
        $result4 = $test_dispensary_demand->getQuantity();
        $result5 = $test_dispensary_demand->getId();

        //Assert
        $this->assertEquals("Blue Dream", $result1);
        $this->assertEquals(1, $result2);
        $this->assertEquals("Indica", $result3);
        $this->assertEquals(1, $result4);
        $this->assertEquals(1, $result5);
        }

        function test_save()
		{
            //Arrange
            $strain_name = "Blue Dream";
            $dispensary_id = 1;
            $pheno = "Indica";
            $quantity = 1;
            $id = 1;
            $test_dispensary_demand = new DispensaryDemand($strain_name, $dispensary_id, $pheno, $quantity, $id);

			//Act
			$test_dispensary_demand->save();
			$result = DispensaryDemand::getAll();
			//Assert
			$this->assertEquals([$test_dispensary_demand], $result);
		}

		function test_getAll()
		{
            //Arrange
            $strain_name = "Blue Dream";
            $dispensary_id = 1;
            $pheno = "Indica";
            $quantity = 1;
            $id = null;
            $test_dispensary_demand = new DispensaryDemand($strain_name, $dispensary_id, $pheno, $quantity, $id);
			$test_dispensary_demand->save();

            $strain_name2 = "Purple Haze";
            $dispensary_id2 = 2;
            $pheno2 = "Sativa";
            $quantity2 = 1;
            $test_dispensary_demand2 = new DispensaryDemand($strain_name2, $dispensary_id2, $pheno2, $quantity2, $id);
			$test_dispensary_demand2->save();

			//Act
			$result = DispensaryDemand::getAll();

			//Assert
			$this->assertEquals([$test_dispensary_demand, $test_dispensary_demand2], $result);
		}
		function test_deleteAll()
		{
            //Arrange
            $strain_name = "Blue Dream";
            $dispensary_id = 1;
            $pheno = "Indica";
            $quantity = 1;
            $id = null;
            $test_dispensary_demand = new DispensaryDemand($strain_name, $dispensary_id, $pheno, $quantity, $id);
			$test_dispensary_demand->save();

            $strain_name2 = "Purple Haze";
            $dispensary_id2 = 2;
            $pheno2 = "Sativa";
            $quantity2 = 1;
            $test_dispensary_demand2 = new DispensaryDemand($strain_name2, $dispensary_id2, $pheno2, $quantity2, $id);
			$test_dispensary_demand2->save();

			//Act
			DispensaryDemand::deleteAll();
			//Assert
			$this->assertEquals([], DispensaryDemand::getAll());
		}

        function test_find()
        {
            //Arrange
            $strain_name = "Blue Dream";
            $dispensary_id = 1;
            $pheno = "Indica";
            $quantity = 1;
            $id = null;
            $test_dispensary_demand = new DispensaryDemand($strain_name, $dispensary_id, $pheno, $quantity, $id);
        	$test_dispensary_demand->save();

            $strain_name2 = "Purple Haze";
            $dispensary_id2 = 2;
            $pheno2 = "Sativa";
            $quantity2 = 1;
            $test_dispensary_demand2 = new DispensaryDemand($strain_name2, $dispensary_id2, $pheno2, $quantity2, $id);
        	$test_dispensary_demand2->save();

			//Act
			$result = DispensaryDemand::find($test_dispensary_demand->getId());
			//Assert
			$this->assertEquals($test_dispensary_demand, $result);
		}


    }

?>
