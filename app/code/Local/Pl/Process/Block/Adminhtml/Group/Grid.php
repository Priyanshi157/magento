<?php 
class Pl_Process_Block_Adminhtml_Group_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		$this->_blockGroup = 'group';
        $this->_controller = 'adminhtml_group';
        $this->_headerText = Mage::helper('process')->__('Manage Group');
        $this->_addButtonLabel = Mage::helper('process')->__('Add New Process Group');
        parent::__construct();
	}

	public function _prepareCollection()
	{
		$collection = Mage::getModel('process/group')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	 public function _prepareColumns()
    {
    	$this->addColumn('group_id', array(
          'header'    => Mage::helper('process')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'group_id',
        ));   

        $this->addColumn('name', array(
          'header'    => Mage::helper('process')->__('Name'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'name',
        ));   

        return parent::_prepareColumns();
   	}

   	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id'=>$row->getId()));	
	}

   	
}