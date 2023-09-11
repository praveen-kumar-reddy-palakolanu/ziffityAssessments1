<?php
namespace Patch\DbPatch\Model\ResourceModel\CustomFormData;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(DbSchemaNoPatch\NoPatch\Model\CustomFormData::class, DbSchemaNoPatch\NoPatch\Model\ResourceModel\CustomFormData::class);
    }
}
