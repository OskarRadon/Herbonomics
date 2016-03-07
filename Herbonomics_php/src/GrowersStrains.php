<?php

class GrowersStrains
{
    private $id;
    private $growers_id;
    private $strain_name;
    private $pheno;
    private $thc;
    private $cbd;
    private $cgc; //clean green certified = cgc
    private $price;

    function __construct($id=null, $growers_id, $strain_name, $pheno, $thc, $cbd, $cgc, $price)
    {
        $this->id = $id;
        $this->growers_id = $growers_id;
        $this->strain_name = $strain_name;
        $this->pheno = $pheno;
        $this->thc = $thc;
        $this->cbd = $cbd;
        $this->cgc = $cgc;
        $this->price = $price;
    }

    function getId()
    {
        return $this->id;
    }

    function getGrowersId()
    {
        return $this->growers_id;
    }

    function setStrainName($new_strain_name)
    {
        $this->strain_name = $new_strain_name;
    }

    function getStrainName()
    {
        return $this->strain_name;
    }

    function setPheno($new_pheno)
    {
        $this->pheno = $new_pheno;
    }

    function 
}
?>
