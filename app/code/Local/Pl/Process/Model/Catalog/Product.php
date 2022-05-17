<?php 
class Pl_Process_Model_Catalog_Product extends Pl_Process_Model_Process_Abstract
{
	public function getIdentifier($row)
	{
		return $row['name'];
	}
	
	public function prepareRowForJson(&$row)	
	{
		return[
			'name' => $row['name'],
			'group' => $row['group'],
			'attribute_set' => $row['attribute_set'],
			'type' => $row['type'],
			'input' => $row['input'],
			'lable' => $row['lable'],
			'source' => $row['source'],
			'required' => $row['required'],
			'visible'=> $row['visible'],
			'user_defined' => $row['user_defined']
		];
	}

	public function validateRow(&$row)
	{
		return $row;
	}

	public function import($entries)	
	{
		$installer = new Mage_Catalog_Model_Resource_Setup('core_setup');
		$installer->startSetup();

		foreach ($entries as $key => $entry) 
		{
			$data = json_decode($entry['data'], true);
			$installer->addAttribute('catalog_product', $data['name'], array(
				'group' => $data['group'],
				'attribute_set' => $data['attribute_set'],
				'type' => $data['type'],
				'label'=> $data['label'],
				'input' => $data['input'],
				'source' => $data['source'],
				'required' => $data['required'],
				'visible' => $row['visible'],
				'user_defined' => $row['user_defined']
			));
		}

		// $attributeId = $installer->getAttributeId(Mage_Catalog_Model_Product::ENTITY, $data['name']);
		// $attributeSetId = $installer->getAttributeSetId(Mage_Catalog_Model_Product::ENTITY, $data['attribute_set']);
		// $attributeGroupId = $installer->getAttributeGroup(Mage_Catalog_Model_Product::ENTITY, $attributeSetId, $data['group']);
		// $installer->addAttributeToSet(Mage_Catalog_Model_Product::ENTITY,
		// 	$attributeSetId,
		// 	$attributeGroupId,
		// 	$attributeId
		// );
		$installer->endSetup();
		return true;
	}
}
