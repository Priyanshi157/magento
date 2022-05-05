<?php 

class Pl_Process_Block_Adminhtml_Upload extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'process';
        $this->_controller = 'adminhtml_process';
        $this->_headerText = Mage::helper('process')->__('Manage Upload');
        parent::__construct();

	}
}