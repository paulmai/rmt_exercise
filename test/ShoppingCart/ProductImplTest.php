<?php
	//Include the composer autoloader
	require_once(dirname(__FILE__).'/../../vendor/autoload.php');

	use PaulMaidment\ShoppingCart\ProductImpl;

	class ProductImplTest extends PHPUnit_Framework_TestCase
	{
		public function test_ProductImpl_class_exists()
		{
			$productImpl = new ProductImpl();
			$this->assertTrue(true);
		}

		public function test_when_name_is_set_that_same_name_can_be_retrieved()
		{
			$productImpl = new ProductImpl();
			$productImpl->setName('Foo');
			$this->assertEquals('Foo',$productImpl->getName());
		}

		public function test_when_no_price_data_available_exception_is_thrown_when_price_requested()
		{
			$productImpl = new ProductImpl();
			$productImpl->addUnitPrice(21,0.18);
			try {	
				$productImpl->getUnitPriceForQuantity(10);
			} catch (\Exception $ex) {
				$this->assertTrue(true);
				return;
			}
			//If an exception is not thrown, we will end up here.
			//Make sure we cause a test failure
			$this->assertTrue(false);
		}

		public function test_that_when_price_data_available_correct_figures_are_returned_on_price_request()
		{
			$productImpl = new ProductImpl();
			$productImpl->addUnitPrice(0,0.20);
			$productImpl->addUnitPrice(21,0.18);
                        $productImpl->addUnitPrice(100,0.14);
			$this->assertEquals($productImpl->getUnitPriceForQuantity(1),0.20);
			$this->assertEquals($productImpl->getUnitPriceForQuantity(25),0.18);
			$this->assertEquals($productImpl->getUnitPriceForQuantity(100),0.14);
				
		}

		public function test_that_correct_total_price_is_returned()
		{
			$productImpl = new ProductImpl();
                        $productImpl->addUnitPrice(0,0.20);
                        $productImpl->addUnitPrice(21,0.18);
                        $productImpl->addUnitPrice(100,0.14);
			$this->assertEquals(4.90,$productImpl->getTotalPrice(25));
		}
		
	}
