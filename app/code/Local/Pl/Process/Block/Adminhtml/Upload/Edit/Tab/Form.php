<?php 
class Pl_Process_Block_Adminhtml_Upload_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
   protected function _prepareForm()
   {
     $form = new Varien_Data_Form();
     $this->setForm($form);
     $fieldset = $form->addFieldset('process_form', array('legend'=>Mage::helper('process')->__('Upload information')));

     $fieldset->addField('file_name', 'file', array(
        'label' => Mage::helper('process')->__('File'),
        'class' => 'required-entry',
        'name' => 'file_name',
      ));
      return parent::_prepareForm();
   }  
}
