<?php
namespace Learning\TestPlugin\Plugin\Catalog\Model;

use Magento\Catalog\Model\Product;

class ProductAttributesUpdater
{

    public function afterGetName(Product $subject, $result)
    {

        $title=$subject->getData('Brand');

        // file_put_contents(
        //     '../var/log/mylog.log',
        //     date('d/m/Y H:i:s') . json_encode([
        //     'test' => $subject->getData()
        //     ], JSON_PRETTY_PRINT). "\n",
        //     FILE_APPEND
        // );


        return $title . "customBrand -  " .$result;


    }

}
?>
