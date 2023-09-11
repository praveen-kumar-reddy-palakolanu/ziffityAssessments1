<?php
namespace Example\Helloworld\Controller\Index;

use Magento\Framework\App\Action\Action;

class index extends Action
{
    public function execute()
    {
        echo "Hello World!";
    }
}