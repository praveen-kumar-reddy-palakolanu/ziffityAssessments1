<?php

namespace Tasks\Feedback\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Feedback extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb

{
    const MAIN_TABLE = 'feedback_form';
    const ID_FIELD_NAME = 'id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}