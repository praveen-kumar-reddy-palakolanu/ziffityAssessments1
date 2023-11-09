<?php

namespace MagentoAssessment\MessageQueue\Api;

interface DataInterface
{
    /**
     * Get ID
     *
     * @return int
     */
    public function getId();

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get SKU
     *
     * @return string
     */
    public function getSku();

    /**
     * Set SKU
     *
     * @param string $sku
     * @return $this
     */
    public function setSku($sku);

    /**
     * Get Quote ID
     *
     * @return int
     */
    public function getQuoteId();

    /**
     * Set Quote ID
     *
     * @param int $quoteId
     * @return $this
     */
    public function setQuoteId($quoteId);

    /**
     * Get Customer ID
     *
     * @return int
     */
    public function getCustomerId();

    /**
     * Set Customer ID
     *
     * @param int $customerId
     * @return $this
     */
    public function setCustomerId($customerId);

    /**
     * Get Created Date
     *
     * @return string
     */
    public function getCreated();

    /**
     * Set Created Date
     *
     * @param string $created
     * @return $this
     */
    public function setCreated($created);
}
