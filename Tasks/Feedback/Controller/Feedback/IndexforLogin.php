<?php

namespace Tasks\Feedback\Controller\Feedback;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;

class IndexforLogin extends Action
{
    protected $customerSession;
    public function __construct(
        Context $context,
        Session $customerSession
    ) {
        parent::__construct($context);
        $this->customerSession = $customerSession;
    }

    public function execute()
    {
        $isloggedIn=$this->customerSession->isLoggedIn();
        if ($isloggedIn) {
            $this->_redirect('feedback/feedback');
        } else {
            // User is not logged in, show login link and basic form
            $this->_view->loadLayout();
            $this->_view->renderLayout();
        }
    }
}
