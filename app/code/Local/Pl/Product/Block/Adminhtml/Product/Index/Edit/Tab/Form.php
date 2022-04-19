<?php

class Pl_Product_Block_Adminhtml_Product_Index_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('product_form', array('legend'=>Mage::helper('product')->__('Product information')));

        $fieldset->addField('name', 'text', array(
         'label' => Mage::helper('product')->__('Name'),
         'class' => 'required-entry',
         'name' => 'name',
         ));

        $fieldset->addField('sku', 'text', array(
         'label' => Mage::helper('product')->__('Sku'),
         'class' => 'required-entry',
         'name' => 'sku',
         ));

        $fieldset->addField('price', 'text', array(
         'label' => Mage::helper('product')->__('Price'),
         'class' => 'required-entry',
         'name' => 'price',
         ));

        $fieldset->addField('cost_price', 'text', array(
         'label' => Mage::helper('product')->__('Cost Price'),
         'class' => 'required-entry',
         'name' => 'cost_price',
         ));

        $fieldset->addField('status', 'select', array(
        'label' => Mage::helper('product')->__('Status'),
        'name' => 'status',
        'values' => array(
        array(
        'value' => 1,
        'label' => Mage::helper('product')->__('Active'),
        ),

        array(
        'value' => 2,
        'label' => Mage::helper('product')->__('Inactive'),
        ),
        ),
        ));


        if(Mage::getSingleton('adminhtml/session')->getProData())
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getProData());
            Mage::getSingleton('adminhtml/session')->setProData(null);
        } 
        elseif(Mage::registry('product_data')) 
        {
            $form->setValues(Mage::registry('product_data')->getData());
        }
        return parent::_prepareForm();
    }
}
