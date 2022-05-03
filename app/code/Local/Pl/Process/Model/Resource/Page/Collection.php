<?php 
class Pl_Process_Model_Resource_Page_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	public function _construct()
	{
		$this->_init('process/page');
	}
}