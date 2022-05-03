<?php 
class Pl_Process_Block_Adminhtml_Process_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
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
        
        $fieldset->addField('per_request_count', 'text', array(
           'label' => Mage::helper('process')->__('per_request_count'),
           'class' => 'required-entry',
           'name' => 'per_request_count',
       ));
        
        $fieldset->addField('group_id', 'select', array(
           'label' => Mage::helper('process')->__('Group'),
           'class' => 'required-entry',
           'name' => 'group_id',
           'options' => Mage::getModel('process/process')->getGroupName(),
       ));
        
        $fieldset->addField('request_interval', 'text', array(
           'label' => Mage::helper('process')->__('request_interval'),
           'class' => 'required-entry',
           'name' => 'request_interval',
       ));
        
        $fieldset->addField('request_model', 'text', array(
           'label' => Mage::helper('process')->__('request_model'),
           'class' => 'required-entry',
           'name' => 'request_model',
       ));
        
        $fieldset->addField('type_id', 'select', array(
           'label' => Mage::helper('process')->__('Type'),
           'class' => 'required-entry',
           'name' => 'type_id',
           'options' => Mage::getModel('process/process')->getTypes(),
       ));
        
        $fieldset->addField('file_name', 'text', array(
           'label' => Mage::helper('process')->__('File Name'),
           'class' => 'required-entry',
           'name' => 'file_name',
       ));
        
        if ( Mage::getSingleton('adminhtml/session')->getProData() )
        {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getProData());
          Mage::getSingleton('adminhtml/session')->setProData(null);
        } 
        elseif ( Mage::registry('process_data') ) 
        {
          $form->setValues(Mage::registry('process_data')->getData());
        }
        return parent::_prepareForm();
    }
   
}