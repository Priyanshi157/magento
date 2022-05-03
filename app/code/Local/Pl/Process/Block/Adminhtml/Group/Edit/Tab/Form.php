<?php 
class Pl_Process_Block_Adminhtml_Group_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('product_form', array('legend'=>Mage::helper('process')->__('Process information')));

        $fieldset->addField('name', 'text', array(
           'label' => Mage::helper('process')->__('Name'),
           'class' => 'required-entry',
           'name' => 'name',
       ));
        
        if ( Mage::getSingleton('adminhtml/session')->getProData() )
        {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getProData());
          Mage::getSingleton('adminhtml/session')->setProData(null);
        } 
        elseif ( Mage::registry('group_data') ) 
        {
          $form->setValues(Mage::registry('group_data')->getData());
        }
        return parent::_prepareForm();
    }
}