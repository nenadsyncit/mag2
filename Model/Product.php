<?php
namespace Syncit\Products\Model;
class Product extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'custom_products';

	protected $_cacheTag = 'custom_products';

	protected $_eventPrefix = 'custom_products';

	protected function _construct()
	{
		$this->_init('Syncit\Products\Model\ResourceModel\Product');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}