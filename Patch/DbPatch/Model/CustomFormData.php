<?php
namespace Patch\DbPatch\Model;

use Magento\Framework\Model\AbstractModel;
use Patch\DbPatch\Model\ResourceModel\CustomFormData as CustomFormDataResource;

class CustomFormData extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(CustomFormDataResource::class);
    }
}