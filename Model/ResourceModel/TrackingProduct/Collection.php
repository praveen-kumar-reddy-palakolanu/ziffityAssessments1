<?php
namespace MagentoAssessment\MessageQueue\Model\ResourceModel\TrackingProduct;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use MagentoAssessment\MessageQueue\Model\TrackingProduct as Model;
use MagentoAssessment\MessageQueue\Model\ResourceModel\TrackingProduct as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * Initialize resource model collection
     *
     * @return void
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(Model::class, ResourceModel::class);
        parent::_construct();
    }
}
