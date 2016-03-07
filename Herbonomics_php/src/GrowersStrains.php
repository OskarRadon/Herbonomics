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

    function __construct($id=null, $strain_name, $pheno, $thc, $cbd, $cgc, $price, $growers_id)
    {
        $this->id = $id;
        $this->strain_name = $strain_name;
        $this->pheno = $pheno;
        $this->thc = $thc;
        $this->cbd = $cbd;
        $this->cgc = $cgc;
        $this->price = $price;
        $this->growers_id = $growers_id;
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

    function getPheno()
    {
        return $this->pheno;
    }

    function setThc($new_thc)
    {
        $this->thc = (float) $new_thc;
    }

    function getThc()
    {
        return (float) $this->thc;
    }

    function setCbd($new_cbd)
    {
        $this->cbd = $new_cbd;
    }

    function getCbd()
    {
        return $this->cbd;
    }

    function setCgc($new_cgc)
    {
        $this->cgc = $new_cgc;
    }

    function getCgc()
    {
        return $this->cgc;
    }

    function setPrice($new_price)
    {
        $this->price = $new_price;
    }

    function getPrice()
    {
        return $this->price;
    }

    function save()
    {//saves strain to specific grower's profile
        $GLOBALS['DB']->exec("INSERT INTO growers_strains (strain_name, pheno, thc, cbd, cgc, price, growers_id) VALUES ('{$this->getStrainName()}', '{$this->getPheno()}', {$this->getThc()}, {$this->getCbd()}, {$this->getCgc()}, {$this->getPrice()}, {$this->getGrowersId()});");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {//gets every single strain by every grower
        $returned_strains = $GLOBALS['DB']->query("SELECT * FROM growers_strains;");
        $strains = array();

        foreach($returned_strains as $strain) {
            $id = $strain['id'];
            $strain_name = $strain['name'];
            $pheno = $strain['pheno'];
            $thc = $strain['thc'];
            $cbd = $strain['cbd'];
            $cgc = $strain['cgc'];
            $price = $strain['price'];
            $growers_id = $strain['growers_id'];
            $new_strain = new GrowersStrains($id, $strain_name, $pheno, $thc, $cbd, $cgc, $price, $grower_id);
            array_push($strains, $new_strain);
        }
        return $strains;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM growers_strains;");
    }
}
?>
