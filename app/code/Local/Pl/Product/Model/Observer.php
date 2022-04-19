<?php 
class Pl_Product_Model_Observer extends Mage_Core_Model_Abstract
{
   public function saveProductObserve(Varien_Event_Observer $observer)
   {
      echo "<pre>";
      $event = $observer->getEvent(); 	
      $model = $event->getProduct();
	   print_r($model);
      //die();
   }
}
