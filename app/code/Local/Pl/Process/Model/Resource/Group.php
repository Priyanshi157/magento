<?php 
class Pl_Process_Model_Resource_Group extends Mage_Core_Model_Resource_Db_Abstract
{
	public function _construct()
	{
		$this->_init('process/process_group','group_id');
	}
}