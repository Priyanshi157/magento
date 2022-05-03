<?php 
class Pl_Process_Block_Adminhtml_Column_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('process_form', array('legend'=>Mage::helper('process')->__('Process information')));

        $fieldset->addField('name', 'text', array(
           'label' => Mage::helper('process')->__('Name'),
           'class' => 'required-entry',
           'name' => 'name',
       ));
         
        $fieldset->addField('process_id', 'select', array(
           'label' => Mage::helper('process')->__('Process'),
           'class' => 'required-entry',
           'name' => 'process_id',
           'options' => Mage::getModel('process/column')->getProcessName(),
       ));
        
       $fieldset->addField('type_cast', 'select', array(
           'label' => Mage::helper('process')->__('Casting Type'),
           'class' => 'required-entry',
           'name' => 'type_cast',
           'options' => Mage::getModel('process/column')->getTypeCast(),
       ));
        
       $fieldset->addField('required', 'select', array(
           'label' => Mage::helper('process')->__('Is Required?'),
           'class' => 'required-entry',
           'name' => 'required',
           'options' => Mage::getModel('process/column')->getRequire(),
       ));
        
       $fieldset->addField('exception', 'select', array(
           'label' => Mage::helper('process')->__('Can Throw Exception?'),
           'class' => 'required-entry',
           'name' => 'exception',
           'options' => Mage::getModel('process/column')->getExceptions(),
       ));
        
        if ( Mage::getSingleton('adminhtml/session')->getProData() )
        {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getProData());
          Mage::getSingleton('adminhtml/session')->setProData(null);
        } 
        elseif ( Mage::registry('column_data') ) 
        {
          $form->setValues(Mage::registry('column_data')->getData());
        }
        return parent::_prepareForm();
    }
   
}