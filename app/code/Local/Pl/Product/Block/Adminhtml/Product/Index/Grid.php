<?php

class Pl_Product_Block_Adminhtml_Product_Index_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('product_index');
        $this->setDefaultSort('type');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('product/product_collection');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('product_id', array(
            'header' => Mage::helper('product')->__('ID'),
            'width' => '50px',
            'align' => 'right',
            'index' => 'product_id',
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('product')->__('Name'),
            'index' => 'name',
        ));

        $this->addColumn('sku', array(
            'header' => Mage::helper('product')->__('Sku'),
            'index' => 'sku',
        ));

        $this->addColumn('price', array(
            'header' => Mage::helper('product')->__('Price'),
            'index' => 'price',
        ));

        $this->addColumn('cost_price', array(
            'header' => Mage::helper('product')->__('Cost Price'),
            'index' => 'cost_price',
        ));
        
        $this->addColumn('status', array(
        'header' => Mage::helper('product')->__('Status'),
        'align' => 'left',
        'width' => '80px',
        'index' => 'status',
        'type' => 'options',
        'options' => array(
        1 => 'Active',
        2 => 'Inactive',
        ),
        ));

        $this->addColumn('createdAt', array(
            'header' => Mage::helper('category')->__('Created Date'),
            'index' => 'createdAt',
        ));

        $this->addColumn('updatedAt', array(
            'header' => Mage::helper('category')->__('Updated Date'),
            'index' => 'updatedAt',
        ));


        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }

}