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

        static function find($id)
		{
			$all_dispensary_demands = DispensaryDemand::getAll();
			$found_dispensary_demand = null;
			foreach($all_dispensary_demands as $dispensary_demand) {
				$dispensary_demand_id = $dispensary_demand->getId();
				if ($dispensary_demand_id == $id) {
					$found_dispensary_demand = $dispensary_demand;
				}
			}
			return $found_dispensary_demand;
		}

        static function findByDispensary($dispensary_id)
		{
			$all_dispensary_demands = DispensaryDemand::getAll();
			$found_dispensary_demand = array();
			foreach($all_dispensary_demands as $dispensary_demand) {
				$dispensary_demand_id = $dispensary_demand->getDispensaryId();
				if ($dispensary_demand_id == $dispensary_id) {
					array_push($found_dispensary_demand, $dispensary_demand);
				}
			}
			return $found_dispensary_demand;
		}

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM dispensaries_demands WHERE id = {$this->getId()};");
        }

        function update($new_strain_name, $new_pheno, $new_quantity)
		{
            $GLOBALS['DB']->exec("UPDATE dispensaries_demands SET strain_name = '{$new_strain_name}', pheno = '{$new_pheno}', quantity = '{$new_quantity}' WHERE id={$this->getId()};");
            $this->setStrainName($new_strain_name);
            $this->setPheno($new_pheno);
            $this->setQuantity($new_quantity);
		}

        static function search($search_term)
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM dispensaries_demands WHERE strain_name LIKE '%{$search_term}%'");
            $all_dispensaries_demands = $query->fetchAll(PDO::FETCH_ASSOC);
            $found_dispensaries_demands = array();
            foreach ($all_dispensaries_demands as $demand) {
                $strain_name = $demand['strain_name'];
                $dispensary_id = $demand['dispensary_id'];
                $pheno = $demand['pheno'];
                $quantity = $demand['quantity'];
                $id = $demand['id'];
                $new_demand = new DispensaryDemand($strain_name, $dispensary_id, $pheno, $quantity, $id);
                array_push($found_dispensaries_demands, $new_demand);
            }
            return $found_dispensaries_demands;
        }

    }
?>
