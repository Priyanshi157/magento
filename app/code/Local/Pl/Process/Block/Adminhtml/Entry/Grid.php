<?php 
class Pl_Process_Block_Adminhtml_Entry_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		$this->_blockGroup = 'process';
        $this->_controller = 'adminhtml_entry';
        $this->_headerText = Mage::helper('process')->__('Manage Process Entry');
        $this->_addButtonLabel = Mage::helper('process')->__('Add New Process Entry');
        parent::__construct();
	}

	public function _prepareCollection()
	{
		$collection = Mage::getModel('process/entry')->getCollection();
		foreach ($collection->getItems() as $key => $value) 
    {
      // $value->process_id = Mage::getModel('process/process')->load($value->process_id)->getName();
    }
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	 public function _prepareColumns()
    {
    	$this->addColumn('entry_id', array(
          'header'    => Mage::helper('process')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'entry_id',
        ));   

        $this->addColumn('data', array(
          'header'    => Mage::helper('process')->__('Data'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'data',
        ));   

        $this->addColumn('process_id', array(
          'header'    => Mage::helper('process')->__('Process'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'process_id',
        ));   

        $this->addColumn('identifier', array(
          'header'    => Mage::helper('process')->__('Identifier'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'identifier',
        ));   

        $this->addColumn('start_time', array(
          'header'    => Mage::helper('process')->__('Start Time'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'start_time',
        ));   

        $this->addColumn('end_time', array(
          'header'    => Mage::helper('process')->__('End Time'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'end_time',
        ));   

        $this->addColumn('created_date', array(
          'header'    => Mage::helper('process')->__('Created Date'),
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