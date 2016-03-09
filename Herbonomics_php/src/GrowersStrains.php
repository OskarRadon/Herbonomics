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
        $this->thc = $new_thc;
    }

    function getThc()
    {
        return $this->thc;
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
        $GLOBALS['DB']->exec("INSERT INTO growers_strains (strain_name, pheno, thc, cbd, cgc, price, growers_id) VALUES ('{$this->getStrainName()}',
        '{$this->getPheno()}',
        {$this->getThc()},
        {$this->getCbd()},
        {$this->getCgc()},
        {$this->getPrice()},
        {$this->getGrowersId()});");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {//gets every single strain by every grower
        $returned_strains = $GLOBALS['DB']->query("SELECT * FROM growers_strains;");
        $strains = array();

        foreach($returned_strains as $strain) {
            $id = $strain['id'];
            $strain_name = $strain['strain_name'];
            $pheno = $strain['pheno'];
            $thc = (float) $strain['thc'];
            $cbd = (float) $strain['cbd'];
            $cgc = (int) $strain['cgc'];
            $price = (int) $strain['price'];
            $growers_id = (int) $strain['growers_id'];
            $new_strain = new GrowersStrains($id, $strain_name, $pheno, $thc, $cbd, $cgc, $price, $growers_id);
            array_push($strains, $new_strain);
        }
        return $strains;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM growers_strains;");
    }

    static function findById($search_id)
    {
        $found_strain = null;
        $strains = GrowersStrains::getAll();

        foreach($strains as $strain) {
          $strain_id = $strain->getId();
          if ($strain_id == $search_id) {
              $found_strain = $strain;
          }
        }
        return $found_strain;
    }

    static function findByGrower($grower_id)
    {
        $all_grower_strains = GrowersStrains::getAll();
        $found_grower_strain = array();
        foreach($all_grower_strains as $grower_strain) {
            $grower_strain_id = $grower_strain->getGrowersId();
            if ($grower_strain_id == $grower_id) {
                array_push($found_grower_strain, $grower_strain);
            }
        }
        return $found_grower_strain;
    }



    function update($strain_name, $pheno, $thc, $cbd, $cgc, $price)
    {
        $GLOBALS['DB']->exec("UPDATE growers_strains SET strain_name = '{$strain_name}', pheno = '{$pheno}', thc = {$thc}, cbd = {$cbd}, cgc = {$cgc}, price = {$price} WHERE id = {$this->getId()};");
        $this->setStrainName($strain_name);
        $this->setPheno($pheno);
        $this->setThc($thc);
        $this->setCbd($cbd);
        $this->setCgc($cgc);
        $this->setPrice($price);
    }

    function deleteOneStrain()
    {
        $GLOBALS['DB']->exec("DELETE FROM growers_strains WHERE id = {$this->getId()};");
        // $GLOBALS['DB']->exec("DELETE FROM dispensaries_growers WHERE grower_id = {$this->getId()};");
    }

    function findGrowerName($growers_id)
    {
        $query = $GLOBALS['DB']->query("SELECT name FROM growers JOIN growers_strains ON (growers.id = growers_strains.growers_id) WHERE growers.id = {$growers_id}");
        $growers = $query->fetchAll(PDO::FETCH_ASSOC);

        return $growers[0]['name'];
    }

    static function search($search_term)
    {
        $query = $GLOBALS['DB']->query("SELECT * FROM growers_strains WHERE strain_name LIKE '%{$search_term}%'");
        $all_growers_strains = $query->fetchAll(PDO::FETCH_ASSOC);
        $found_growers_strains = array();
        foreach ($all_growers_strains as $strain) {
            $id = $strain['id'];
            $strain_name = $strain['strain_name'];
            $pheno = $strain['pheno'];
            $thc = (float) $strain['thc'];
            $cbd = (float) $strain['cbd'];
            $cgc = (int) $strain['cgc'];
            $price = (int) $strain['price'];
            $growers_id = (int) $strain['growers_id'];
            $new_strain = new GrowersStrains($id, $strain_name, $pheno, $thc, $cbd, $cgc, $price, $growers_id);
            array_push($found_growers_strains, $new_strain);
        }
        return $found_growers_strains;
    }

}
?>
