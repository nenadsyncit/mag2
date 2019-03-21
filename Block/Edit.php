<?php


namespace Syncit\Products\Block;
class Edit extends \Magento\Framework\View\Element\Template
{
	
	protected $_filter; 
	protected $_storeManager;
	public $urlId;
	protected $_productFactory;
	protected $_urlInterface;
	protected $_request;
	protected $_helper;


	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Syncit\Products\Model\ProductFactory $productFactory,
		\Magento\Ui\Component\MassAction\Filter $filter,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\Framework\UrlInterface $urlInterface,
		\Magento\Framework\App\Request\Http $request,
		\Syncit\Products\Helper\Data $helper

	)
	{
		$this->_productFactory = $productFactory;
		$this->_filter = $filter;
		$this->_storeManager = $storeManager;
		$this->_urlInterface = $urlInterface;
		$this->_request= $request;
		$this->_helper = $helper;
		parent::__construct($context);
	}

	public function editProduct()
	{
		return __('Edit product');
	}
	
	public function getId(){
		$urlId = $this->_request->getParam('id');
		return $urlId;
	}
	
    public function getFormAction()
    {    
		return $this->getUrl('products/index/update', ['_secure' => true]);
		
	}
	

	public function setProductName(){
	$singleProduct = $this->_productFactory->create()->load($this->getId());
	$productName =$singleProduct->getProductName();	 	
	return $productName;	 
	}
	public function setProductPrice(){
		$singleProduct = $this->_productFactory->create()->load($this->getId());
		$productPrice =$singleProduct->getProductPrice();	 	
		return $productPrice;	 
		}
	public function setProductContent(){
		$singleProduct = $this->_productFactory->create()->load($this->getId());
		$productContent =$singleProduct->getProductContent();	 	
		return $productContent;	 
			}	


}


