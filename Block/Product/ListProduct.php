<?php

namespace Dtn\Categories\Block\Product;

use Magento\Catalog\Model\CategoryFactory;

class ListProduct extends \Magento\Catalog\Block\Product\ListProduct
{
    protected $productCollection;
    protected $categoryId;

    public function getLoadedProductCollection()
    {
        return $this->_getProductCollection();
    }

    public function setCategoryId($categoryId) {
        return $this->categoryId = $categoryId;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

}