<?php 
class Pl_Process_Block_Adminhtml_Process_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
	public function __construct()
    {
        parent::__construct();
        $this->setId('process_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('process')->__('Process Info.'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
        'label'     => Mage::helper('process')->__('Process Information'),
        'title'     => Mage::helper('process')->__('Process Information'),
        'content' => $this->getLayout()->createBlock('process/adminhtml_process_edit_tab_form')->toHtml(),));

        return parent::_beforeToHtml();
    }
}