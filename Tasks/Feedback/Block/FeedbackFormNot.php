<?php

namespace Tasks\Feedback\Block;

use Magento\Framework\View\Element\Template;


class FeedbackFormNot extends Template
{

    // private $collection;
    protected $_urlBuilder;
    public $customerSession;

   
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $data = [],
    ) {

        parent::__construct($context, $data);
        $this->_urlBuilder = $urlBuilder;

      

    }

    public function getPostUrl()
    {
        return $this->getUrl('feedback/actions/save');
    }

  
}
