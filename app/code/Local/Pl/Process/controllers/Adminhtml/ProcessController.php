<?php 
class Pl_Process_Adminhtml_ProcessController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->loadLayout()
		->_setActiveMenu('process')
		->_addContent($this->getLayout()->createBlock('process/adminhtml_process'))
		->renderLayout();
	}

	public function newAction()
	{
		$this->_forward('edit');
	}

	public function editAction()
	{
		$id = $this->getRequest()->getParam('id');
		$processModel = Mage::getModel('process/process')->load($id);
		if ($processModel->getId() || $id == 0) 
		{
			Mage::register('process_data',$processModel);
			$this->loadLayout();
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('process/adminhtml_process_edit'))
            ->_addLeft($this->getLayout()->createBlock('process/adminhtml_process_edit_tabs'));

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
            $process = Mage::getModel('process/process')->load($id);
            if (!$process->getId()) 
            {
            	$process->setData('created_date',date('Y-m-d H:i:s'));
            }
            $process->addData($postData);
            $process->save();
			Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('process')->__('Process saved successfully.'));
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
            $process = Mage::getModel('process/process')->load($id);
            if($process)
            {
                $delete = $process->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('process')->__('Process deleted successfully.'));
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
                    $sample = Mage::getModel('process/process')->load($sampleId);
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

    public function massDeleteEntriesAction()
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
                $count = 0;
                foreach ($sampleIds as $sampleId)
                {
                    $entryModel = Mage::getModel('process/entry');
                    $select = $entryModel->getCollection()
                        ->getSelect()
                        ->reset(Zend_Db_Select::COLUMNS)
                        ->columns(['entry_id'])
                        ->where('process_id = ?', $sampleId);
                    $entryIds = $entryModel->getResource()->getReadConnection()->fetchAll($select);
                    foreach ($entryIds as $entryId) 
                    {
                        $entry = Mage::getModel('process/entry')->load($entryId['entry_id']);
                        $entry->delete();
                        $count++;
                    }

                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('adminhtml')->__('Total of '.$count.' record(s) were successfully deleted', count($count)));
            } 
            catch (Exception $e)
            {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('process/adminhtml_process/index');
    }
}
