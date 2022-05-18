<?php 
class Pl_Process_Model_Page extends Pl_Process_Model_Process_Abstract
{
	public function _construct()
	{
		$this->_init('process/page');
	}

	public function getIdentifier($row)
    {
        return $row['email'];
    }

    public function prepareRow(&$row)
    {
    	$entry = [
    		'process_id' =>	$this->getProcess()->getProcessId(),
    		'identifier' => $this->getIdentifier($row),
    		'data' 	=> null
    	];
    	$tableRow = [
    		'name' => $row['name'],
            'email' => $row['email'],
            'mobile' => $row['mobile'],
    	];
    	$entry['data'] = json_encode($tableRow);
    	$row = $entry;
    }
}
