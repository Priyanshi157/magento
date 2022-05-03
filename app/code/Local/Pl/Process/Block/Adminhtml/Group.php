<?php 
class Pl_Process_Block_Adminhtml_Group extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'process';
        $this->_controller = 'adminhtml_group';
        $this->_headerText = Mage::helper('process')->__('Manage Group');
        $this->_addButtonLabel = Mage::helper('process')->__('Add New Group');
        parent::__construct();
	}
}