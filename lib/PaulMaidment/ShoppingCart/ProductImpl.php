<?php
	
	namespace PaulMaidment\ShoppingCart;
	
	class ProductImpl implements Product
	{
		protected $prices;
		protected $name;
		
		public function __construct()
		{
			$this->name = 'Unnamed Product';
			$this->prices = array();
		}
			
		public function setName($name)
		{
			$this->name = $name;
		}
		public function getName()
		{
			return $this->name;
		}

		public function addUnitPrice($min_units,$unit_price)
		{
			$this->prices []= array(
				'min_units' => $min_units,
				'unit_price' => $unit_price
			);

		}

		public function getUnitPriceForQuantity($quantity)
		{
			$result = -1;
			foreach($this->prices as $price){
				if($quantity >= $price['min_units']){
					$result = $price['unit_price'];
				}
			}	
			if($result == -1){

				//TODO: Throw a ProductConfigException instead
				throw new \Exception('Was not able to obtain a price for '.$this->name.' at quantity '.$quantity);

			}
			return number_format($result,2);
		}

		public function getTotalPrice($quantity)
		{
			$result = 0;
			for($i=1;$i<=$quantity;$i++){
				$result += $this->getUnitPriceForQuantity($i);
			}
			return number_format($result,2);
		}
		
	}
