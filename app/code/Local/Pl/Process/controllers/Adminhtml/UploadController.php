<?php
class Pl_Process_Adminhtml_UploadController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout()
        ->_setActiveMenu('process')
        ->_addContent($this->getLayout()->createBlock('process/adminhtml_upload'))
        ->renderLayout();
        $this->_setActiveMenu('process/group');
        $this->renderLayout();
    }

    public function uploadfileAction()
    {
        $processId = $this->getRequest()->getParam('id');

		$process = Mage::getModel('process/process')->load($processId);

		Mage::register('current_process_media', $process);

		if (!$process->getId()) 
        {
			$this->getSession()->addError(Mage::helper('process')->_('This process no longer exists'));
			$this->_redirect('*/*/');
			return;
		}
		$this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('process/adminhtml_upload_edit'))
            ->_addLeft($this->getLayout()->createBlock('process/adminhtml_upload_edit_tabs'));
		$this->renderLayout();
    }

    public function uploadAction()
    {
        $processId = $this->getRequest()->getParam('id');
        $process = Mage::getModel('process/process');
        if($process->load($processId))
        {
            $model = Mage::getModel($process->getRequestModel());
            $fileName = $model->setProcess($process)->uploadFile();
        }
        $this->_redirect('process/adminhtml_process/index');
    }

    public function csvDownloadAction()
    {
        try 
        {    
            $process = Mage::getModel('process/process')->load($this->getRequest()->getParam('id'));

            $model= Mage::getModel('process/process_abstract')->setProcess($process)->getDefaultFile();
            $fileName   = 'sample.csv';
            $content = ['type'=>'filename','value'=>Mage::getBaseDir('media') . DS . 'process'. DS . 'import' . DS . 'sample.csv','rm'=>1];
            $this->_prepareDownloadResponse($fileName, $content);
            $this->_redirect('process/adminhtml_process/index');
        } 
        catch (Exception $e) 
        {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirect('process/adminhtml_process/index');
        }
    }

    public function verifyAction()
    {
        try 
        {
            $processId = $this->getRequest()->getParam('id');
            $process = Mage::getModel('process/process');
            if($process->load($processId))
            {
                $model = Mage::getModel($process->getRequestModel());
                $fileName = $model->setProcess($process)->verify();
            }

            Mage::getSingleton('adminhtml/session')->addSuccess("Verified Successfully.");
            $this->_redirect('process/adminhtml_process/index');
        } 
        catch (Exception $e) 
        {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirect('process/adminhtml_process/index');
        }
    }

    public function executeAction()
    {
        try
        {
            $processId = $this->getRequest()->getParam('id');
            $process = Mage::getModel('process/process')->load($processId);
            $this->_prepareProcessEntryVariable($process);
            $this->loadLayout();
            $this->renderLayout();
        }
        catch(Exception $e)
        {
            $sessionProcessEntry = Mage::getSingleton('core/session')->getProcessEntryVariable();
            if(empty($sessionProcessEntry))
            {
                Mage::getSingleton('adminhtml/session')->addError('adminhtml/session')->addError($e->getMessage());
            }
            else
            {
                Mage::getSingleton('adminhtml/session')->addSuccess("Data executed successfully.");
                Mage::getSingleton('core/session')->clear();
            }
            $this->_redirect('process/adminhtml_process/index');
        }
    }

    public function _prepareProcessEntryVariable($process)
    {
        $sessionProcessEntry = [
            'processId' => $process,
            'totalCount' => 0,
            'perRequestCount' => 0,
            'totalRequest' => 0,
            'currentRequest' => 0
        ];
        $entry = Mage::getModel('process/entry');
        $select = $entry->getCollection()
                    ->getSelect()
                    ->reset(Zend_Db_Select::COLUMNS)
                    ->columns(['count(entry_id)'])
                    ->where('start_time IS NULL');
        $entryData = $entry->getResource()->getReadConnection()->fetchOne($select);
        if(!$entryData)
        {
            throw new Exception("No record available.", 1);
        }
        $sessionProcessEntry['totalCount'] = $entryData;
        $sessionProcessEntry['perRequestCount'] = $process->getData()['per_request_count'];
        $sessionProcessEntry['totalRequest'] = ceil($sessionProcessEntry['totalCount'] / $sessionProcessEntry['perRequestCount']);
        $sessionProcessEntry['currentRequest'] = 1;
        Mage::getSingleton('core/session')->setProcessEntryVariable($sessionProcessEntry);
    }

    public function processEntryAction()
    {
        try 
        {
            $response = [
                'status' => "success",
                'reload' => false,
                'message' => null,
                'current' => null,
            ];
            $reload = false;
            $sessionProcessEntry = Mage::getSingleton('core/session')->getProcessEntryVariable();
            $process = $sessionProcessEntry['processId'];
            if(!$process)
            {
                throw new Exception("No process found.", 1);
            }

            $requestModel = Mage::getModel($process->getData('request_model'));
            if(!$requestModel){
                throw new Exception("Request model not found", 1);
            }

            $requestModel->setProcess($process)->execute();
            sleep(2);
            $response['message'] = 'Complete '.$sessionProcessEntry['currentRequest'] . " out of ".$sessionProcessEntry['totalRequest'];
            $response['current'] = $sessionProcessEntry['currentRequest'] + 1;
            if($sessionProcessEntry['currentRequest'] == $sessionProcessEntry['totalRequest'])
            {
                $response['reload'] = true;
            }

            $sessionProcessEntry['currentRequest'] += 1;
            $this->getResponse()->setBody(mage::helper('core')->jsonEncode($response));
            Mage::getSingleton('core/session')->setProcessEntryVariable($sessionProcessEntry);
        }
        catch (Exception $e) 
        {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirect('process/adminhtml_process/index');
        }
    }
}
