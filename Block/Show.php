<?php


namespace Syncit\Products\Block;

use Magento\Framework\App\Filesystem\DirectoryList;


class Show extends \Magento\Framework\View\Element\Template
{
	protected $_productFactory;
	protected $_filter;
	protected $_storeManager;
	public $myUrl;
	protected $_filesystem;
	
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Syncit\Products\Model\ProductFactory $productFactory,
		\Magento\Ui\Component\MassAction\Filter $filter,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\Framework\Filesystem $filesystem 
	)
	{
		$this->_productFactory = $productFactory;
		$this->_filter = $filter;
		$this->_storeManager = $storeManager;
		$this->_filesystem = $filesystem;
		parent::__construct($context);
	}

	public function listProducts()
	{
		return __('List of products');
	}
	public function getProductCollection(){
		
		$product = $this->_productFactory->create();
		return $product->getCollection();
	}
    public function getImagePath(){
		
		$imagePath = $this->_storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $imagePath.'images/'; 
		
	}  

	// Delete action
	public function getFormAction()
    {    
		return $this->getUrl('products/index/delete', ['_secure' => true]);
		
    }
}