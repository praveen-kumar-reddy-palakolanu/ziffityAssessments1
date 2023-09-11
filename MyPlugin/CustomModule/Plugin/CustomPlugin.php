<?php
namespace MyPlugin\CustomModule\Plugin;
use Magento\Catolog\Model\Product;
class CustomPlugin
{

    public function afterGetName(Product $subject, $result){
        $title = $subject->getData('Brand');

        return $title . "-" . $result;
    }
    // public function afterGetName(\Magento\Catalog\Model\product $product, $name){     
    //        $price = $product->getData('price');       
    //         $Brand = $product->getData('Brand');      
    //           if($price<60){           
    //              $name .=  $Brand. " So Dam Cheap, nah just kidding". $price;      
    //               }       
    //                else{            
    //                 $name .= $Brand."So Dam cheap, nah im not kidding" .$price;      
    //               }        
    //               return $name;
    
}
