<?php 
class Pl_Process_Block_Adminhtml_Column extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'process';
        $this->_controller = 'adminhtml_column';
        $this->_headerText = Mage::helper('process')->__('Manage Process Column');
        $this->_addButtonLabel = Mage::helper('process')->__('Add New Process Column');
        parent::__construct();
	}
}