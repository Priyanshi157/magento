<?php 
class Pl_Process_Model_Column extends Mage_Core_Model_Abstract
{
	public function _construct()
	{
		$this->_init('process/column');
	}

	const REQUIRED_YES = 1;
	const REQUIRED_NO = 2;
	const REQUIRED_YES_LBL = 'Yes';
	const REQUIRED_NO_LBL = 'No';
	const REQUIRED_DEFAULT = 'No';

	const EXCEPTION_YES = 1;
	const EXCEPTION_NO = 2;
	const EXCEPTION_YES_LBL = 'Yes';
	const EXCEPTION_NO_LBL = 'No';
	const EXCEPTION_DEFAULT = 'No';

	const TYPE_CAST_VARCHAR = 1;
	const TYPE_CAST_INT = 2;
	const TYPE_CAST_DATETIME = 3;
	const TYPE_CAST_DECIMAL = 4;
	const TYPE_CAST_VARCHAR_LBL = 'Varchar';
	const TYPE_CAST_INT_LBL = 'Int';
	const TYPE_CAST_DATETIME_LBL = 'Datetime';
	const TYPE_CAST_DECIMAL_LBL = 'Decimal';
	const TYPE_CAST_DEFAULT = 1;

	public function getRequire($key = null)
	{
		$requires = [
			self::REQUIRED_YES => self::REQUIRED_YES_LBL,
			self::REQUIRED_NO => self::REQUIRED_NO_LBL,
		];

		if(!$key)
		{
			return $requires;
		}

		if (array_key_exists($key,$requires)) 
		{	
			return $requires[$key];
		}
		return self::REQUIRED_DEFAULT;
	}

	public function getExceptions($key = null)
	{
		$exceptions = [
			self::EXCEPTION_YES => self::EXCEPTION_YES_LBL,
			self::EXCEPTION_NO => self::EXCEPTION_NO_LBL,
		];

		if(!$key)
		{
			return $exceptions;
		}

		if (array_key_exists($key,$exceptions)) 
		{	
			return $exceptions[$key];
		}
		return self::EXCEPTION_DEFAULT;
	}

	public function getTypeCast($key = null)
	{
		$typeCastOptions = [
			self::TYPE_CAST_VARCHAR => self::TYPE_CAST_VARCHAR_LBL,
			self::TYPE_CAST_INT => self::TYPE_CAST_INT_LBL,
			self::TYPE_CAST_DECIMAL => self::TYPE_CAST_DECIMAL_LBL,
			self::TYPE_CAST_DATETIME => self::TYPE_CAST_DATETIME_LBL,
		];

		if(!$key)
		{
			return $typeCastOptions;
		}

		if (array_key_exists($key,$typeCastOptions)) 
		{	
			return $typeCastOptions[$key];
		}
		return self::TYPE_CAST_DEFAULT;
	}

	public function getProcessName()
    {
        $adapter = $this->getResource()->getReadConnection();
        $query = 'SELECT `process_id`,`name` FROM `process`';
        $processName = $adapter->fetchPairs($query);
        return $processName;
    }

}