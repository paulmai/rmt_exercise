<?php
	
	namespace PaulMaidment\ShoppingCart;
	
	class CartImpl implements CartInterface
	{

		protected $products;

		public function __construct()
		{
			$products = array();
		}

		public function getTotalSum()
		{
			$longest = 0;
			$summary = "\n";
			foreach($this->products as $product){

				$qty_col = pad_string($product['qty'],10,' ');
				$name_col = pad_string($product['obj']->getName(),20,' ');
				$price_col = pad_string($product['obj']->getTotalPrice($product['qty']),10,' ');
				$separator = "\n";
				$line = $qty_col.$name_col.$price_col.$separator;
				$summary .= $line;
 
			}
			$summary .= pad_string("",40,"=");

			$summary .= "\n";
			$summary .= "Total\t\t\t";

			return $summary;
		}	
	
		public function addItem(Product $product, $amount)
		{
			$this->products[$product->getName()]=array('obj'=>$product,'qty' => $amount);
		}
	
		public function getPriceOf(Product $product)
		{
			$quantity = $this->products[$product->getName()]['qty'];
			return $product->getTotalPrice($quantity);
		}
		
	}