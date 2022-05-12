<?php 
class Pl_Process_Block_Adminhtml_Column_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		$this->_blockGroup = 'process';
		$this->_controller = 'adminhtml_column';
		$this->_headerText = Mage::helper('process')->__('Manage Columns');
		$this->_addButtonLabel = Mage::helper('process')->__('Add New Process Columns');
		parent::__construct();
	}

	public function _prepareCollection()
	{
		$collection = Mage::getModel('process/column')->getCollection();
		foreach ($collection->getItems() as $key => $value) 
    {
      $value->required = Mage::getModel('process/column')->getRequire($value->required);
      $value->exception = Mage::getModel('process/column')->getExceptions($value->exception);
      $value->type_cast = Mage::getModel('process/column')->getTypeCast($value->type_cast);
      $value->process_id = Mage::getModel('process/column')->getProcessName()[$value->process_id];
    }
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	public function _prepareColumns()
	{
		$this->addColumn('column_id', array(
			'header'    => Mage::helper('process')->__('ID'),
			'align'     =>'right',
			'width'     => '50px',
			'index'     => 'column_id',
		));   

		$this->addColumn('name', array(
			'header'    => Mage::helper('process')->__('Name'),
			'align'     =>'right',
			'width'     => '50px',
			'index'     => 'name',
		));   

		$this->addColumn('process_id', array(
			'header'    => Mage::helper('process')->__('Process'),
			'align'     =>'right',
			'width'     => '50px',
			'index'     => 'process_id',
		));   

		$this->addColumn('sample_data', array(
			'header'    => Mage::helper('process')->__('Sample Data'),
			'align'     =>'right',
			'width'     => '50px',
			'index'     => 'sample_data',
		));   

		$this->addColumn('required', array(
			'header'    => Mage::helper('process')->__('Is Required?'),
			'align'     =>'right',
			'width'     => '50px',
			'index'     => 'required',
		));   

		$this->addColumn('type_cast', array(
			'header'    => Mage::helper('process')->__('Casting Type'),
			'align'     =>'right',
			'width'     => '50px',
			'index'     => 'type_cast',
		));   

		$this->addColumn('exception', array(
			'header'    => Mage::helper('process')->__('Exception'),
			'align'     =>'right',
			'width'     => '50px',
			'index'     => 'exception',
		));   

		$this->addColumn('created_date', array(
			'header'    => Mage::helper('process')->__('created_date'),
			'align'     =>'right',
			'width'     => '50px',
			'index'     => 'created_date',
		));   

		return parent::_prepareColumns();
	}

	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id'=>$row->getId()));	
	}

}