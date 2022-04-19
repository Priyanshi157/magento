<?php 
class Pl_Product_Block_Catalog_Product_Grid extends Mage_Adminhtml_Block_Catalog_Product_Grid
{
    protected function _prepareColumns()
    {
        $parent = parent::_prepareColumns();
        $this->removeColumn('status');
        return $parent;
    }
}
