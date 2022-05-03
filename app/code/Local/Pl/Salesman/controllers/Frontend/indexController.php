<?php 
class Pl_Salesman_Frontend_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		echo "11";
		exit;
		$this->loadLayout();
		$this->renderLayout();
	}
}