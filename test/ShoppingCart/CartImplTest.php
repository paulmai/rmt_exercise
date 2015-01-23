<?php
	//Include the composer autoloader
	require_once(dirname(__FILE__).'/../../vendor/autoload.php');

	use PaulMaidment\ShoppingCart\CartImpl;
	use PaulMaidment\ShoppingCart\ProductImpl;

	class CartImplTest extends PHPUnit_Framework_TestCase
	{
		public function test_CartImpl_exists()
		{
			$cartImpl = new CartImpl();
		}

		public function test_that_price_of_product_is_correct_for_amount_already_in_cart()
		{
			$cartImpl = new CartImpl();
			$productImpl = new ProductImpl();
                        $productImpl->setName('Tomato');
			$productImpl->addUnitPrice(0,0.20);
                        $productImpl->addUnitPrice(21,0.18);
                        $productImpl->addUnitPrice(100,0.14);
			$cartImpl->addItem($productImpl,25);
			$this->assertEquals(4.90,$cartImpl->getPriceOf($productImpl));
		}

		public function test_that_update_to_unit_quantity_is_correctly_performed()
		{
			$cartImpl = new CartImpl();
			$productImpl = new ProductImpl();
                        $productImpl->setName('Tomato');
                        $productImpl->addUnitPrice(0,0.20);
                        $productImpl->addUnitPrice(21,0.18);
                        $productImpl->addUnitPrice(100,0.14);
                        $cartImpl->addItem($productImpl,20);
			$this->assertEquals(4.00,$cartImpl->getPriceOf($productImpl));
			//Add five more units of the same product
                        $cartImpl->addItem($productImpl,5);
			$this->assertEquals(4.90,$cartImpl->getPriceOf($productImpl));

		}

		public function test_that_get_total_sum_returns_correct_content()
		{
			$cartImpl = new CartImpl();

                        $productImpl = new ProductImpl();
                        $productImpl->setName('Tomato');
                        $productImpl->addUnitPrice(0,0.20);
                        $productImpl->addUnitPrice(21,0.18);
                        $productImpl->addUnitPrice(100,0.14);
                        $cartImpl->addItem($productImpl,25);

			$productImpl = new ProductImpl();
                        $productImpl->setName('Cucumber');
                        $productImpl->addUnitPrice(0,0.10);
                        $productImpl->addUnitPrice(21,0.08);
                        $productImpl->addUnitPrice(100,0.04);
                        $cartImpl->addItem($productImpl,10);
		
			$invoice = $cartImpl->getTotalSum();
			
			//For the sake of visual confirmation, we will dump out the invoice on the command line
			print_r("\n".$invoice);

			//The real test, assertion of the content
			$this->assertEquals("25        Tomato              4.90      \n10        Cucumber            1.00      \n========================================\n          Total               5.90      ",$invoice);
			echo("\n");

	
		}

	}
