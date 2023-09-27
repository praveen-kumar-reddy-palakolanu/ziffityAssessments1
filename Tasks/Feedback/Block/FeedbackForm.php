<?php

namespace Tasks\Feedback\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;

use Tasks\Feedback\Model\ResourceModel\Feedback\Collection;


class FeedbackForm extends Template
{

    // private $collection;
    protected $_urlBuilder;
    public $customerSession;

   
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\UrlInterface $urlBuilder,
        Session $customerSession,
        array $data = [],
    ) {

        parent::__construct($context, $data);
        $this->_urlBuilder = $urlBuilder;
        $this->customerSession = $customerSession;

      

    }

    public function getPostUrl()
    {
        return $this->getUrl('feedback/actions/save');
    }

    public function getFirstName()
    {
        $customer = $this->customerSession->getCustomer();

        var_dump($this->customerSession->isLoggedIn());

        $customerFirstName = $customer->getFirstName();


        return $customerFirstName;


     }
     public function getLastName()
     {
         $customerLastName = $this->customerSession->getCustomer()->getLastName();
 
         return $customerLastName;
 
 
      }
      public function getEmail()
      {
          $customerEmail = $this->customerSession->getCustomer()->getEmail();
  
          return $customerEmail;
  
  
       }
}
