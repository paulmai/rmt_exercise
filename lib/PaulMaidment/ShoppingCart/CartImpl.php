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
			$total = 0;
			$summary = "";
			foreach($this->products as $product){

				$line_price = $product['obj']->getTotalPrice($product['qty']);
				$qty_col = str_pad($product['qty'],10,' ');
				$name_col = str_pad($product['obj']->getName(),20,' ');
				$price_col = str_pad($line_price,10,' ');
				$total += $line_price;
				$separator = "\n";
				$line = $qty_col.$name_col.$price_col.$separator;
				$summary .= $line;
 
			}
			$summary .= str_pad("",40,"=");

			$summary .= "\n";
			$summary .= str_pad('',10,' ');
			$summary .= str_pad('Total',20,' ');
			$summary .= str_pad(number_format($total,2),10,' ');

			return $summary;
		}	
	
		public function addItem(Product $product, $amount)
		{
			//If this is an update to quantity, update the numbers
			if(isset($this->products[$product->getName()])){
				$quantity = $this->products[$product->getName()]['qty'];
				$amount += $quantity;
			}

			$this->products[$product->getName()]=array('obj'=>$product,'qty' => $amount);
		}
	
		public function getPriceOf(Product $product)
		{
			$quantity = $this->products[$product->getName()]['qty'];
			return $product->getTotalPrice($quantity);
		}
		
	}
