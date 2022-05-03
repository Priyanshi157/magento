<?php 
class Pl_Process_Model_Process extends Mage_Core_Model_Abstract
{
	public function _construct()
	{
		$this->_init('process/process');
	}

	const TYPE_ID_IMPORT = 1;
	const TYPE_ID_EXPORT = 2;
	const TYPE_ID_CRON = 3;
	const TYPE_ID_IMPORT_LBL = 'Import';
	const TYPE_ID_EXPORT_LBL = 'Export';
	const TYPE_ID_CRON_LBL = 'Cron';
	const TYPE_ID_DEFAULT = 1;

	public function getGroupName()
    {
        $adapter = $this->getResource()->getReadConnection();
        $query = 'SELECT `group_id`,`name` FROM `process_group`';
        $groupName = $adapter->fetchPairs($query);
        return $groupName;
    }

    public function getTypes($key = null)
	{
		$types = [
			self::TYPE_ID_IMPORT => self::TYPE_ID_IMPORT_LBL,
			self::TYPE_ID_EXPORT => self::TYPE_ID_EXPORT_LBL,
			self::TYPE_ID_CRON => self::TYPE_ID_CRON_LBL,
		];

		if(!$key)
		{
			return $types;
		}

		if (array_key_exists($key,$types)) 
		{	
			return $types[$key];
		}
		return self::TYPE_ID_DEFAULT;
	}

}