<?php 
class Pl_Process_Adminhtml_GroupController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->loadLayout()
		->_setActiveMenu('process')
		->_addContent($this->getLayout()->createBlock('process/adminhtml_group'))
		->renderLayout();
	}

	public function newAction()
	{
		$this->_forward('edit');
	}

	public function editAction()
	{
		$id = $this->getRequest()->getParam('id');
		$processModel = Mage::getModel('process/group')->load($id);
		if ($processModel->getId() || $id == 0) 
		{
			Mage::register('group_data',$processModel);
			$this->loadLayout();
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('process/adminhtml_group_edit'))
            ->_addLeft($this->getLayout()->createBlock('process/adminhtml_group_edit_tabs'));

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
            $group = Mage::getModel('process/group')->load($id);
            $group->addData($postData);
            $group->save();
			Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('process')->__('Process group saved successfully.'));
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
            $group = Mage::getModel('process/group')->load($id);
            if($group)
            {
                $delete = $group->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('process')->__('Process group deleted successfully.'));
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