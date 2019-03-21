<?php


namespace Syncit\Products\Block;
class Add extends \Magento\Framework\View\Element\Template
{
	//protected $_postFactory;
	protected $_filter;
	protected $_storeManager;
	public $myUrl;
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		//\Syncit\Crud\Model\PostFactory $postFactory,
		\Magento\Ui\Component\MassAction\Filter $filter,
		\Magento\Store\Model\StoreManagerInterface $storeManager
	)
	{
		//$this->_postFactory = $postFactory;
		$this->_filter = $filter;
		$this->_storeManager = $storeManager;
		parent::__construct($context);
	}

	public function addProducts()
	{
		return __('Add new product');
	}
	public function getFormAction()
    {    
		return $this->getUrl('products/index/save', ['_secure' => true]);
		
    }
}