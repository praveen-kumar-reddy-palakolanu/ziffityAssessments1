<?php
namespace  Patch\DbPatch\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class CustomFormData extends AbstractDb
{    /**     * @inheritdoc     */   
     protected function _construct()   
      {        
        $this->_init('custom_data_patch', 'entity_id');  
      }
    
    }