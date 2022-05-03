<?php 
class Pl_Process_Block_Adminhtml_Upload_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'process';
        $this->_controller = 'adminhtml_upload';
        $this->_updateButton('delete','label', Mage::helper('process')->__('Delete Item'));
        $this->_updateButton('save', 'label', Mage::helper('process')->__('Save Data'));
    }
}
