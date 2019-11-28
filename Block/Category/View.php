<?php

namespace Dtn\Categories\Block\Category;

use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\View\Element\Template;
use Magento\TestFramework\Event\Magento;
use Magento\Framework\Registry;

class View extends \Magento\Framework\View\Element\Template
{
    protected $_categoryFactory;
    protected $registry;
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        Registry $registry,
        array $data = [])
    {
        $this->_categoryFactory = $categoryFactory;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    public function getCategory()
    {
        $id = $this->registry->registry('current_category');
        $categoryId = $id->getId();
        $category = $this->_categoryFactory->create();
        $category->load($categoryId);
        return $category;
    }

    public function getChildCategories()
    {
        $id = $this->registry->registry('current_category');
        $categoryId = $id->getId();
        $_category = $this->_categoryFactory->create();
        $category = $_category->load($categoryId);
        //Get category collection
        $collection = $category->getCollection()
            ->addIsActiveFilter()
            ->addOrderField('name')
            ->addIdFilter($category->getChildren());
        return $collection;
    }
    public function getProductsByCategory($categoryId)
    {
        $products = $this->getCategory($categoryId)
            ->getProductCollection()
            ->addAttributeToSelect('*')
            ->setPageSize(2);
        return $products;
    }

}