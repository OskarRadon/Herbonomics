<?php
    Class DispensaryDemand
    {
        private $dispensary_id;
        private $strain_name;
        private $pheno;
        private $quantity;
        private $id;

        function __construct($strain_name, $dispensary_id,  $pheno, $quantity, $id=null)
        {
            $this->dispensary_id = $dispensary_id;
            $this->strain_name = $strain_name;
            $this->pheno = $pheno;
            $this->quantity = $quantity;
            $this->id = $id;
        }

        function getId ()
        {
            return $this->id;
        }

        function getDispensaryId()
        {
            return $this->dispensary_id;
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

        function setQuantity($new_quantity)
        {
            $this->quantity = $new_quantity;
        }

        function getQuantity()
        {
            return $this->quantity;
        }

        function save()
		{
			$existing_dispensaries_demands = $GLOBALS['DB']->query("SELECT * FROM dispensaries_demands");
			$GLOBALS['DB']->exec("INSERT INTO dispensaries_demands (dispensary_id, strain_name, pheno, quantity) VALUES ('{$this->getDispensaryId()}', '{$this->getStrainName()}', '{$this->getPheno()}', '{$this->getQuantity()}');");
			$this->id = $GLOBALS['DB']->lastInsertId();
		}

		static function getAll()
		{
			$returned_dispensaries_demands = $GLOBALS['DB']->query("SELECT * FROM dispensaries_demands");
			$dispensaries_demands = array();
			foreach($returned_dispensaries_demands as $demands){
				 $strain_name = $demands['strain_name'];
				 $dispensary_id = $demands['dispensary_id'];
				 $pheno = $demands['pheno'];
				 $quantity = $demands['quantity'];
				 $id = $demands['id'];
				 $new_demands = new DispensaryDemand($strain_name, $dispensary_id, $pheno, $quantity, $id);
				 array_push($dispensaries_demands, $new_demands);
			}
			return $dispensaries_demands;
		}

		static function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE FROM dispensaries_demands");
		}








    }
?>
