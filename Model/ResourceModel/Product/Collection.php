<?php
namespace Syncit\Products\Model\ResourceModel\Product;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'product_id';
	protected $_eventPrefix = 'custom_products_product_collection';
	protected $_eventObject = 'product_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Syncit\Products\Model\Product', 'Syncit\Products\Model\ResourceModel\Product');
	}

}