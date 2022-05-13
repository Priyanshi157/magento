<?php 
class Pl_Process_Adminhtml_EntryController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->loadLayout()
		->_setActiveMenu('process')
		->_addContent($this->getLayout()->createBlock('process/adminhtml_entry'))
		->renderLayout();
	}

	public function newAction()
	{
		$this->_forward('edit');
	}

	public function editAction()
	{
		$id = $this->getRequest()->getParam('id');
		$processEntryModel = Mage::getModel('process/entry')->load($id);
		if ($processEntryModel->getId() || $id == 0) 
		{
			Mage::register('entry_data',$processEntryModel);
			$this->loadLayout();
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('process/adminhtml_entry_edit'))
            ->_addLeft($this->getLayout()->createBlock('process/adminhtml_entry_edit_tabs'));

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
            $processColumn = Mage::getModel('process/entry')->load($id);
            if (!$processColumn->getId()) 
            {
            	$processColumn->setData('created_date',date('Y-m-d H:i:s'));
            }
            $processColumn->addData($postData);
            $processColumn->save();
			Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('process')->__('Process entry saved successfully.'));
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
            $processEntry = Mage::getModel('process/entry')->load($id);
            if($processEntry)
            {
                $delete = $processEntry->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('process')->__('Process entry deleted successfully.'));
                $this->_redirect('*/*/');
            }
        } 
        catch (Exception $e) 
        {
			Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirect('*/*/');   
        }
	}

	public function massDeleteAction() 
    {
        $sampleIds = $this->getRequest()->getParam('process');
        if(!is_array($sampleIds))
        {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } 
        else 
        {
            try
            {
                foreach ($sampleIds as $sampleId)
                {
                    $sample = Mage::getModel('process/entry')->load($sampleId);
                    $result = $sample->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('adminhtml')->__('Total of %d record(s) were successfully deleted', count($sampleIds)));
            } 
            catch (Exception $e)
            {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
}