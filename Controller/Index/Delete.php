<?php


namespace Syncit\Products\Controller\Index;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Serialize\SerializerInterface;


class Delete extends \Magento\Framework\App\Action\Action
{

protected $storeManager;
protected $formKeyValidator;
protected $_productFactory;
protected $_filter;
protected $_storeManager;
protected $_fileUploaderFactory;
protected $_filesystem;
protected $_errors= null;
private $serializer;
protected $_file;

public function __construct(       
    \Magento\Framework\App\Action\Context $context,
	\Syncit\Products\Model\ProductFactory $productFactory,
	\Magento\Ui\Component\MassAction\Filter $filter,
    \Magento\Customer\Model\Session $customerSession,
    \Magento\Store\Model\StoreManagerInterface $storeManager,
    \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
    \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
    \Magento\Framework\Filesystem $filesystem,
     SerializerInterface $serializer,
     \Magento\Framework\Filesystem\Driver\File $file


)
{

$this->storeManager = $storeManager;
$this->formKeyValidator = $formKeyValidator;
$this->messageManager = $context->getMessageManager();
$this->_productFactory = $productFactory;
$this->_filter = $filter;
$this->_storeManager = $storeManager;
$this->_fileUploaderFactory = $fileUploaderFactory;
$this->_filesystem = $filesystem;
$this->serializer = $serializer;
$this->_file = $file;

parent::__construct($context);
}
public function execute()
{
$resultRedirect = $this->resultRedirectFactory->create();
//Get image path from media/images folder
$path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('images/');
$productId = $this->getRequest()->getParam('id');
// Load image name from DB
$singleProduct = $this->_productFactory->create()->load($productId);
$imageName = $singleProduct->getProductImage();
// Check if file exists 
if ( file_exists($path.$imageName )) {
    if ($imageName !='no_image.png'){
        $this->_file->deleteFile($path . $imageName);
    }
    
}

$delete_record = $this->_productFactory->create();
$delete_record->load($productId);			
$delete_record->delete();

$this->messageManager->addSuccess(__('Proizvod je uspešno obrisan'));  
return $resultRedirect->setPath('*/*/index'); 
    }
}