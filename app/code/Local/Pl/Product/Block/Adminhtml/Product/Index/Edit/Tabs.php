<?php
class Pl_Product_Block_Adminhtml_Product_Index_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('product_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('product')->__('Product Info.'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
        'name' => Mage::helper('product')->__('Name'),
        'statusame' => Mage::helper('product')->__('Status'),
        'content' => $this->getLayout()->createBlock('product/adminhtml_product_index_edit_tab_form')->toHtml(),));
        return parent::_beforeToHtml();
    }
}
