<?php

namespace MagentoAssessment\MessageQueue\Api;

interface TrackingProductInterface
{
    /**
     * Get API data
     *
     * @param int|null $pageId
     * @return \MagentoAssessment\MessageQueue\Api\DataInterface[]
     */
    public function getApiData(int $pageId = null);

    /**
     * Save data
     *
     * @param string $sku
     * @param int $quoteId
     * @param int|null $customerId
     * @return \MagentoAssessment\MessageQueue\Api\DataInterface[]
     */
    public function save(string $sku, int $quoteId, int $customerId = null);

    /**
     * Get data by ID
     *
     * @param int $id
     * @return \MagentoAssessment\MessageQueue\Api\DataInterface[]
     */
    public function getById(int $id);

    /**
     * Update data
     *
     * @param int $id
     * @param string $sku
     * @param int $quoteId
     * @param int|null $customerId
     * @return \MagentoAssessment\MessageQueue\Api\DataInterface[]
     */
    public function update(int $id, string $sku, int $quoteId, int $customerId = null);

    /**
     * Delete data
     *
     * @param int $id
     * @return \MagentoAssessment\MessageQueue\Api\DataInterface[]
     */
    public function delete(int $id);
}
