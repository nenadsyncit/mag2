<?php


namespace Syncit\Products\Controller\Index;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Serialize\SerializerInterface;


class Save extends \Magento\Framework\App\Action\Action
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

public function __construct(       
    \Magento\Framework\App\Action\Context $context,
	\Syncit\Products\Model\ProductFactory $productFactory,
	\Magento\Ui\Component\MassAction\Filter $filter,
    \Magento\Customer\Model\Session $customerSession,
    \Magento\Store\Model\StoreManagerInterface $storeManager,
    \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
    \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
    \Magento\Framework\Filesystem $filesystem,
     SerializerInterface $serializer


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

parent::__construct($context);
}
public function execute()
{
$resultRedirect = $this->resultRedirectFactory->create();
$name = $this->getRequest()->getParam('name');
$price = $this->getRequest()->getParam('price');

// Image handler
if(!empty($this->getRequest()->getFiles()->image['name'])){
    $uploader = $this->_fileUploaderFactory->create(['fileId' => 'image']);
    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png','jp2']);
    $uploader->setAllowRenameFiles(true);
    $path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('images');
    $image = $this->getRequest()->getFiles()->image['name'];
    $imgArray=explode('.',$image);
    $fileName=$imgArray[0];
    $fileExt=$imgArray[1];
    $image = $fileName . '_' . time() . '.' . $fileExt; 
    $stripped = preg_replace('/\s/', '_', $image);
    $image = $stripped;
    $result = $uploader->save($path,$image);
}       
else {
    $image ='no_image.png';
}
$content = $this->getRequest()->getParam('content');
//Sanitize inputs
//$availableTags='<p>,</p>';
$name = $this->sanitizeParams($name,'name');
$price = $this->sanitizeParams($price,'price');
//$content = strip_tags($content,$availableTags);
//$name = $this->serializer->serialize($name);
$data = array('product_name'=>$name,'product_price'=>$price,'product_content'=>$content,'product_image'=>$image);

//var_dump($data);
//die();

 
 //Check Validation
 $name= $this->validateInput($name,'name');
 $price= $this->validateInput($price,'price');

if(isset($this->_errors)){
$this->messageManager->addError(__('Došlo je do greške, pokušajte ponovo da dodate proizvod !'));  
return $resultRedirect->setPath('*/*/add');
}
else{
$create_record= $this->_productFactory->create();
		$create_record->setData($data);
		$create_record->save(); 
$this->messageManager->addSuccess(__('Uspešno ste dodali proizvod.'));  
return $resultRedirect->setPath('*/*/index');
   } 
}
 // Validate inputs
 private function validateInput($param,$value)
 {
    $post = $this->getRequest()->getParams();
    
     if (trim($post[$value] === '')) {
        $this->_errors = 'Došlo je do greške proverite sva polja i probajte ponovo!';
        $error = $this->_errors;
            
     return $error; 
 }}
 // Sanitize inputs
 public function sanitizeParams($param, $value)
{
    $post = $this->getRequest()->getParams();                
    //$param = filter_var($post[$value], FILTER_SANITIZE_ENCODED) ;
    //$param = filter_var($post[$value],FILTER_SANITIZE_ENCODED);
    //$param = strip_tags($post[$value]) ;
    //$param = htmlspecialchars($post[$value]);
    $param = filter_var($post[$value],FILTER_SANITIZE_SPECIAL_CHARS);
    return $param;
}
}