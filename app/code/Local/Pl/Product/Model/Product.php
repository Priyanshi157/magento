<?php 
class Pl_Product_Model_Product extends Mage_Core_Model_Abstract
{
	public function _construct()
	{
		$this->_init('product/product');
	}
}
