<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	require_once 'src/DispensaryDemand.php';
    require_once 'src/Dispensary.php';

	$server = 'mysql:host=localhost;dbname=herbonomics_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

	class DispensaryDemandTest extends PHPUnit_Framework_TestCase
	{
		protected function tearDown()
		{
			DispensaryDemand::deleteAll();
            Dispensary::deleteAll();
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

        function test_delete()
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
			$test_dispensary_demand->delete();
			$result = DispensaryDemand::getAll();

			//Assert
			$this->assertEquals([$test_dispensary_demand2], $result);
		}

		function test_update()
		{
            //Arrange
            $strain_name = "Blue Dream";
            $dispensary_id = 1;
            $pheno = "Indica";
            $quantity = 1;
            $id = null;
            $test_dispensary_demand = new DispensaryDemand($strain_name, $dispensary_id, $pheno, $quantity, $id);
        	$test_dispensary_demand->save();

            $new_strain_name = "Purple Haze";
            $new_pheno = "Sativa";
            $new_quantity = 50;

			//Act
			$test_dispensary_demand->update($new_strain_name, $new_pheno, $new_quantity);
            $db_output = DispensaryDemand::getAll();
            $found_dispensary_demand = $db_output[0];

			//Assert
			$this->assertEquals($new_strain_name, $found_dispensary_demand->getStrainName());
			$this->assertEquals($new_pheno, $found_dispensary_demand->getPheno());
			$this->assertEquals($new_quantity, $found_dispensary_demand->getQuantity());
		}

        function test_search()
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

            $search_term = "Purple";

            //Act
			$result = DispensaryDemand::search($search_term);
			//Assert
			$this->assertEquals([$test_dispensary_demand2], $result);
		}


    }

?>
