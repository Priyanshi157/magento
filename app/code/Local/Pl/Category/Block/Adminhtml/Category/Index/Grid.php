<?php

class Pl_Category_Block_Adminhtml_Category_Index_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('category_index');
        $this->setDefaultSort('type');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('category/category_collection');
        foreach ($collection->getItems() as $col) 
        {
            $col->name = $col->getPath();
        }

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('category_id', array(
            'header' => Mage::helper('category')->__('ID'),
            'width' => '50px',
            'align' => 'right',
            'index' => 'category_id',
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('category')->__('Name'),
            'index' => 'name',
        ));

        $this->addColumn('description', array(
            'header' => Mage::helper('category')->__('Description'),
            'index' => 'description',
        ));

        $this->addColumn('link', array(
            'header' => Mage::helper('category')->__('Link'),
            'index' => 'link',
        ));
        
        $this->addColumn('status', array(
        'header' => Mage::helper('category')->__('Status'),
        'align' => 'left',
        'width' => '80px',
        'index' => 'status',
        'type' => 'options',
        'options' => array(
        1 => 'Active',
        2 => 'Inactive',
        ),
        ));

        $this->addColumn('created_at', array(
            'header' => Mage::helper('category')->__('Created Date'),
            'index' => 'created_at',
        ));

        $this->addColumn('updated_at', array(
            'header' => Mage::helper('category')->__('Updated Date'),
            'index' => 'updated_at',
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }

}