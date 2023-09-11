<?php
namespace Taskplugin\CustomPlugin\Plugin;


class product
{


    public function afterGetName(\Magento\Ctalog\Model\product $product, $name){
        $price = $product->getData('price');
        $Brand = $product->getData('Brand');
        if($price<60){
            $name .=  $Brand. " So Dam Cheap, nah just kidding". $price;
        }
        else{
            $name .= $Brand."So Dam cheap, nah im not kidding" .$price;
        }
        return $name;
    }

}