<?php 
class Pl_Product_Adminhtml_productController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->loadLayout();
		$this->renderLayout();
	}

	public function newAction()
	{
		$this->_forward('edit');
	}

	public function editAction()
 	{
 		$productId = $this->getRequest()->getParam('id');
		$productModel = Mage::getModel('product/product')->load($productId);
		if ($productModel->getId() || $productId == 0) 
		{
			Mage::register('product_data', $productModel);
			$this->loadLayout();
			$this->_setActiveMenu('product/product');
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock('product/adminhtml_product_index_edit'))->_addLeft($this->getLayout()->createBlock('product/adminhtml_product_index_edit_tabs'));
			$this->renderLayout();
		}
		else 
		{
	 		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('product')->__('Item does not exist'));
	 		$this->_redirect('*/*/');
	 	}
 	}

 	public function saveAction()
 	{
 		$date = date('Y-m-d H:i:s');
 		$postData = $this->getRequest()->getPost();
 		$product = Mage::getModel('product/product');
 		if($this->getRequest()->getParam('id'))
 		{
 			$postData = array_merge(['product_id'=>$this->getRequest()->getParam('id')],$postData);
 			$postData = array_merge(['updatedAt'=>$date],$postData);
 		}
 		else
 		{
 			$postData = array_merge(['createdAt'=>$date],$postData);
 		}
 		
 		$product->setData($postData);
 		Mage::dispatchEvent('product_before_save', array('product' => $product, 'request' => $this->getRequest()));
 		$product->save();
 		$this->_redirect('*/*/');
 	}
 	
 	public function deleteAction()
 	{
 		$id = (int)$this->getRequest()->getParam('id');
 		if($id)
 		{
 			$product = Mage::getModel('product/product');
 			$load = $product->load($id);
 			if($load)
 			{
 				$delete = $product->delete();
 				$this->_redirect('*/*/');
 			}
 		}
 	}
}
