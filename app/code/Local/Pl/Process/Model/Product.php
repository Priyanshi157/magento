<?php
class Pl_Process_Model_Product extends Pl_Process_Model_Process_Abstract
{
	protected $products = [];
	protected $categories = [];

	public function getIdentifier($row)
	{
		return $row['sku'];
	}

	public function prepareRowForJson($row)
	{
		return [
			'name' => $row['name'],
			'sku' => $row['sku'],
			'price' => $row['price'],
			'cost_price' => $row['cost_price'],
			'status' => $row['status'],
			'category_id' => $row['category_id'],
		];
	}

	public function validateCategory($row)
	{
		if(!$this->categories)
		{
			$this->categories = array_flip(Mage::getModel('process/category')->getPaths());
		}

		if(!array_key_exists($row['category_id'], $this->categories))
		{
			throw new Exception("No category found.", 1);
		}

		return $this->categories[$row['category_id']];
	}

    public function validateRow(&$row)
	{
		$row['category_id'] = $this->validateCategory($row);
		return $row;
	}

	public function import($entries)
    {
    	$product = Mage::getModel('product/product');
    	$adapter = $product->getResource()->getReadConnection();

        foreach ($entries as $key => $entry) 
        {
            $product->setData(json_decode($entry['data'], true));
            $product->created_at = date('Y-m-d H:i:s');
            $product->status = ($product->status == 'active') ? 1 : 2;
            $adapter->insertOnDuplicate('product',$product->getData());
        }
        return true;
    }	
}
