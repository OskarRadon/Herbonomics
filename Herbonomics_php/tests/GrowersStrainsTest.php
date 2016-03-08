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
        function test_GetInfo()
        {
            //Arrange
            $id = 1;
            $strain_name = "Northern Lights";
            $pheno = "Indica";
            $thc = 22.14;
            $cbd = 0.18;
            $cgc = 1;
            $price = 1400;
            $growers_id = 2;
            $test_growers_strains = new GrowersStrains($id, $strain_name, $pheno, $thc, $cbd, $cgc, $price, $growers_id);

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

        function test_Save()
        {
            //Arrange
            $id = 1;
            $strain_name = "Northern Lights";
            $pheno = "Indica";
            $thc = 22.96;
            $cbd = 0.18;
            $cgc = 1;
            $price = 1400;
            $growers_id = 2;
            $test_growers_strains = new GrowersStrains($id, $strain_name, $pheno, $thc, $cbd, $cgc, $price, $growers_id);
            $test_growers_strains->save();

            $id2 = 2;
            $strain_name2 = "Cannatonic";
            $pheno2 = "Sativa";
            $thc2 = 2.43;
            $cbd2 = 15.54;
            $cgc2 = 1;
            $price2 = 1000;
            $growers_id2 = 2;
            $test_growers_strains2 = new GrowersStrains($id2, $strain_name2, $pheno2, $thc2, $cbd2, $cgc2, $price2, $growers_id2);
            $test_growers_strains2->save();

            //Act

            $result = GrowersStrains::getAll();

            //Assert
            $this->assertEquals([$test_growers_strains, $test_growers_strains2], $result);
        }

        function test_findById()
        {//finding a specific strain by Id
            //Arrange
            $id = 1;
            $strain_name = "Northern Lights";
            $pheno = "Indica";
            $thc = 22.96;
            $cbd = 0.18;
            $cgc = 1;
            $price = 1400;
            $growers_id = 2;
            $test_growers_strains = new GrowersStrains($id, $strain_name, $pheno, $thc, $cbd, $cgc, $price, $growers_id);
            $test_growers_strains->save();


            $id2 = 2;
            $strain_name2 = "Cannatonic";
            $pheno2 = "Sativa";
            $thc2 = 2.43;
            $cbd2 = 15.54;
            $cgc2 = 1;
            $price2 = 1000;
            $growers_id = 2;
            $test_growers_strains2 = new GrowersStrains($id2, $strain_name2, $pheno2, $thc2, $cbd2, $cgc2, $price2, $growers_id);
            $test_growers_strains2->save();

            $id3 = 3;
            $strain_name3 = "Girl Scout Cookies";
            $pheno3 = "Hybrid";
            $thc3 = 22.43;
            $cbd3 = 1.54;
            $cgc3 = 0;
            $price3 = 1500;
            $growers_id2 = 6;
            $test_growers_strains3 = new GrowersStrains($id3, $strain_name3, $pheno3, $thc3, $cbd3, $cgc3, $price3, $growers_id2);
            $test_growers_strains3->save();

            //Act
            $result = GrowersStrains::findById($test_growers_strains2->getId());

            //Assert
            $this->assertEquals($test_growers_strains2, $result);
        }

        function test_update()
        {
            //Arrange
            $id = 1;
            $strain_name = "Northern Lights";
            $pheno = "Indica";
            $thc = 22.96;
            $cbd = 0.18;
            $cgc = 1;
            $price = 1400;
            $growers_id = 2;
            $test_growers_strains = new GrowersStrains($id, $strain_name, $pheno, $thc, $cbd, $cgc, $price, $growers_id);
            $test_growers_strains->save();

            //Act
            $new_strain_name = "Master Kush";
            $test_growers_strains->update($new_strain_name, $pheno, $thc, $cbd, $cgc, $price);
            $result = $test_growers_strains->getStrainName();

            //Assert
            $this->assertEquals('Master Kush', $result);
        }

        function test_delete_singe()
        {
            //Arrange
            $id = 1;
            $strain_name = "Northern Lights";
            $pheno = "Indica";
            $thc = 22.96;
            $cbd = 0.18;
            $cgc = 1;
            $price = 1400;
            $growers_id = 2;
            $test_growers_strains = new GrowersStrains($id, $strain_name, $pheno, $thc, $cbd, $cgc, $price, $growers_id);
            $test_growers_strains->save();

            $id3 = 3;
            $strain_name3 = "Girl Scout Cookies";
            $pheno3 = "Hybrid";
            $thc3 = 22.43;
            $cbd3 = 1.54;
            $cgc3 = 0;
            $price3 = 1500;
            $growers_id2 = 6;
            $test_growers_strains3 = new GrowersStrains($id3, $strain_name3, $pheno3, $thc3, $cbd3, $cgc3, $price3, $growers_id2);
            $test_growers_strains3->save();

            //Act
            $test_growers_strains->deleteOneStrain();
            $result = GrowersStrains::getAll();

            //Assert
            $this->assertEquals([$test_growers_strains3], $result);
        }
    }
?>
