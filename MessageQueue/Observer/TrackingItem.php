<?php
namespace MagentoAssessment\MessageQueue\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Checkout\Model\Session as CheckoutSession;
use MagentoAssessment\MessageQueue\Publisher\TrackingItem as Publisher;
use Psr\Log\LoggerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class TrackingItem
 *
 * @package MagentoAssessment\MessageQueue\Observer
 */
class TrackingItem implements ObserverInterface
{
    /**
     * @var CheckoutSession
     */
    private $checkoutSession;

    /**
     * @var Publisher
     */
    private $publisher;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * TrackingItem constructor.
     *
     * @param CheckoutSession $checkoutSession
     * @param Publisher $publisher
     * @param LoggerInterface $logger
     */
    public function __construct(
        CheckoutSession $checkoutSession,
        Publisher $publisher,
        LoggerInterface $logger
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->publisher = $publisher;
        $this->logger = $logger;
    }

    /**
     * Execute the observer
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        try {
            $sku = $observer->getProduct()->getSku();
            $quote = $this->checkoutSession->getQuote();
            $quoteId = $quote->getId();
            $customerId = $quote->getCustomerId();
            $created = $quote->getCreatedAt();
            $data = [
                'sku'         => $sku,
                'customer_id' => $customerId,
                'quote_id'    => $quoteId,
                'created'     => $created
            ];
            $this->logger->info('test', $data);
            $this->publisher->publish($data);
        } catch (NoSuchEntityException | LocalizedException $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
