<?php 
class Pl_Process_Model_Entry extends Mage_Core_Model_Abstract
{
	public function _construct()
	{
		$this->_init('process/entry');
	}

	public function getProcessName()
    {
        $adapter = $this->getResource()->getReadConnection();
        $query = 'SELECT `process_id`,`name` FROM `process`';
        $processName = $adapter->fetchPairs($query);
        return $processName;
    }

}