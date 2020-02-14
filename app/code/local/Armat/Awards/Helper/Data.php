<?php
class Armat_Awards_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getProductAwards($product_id)
    {
        $out = '';

        $collection = Mage::getModel('armat_awards/award')->getCollection();
        $awardsCollection = array();
        foreach ($collection as $data) {
            $awardsCollection[$data->getId()] = array(
                'url' => $data->getUrl(),
                'image' => $data->getImage()
            );
        }

        $resource = Mage::getSingleton('catalog/product')->getResource();
        $optionValue = $resource->getAttributeRawValue($product_id, 'product_awards', Mage::app()->getStore());
        $awards = explode(',', $optionValue);

        foreach ($awards as $award) {
            if (array_key_exists($award, $awardsCollection)) {
                $image = $awardsCollection[$award]['image'];
                $url = $awardsCollection[$award]['url'];
                if(empty($url)) {
                    $out .= '<li class="item"><img src="/media/' . $image . '" alt="' . $image . '"></li>';
                }
                else {
                    $out .= '<li class="item"><a href="' . $url . '" target="_blank"><img src="/media/' . $image . '" alt="' . $image . '"></a></li>';
                }

            }

        }

        return $out;
    }
}
