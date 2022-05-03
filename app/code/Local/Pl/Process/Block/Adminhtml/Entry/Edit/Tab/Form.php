<?php 
class Pl_Process_Block_Adminhtml_Entry_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('process_form', array('legend'=>Mage::helper('process')->__('Process information')));

        $fieldset->addField('process_id', 'select', array(
           'label' => Mage::helper('process')->__('Process'),
           'class' => 'required-entry',
           'name' => 'process_id',
           'options' => Mage::getModel('process/process')->getProcessName(),
       ));
        
       $fieldset->addField('identifier', 'text', array(
           'label' => Mage::helper('process')->__('Identifier'),
           'class' => 'required-entry',
           'name' => 'identifier',
       ));
        
       $fieldset->addField('data', 'text', array(
           'label' => Mage::helper('process')->__('Data'),
           'class' => 'required-entry',
           'name' => 'data',
       ));
        
        if ( Mage::getSingleton('adminhtml/session')->getProData() )
        {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getProData());
          Mage::getSingleton('adminhtml/session')->setProData(null);
        } 
        elseif ( Mage::registry('entry_data') ) 
        {
          $form->setValues(Mage::registry('entry_data')->getData());
        }
        return parent::_prepareForm();
    }
   
}