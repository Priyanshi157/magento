<?php 
class Pl_Process_Adminhtml_ColumnController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->loadLayout()
		->_setActiveMenu('process')
		->_addContent($this->getLayout()->createBlock('process/adminhtml_column'))
		->renderLayout();
	}

	public function newAction()
	{
		$this->_forward('edit');
	}

	public function editAction()
	{
		$id = $this->getRequest()->getParam('id');
		$processColumnModel = Mage::getModel('process/column')->load($id);
		if ($processColumnModel->getId() || $id == 0) 
		{
			Mage::register('column_data',$processColumnModel);
			$this->loadLayout();
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('process/adminhtml_column_edit'))
            ->_addLeft($this->getLayout()->createBlock('process/adminhtml_column_edit_tabs'));

            $this->renderLayout();
		}
		else
		{
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('process')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}

	public function saveAction()
	{
		try 
		{
			if(!$this->getRequest()->getPost())
			{
				throw new Exception("Invalid request.", 1);
			}
			$postData = $this->getRequest()->getPost();
            $id = (int)$this->getRequest()->getParam('id');
            $processColumn = Mage::getModel('process/column')->load($id);
            if (!$processColumn->getId()) 
            {
            	$processColumn->setData('created_date',date('Y-m-d H:i:s'));
            }
            $processColumn->addData($postData);
            $processColumn->save();
			Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('process')->__('Process column saved successfully.'));
            $this->_redirect('*/*/');

		} 
		catch (Exception $e) 
		{
			Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
		}
	}

	public function deleteAction()
	{
		try 
        {
            $id = (int)$this->getRequest()->getParam('id');
            if (!$id) 
            {
                throw new Exception("Invalid id.", 1);
            }
            $processColumn = Mage::getModel('process/column')->load($id);
            if($processColumn)
            {
                $delete = $processColumn->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('process')->__('Process column deleted successfully.'));
                $this->_redirect('*/*/');
            }
        } 
        catch (Exception $e) 
        {
			Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirect('*/*/');   
        }
	}
}