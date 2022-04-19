<?php 
class Ccc_Vendor_Adminhtml_vendorController extends Mage_Adminhtml_Controller_Action
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
 		$vendorId = $this->getRequest()->getParam('id');
		$vendorModel = Mage::getModel('vendor/vendor')->load($vendorId);
		if ($vendorModel->getId() || $vendorId == 0) 
		{
			Mage::register('vendor_data', $vendorModel);
			$this->loadLayout();
			$this->_setActiveMenu('vendor/vendor');
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock('vendor/adminhtml_vendor_edit'))
			->_addLeft($this->getLayout()->createBlock('vendor/adminhtml_vendor_edit_tabs'));
			$this->renderLayout();
		} 
		else 
		{
	 		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('vendor')->__('Item does not exist'));
	 		$this->_redirect('*/*/');
	 	}
 	}

 	public function saveAction()
 	{
 		try 
 		{
 			$postData = $this->getRequest()->getPost();
	 		$vendor = Mage::getModel('vendor/vendor');
	 		if($this->getRequest()->getParam('id'))
	 		{
	 			$postData = array_merge(['vendor_id'=>$this->getRequest()->getParam('id')],$postData);
	 		}
	 		$vendor->setData($postData);
	 		$vendor->save();
	 		$this->_redirect('*/*/');	
 		} 
 		catch (Exception $e) 
 		{	
 			$this->_redirect('*/*/');
 		}
 		
 	}

 	public function deleteAction()
    {
    	try 
    	{
			if( $this->getRequest()->getParam('id') > 0 ) 
    		{
			    $vendorModel = Mage::getModel('vendor/vendor');
			    $vendorModel->setId($this->getRequest()->getParam('id'))->delete();
			    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Data was successfully deleted'));
			    $this->_redirect('*/*/');
			}
    		$this->_redirect('*/*/');
    	} 
    	catch (Exception $e) 
    	{
			$this->_redirect('*/*/');    		
    	}
	    
    }
}

