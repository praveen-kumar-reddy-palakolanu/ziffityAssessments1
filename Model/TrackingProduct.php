<?php

namespace MagentoAssessment\MessageQueue\Model;

use Magento\Framework\Model\AbstractModel;
use MagentoAssessment\MessageQueue\Model\ResourceModel\TrackingProduct as ResourceModel;

class TrackingProduct extends AbstractModel
{
    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
        parent::_construct();
    }
}
