<?php

namespace Syncit\Products\Controller\Index;

class Update extends \Magento\Framework\App\Action\Action
{
// protected $transportBuilder;
// protected $inlineTranslation;
// protected $scopeConfig;
// protected $storeManager;
// protected $formKeyValidator;
// protected $dateTime;
// protected $ticketFactory;
public function __construct(
\Magento\Framework\App\Action\Context $context 
// \Magento\Customer\Model\Session $customerSession,
// \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
// \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
// \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
// \Magento\Store\Model\StoreManagerInterface $storeManager,
// \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
// \Magento\Framework\Stdlib\DateTime $dateTime,
// \Foggyline\Helpdesk\Model\TicketFactory $ticketFactory
)
{
// $this->transportBuilder = $transportBuilder;
// $this->inlineTranslation = $inlineTranslation;
// $this->scopeConfig = $scopeConfig;
// $this->storeManager = $storeManager;
// $this->formKeyValidator = $formKeyValidator;
// $this->dateTime = $dateTime;
// $this->ticketFactory = $ticketFactory;
// $this->messageManager = $context->getMessageManager();
parent::__construct($context);
}
public function execute()
{
$resultRedirect = $this->resultRedirectFactory->create();
$name = $this->getRequest()->getParam('name');
$price = $this->getRequest()->getParam('price');
var_dump($price);
die();
 }
}