<?php
namespace Patch\DbPatch\Controller\Index;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Patch\DbPatch\Model\CustomFormDataFactory;
class Index extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;
    protected $dataFactory;

    public function __construct(
        Context $context, 
        PageFactory $pageFactory,
        CustomFormDataFactory $dataFactory
    )
    {
        $this->pageFactory = $pageFactory;
        $this->dataFactory = $dataFactory;
         parent::__construct($context);
    }
    public function execute()
    {

        $page_object = $this->pageFactory->create();;
        $model = $this->dataFactory->create();
        $firstname = $this->getRequest()->getPost('firstname');
        $lastname = $this->getRequest()->getPost('lastname');

        $sampleData = [
         "firstname" => $firstname,
          "lastname" => $lastname];
          $model->setData($sampleData)->save();
        return $page_object;
    }    
}