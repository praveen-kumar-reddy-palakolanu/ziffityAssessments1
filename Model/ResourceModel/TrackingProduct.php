<?php

namespace MagentoAssessment\MessageQueue\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class TrackingProduct extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('tracking_item', 'id');
    }
}
