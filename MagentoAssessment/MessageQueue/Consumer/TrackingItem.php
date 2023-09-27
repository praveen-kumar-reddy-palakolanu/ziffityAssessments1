<?php

namespace MagentoAssessment\MessageQueue\Consumer;

use Magento\Framework\Serialize\SerializerInterface;
use MagentoAssessment\MessageQueue\Model\TrackingProductFactory;
use MagentoAssessment\MessageQueue\Model\ResourceModel\TrackingProduct;

class TrackingItem
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var TrackingProductFactory
     */
    protected $modelFactory;

    /**
     * @var TrackingProduct
     */
    protected $resourceModel;

    /**
     * TrackingItem constructor.
     *
     * @param SerializerInterface $serializer
     * @param TrackingProductFactory $modelFactory
     * @param TrackingProduct $resourceModel
     */
    public function __construct(
        SerializerInterface $serializer,
        TrackingProductFactory $modelFactory,
        TrackingProduct $resourceModel
    ) {
        $this->serializer = $serializer;
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
    }

    /**
     * Consume data
     *
     * @param $data
     * @return void
     * @throws \Exception
     */
    public function consume($data)
    {
        $model = $this->modelFactory->create();
        $unserializedData = $this->serializer->unserialize($data);

        try {
            // Instead of $model->addData($unserializedData)->save();
            // Use the resource model's save method like this:
            $this->resourceModel->save($model->addData($unserializedData));
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
