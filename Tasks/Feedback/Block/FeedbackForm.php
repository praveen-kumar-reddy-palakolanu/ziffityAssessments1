<?php

namespace Tasks\Feedback\Block;

use Magento\Framework\View\Element\Template;
// use CustomFeedback\FeedbackForm\Model\ResourceModel\Feedback\Controller;


class FeedbackForm extends Template
{

    // private $collection;
    protected $_urlBuilder;

    /**
     * Display constructor.
     * @param Template\Context $context
     * @param Collection $collection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        // Collection $collection,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $data = [],

    ) {
        // $this->collection = $collection;
        parent::__construct($context, $data);
        $this->_urlBuilder = $urlBuilder;


    }

    public function getPostUrl()
    {
        return $this->getUrl('feedback/actions/save');
    }
}