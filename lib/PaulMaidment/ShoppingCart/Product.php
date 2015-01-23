<?php

namespace PaulMaidment\ShoppingCart;

/**
* Interface CartInterface
*
* @package ShoppingCart
*/

interface Product {

	/**
	* A name by which the product may be identified.
	* @param string $name The name by which the product should be identified.
	**/
	function setName($name);

	/**
	* @return The name by which the product will be identified.
	**/
	function getName();

	/**
	* Add a unit price for a product.
	**/
	function addUnitPrice($min_units,$unit_price);

	/**
	* get unit price for quantity 
	* @param int $quantity The quantity in units to get unit price for
	* @return float The unit price for the given quantity
	**/
	function getUnitPriceForQuantity($quantity);

	/**
	* get the total price based on the unit price
	* @param int $quantity The quantity to get the total price for
	* @return float The total price
	**/
	function getTotalPrice($quantity);

}
