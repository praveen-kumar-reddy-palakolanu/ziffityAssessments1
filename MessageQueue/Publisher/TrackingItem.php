<?php

namespace MagentoAssessment\MessageQueue\Publisher;

use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Serialize\SerializerInterface;

class TrackingItem
{
    /**
     * Topic name for publishing.
     */
    const TOPIC_NAME = "trackingitem.topic";

    /**
     * @var PublisherInterface
     */
    private $publisher;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * TrackingItem constructor.
     *
     * @param PublisherInterface  $publisher
     * @param SerializerInterface $serializer
     */
    public function __construct(
        PublisherInterface $publisher,
        SerializerInterface $serializer
    ) {
        $this->publisher = $publisher;
        $this->serializer = $serializer;
    }

    /**
     * Publishes data to a message queue.
     *
     * @param array $data
     *
     * @return mixed|null
     */
    public function publish(array $data)
    {

        return $this->publisher->publish(self::TOPIC_NAME, $this->serializer->serialize($data));
    }
}
