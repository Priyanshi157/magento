<?php 
class Pl_Process_Block_Adminhtml_Entry extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'process';
        $this->_controller = 'adminhtml_entry';
        $this->_headerText = Mage::helper('process')->__('Manage Process Entry');
        $this->_addButtonLabel = Mage::helper('process')->__('Add New Process Entry');
        parent::__construct();
	}
}