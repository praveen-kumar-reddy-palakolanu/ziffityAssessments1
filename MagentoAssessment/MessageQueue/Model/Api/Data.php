<?php

namespace MagentoAssessment\MessageQueue\Model\Api;

use Magento\Framework\DataObject;
use MagentoAssessment\MessageQueue\Api\DataInterface;

/**
 * Class Data
 *
 * @package MagentoAssessment\MessageQueue\Model\Api
 */
class Data extends DataObject implements DataInterface
{
    /**
     * Get ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData('id', $id);
    }

    /**
     * Get SKU
     *
     * @return string
     */
    public function getSku()
    {
        return $this->getData('sku');
    }

    /**
     * Set SKU
     *
     * @param string $sku
     * @return $this
     */
    public function setSku($sku)
    {
        return $this->setData('sku', $sku);
    }

    /**
     * Get Customer ID
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->getData('customer_id');
    }

    /**
     * Set Customer ID
     *
     * @param int $customerId
     * @return $this
     */
    public function setCustomerId($customerId)
    {
        return $this->setData('customer_id', $customerId);
    }

    /**
     * Get Quote ID
     *
     * @return int
     */
    public function getQuoteId()
    {
        return $this->getData('quote_id');
    }

    /**
     * Set Quote ID
     *
     * @param int $quoteId
     * @return $this
     */
    public function setQuoteId($quoteId)
    {
        return $this->setData('quote_id', $quoteId);
    }

    /**
     * Get Created Date
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->getData('created');
    }

    /**
     * Set Created Date
     *
     * @param string $created
     * @return $this
     */
    public function setCreated($created)
    {
        return $this->setData('created', $created);
    }
}
