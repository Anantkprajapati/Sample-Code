<?php

 namespace AimsCoder\CategoryAttributes\Block;

class HomePageCategories extends \Magento\Framework\View\Element\Template
{
	protected $_categoryCollectionFactory;
 
    protected $_categoryHelper;

    protected $_categoryFactory;

    protected $_storeManager;

    public function __construct(
    	\Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Helper\Category $categoryHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        array $data = []
   	)
    {
    	$this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->_categoryHelper = $categoryHelper;
        $this->_storeManager = $storeManager;
        $this->_categoryFactory = $categoryFactory;
        parent::__construct($context, $data);
    }

    public function getHomePageCategories()
    {
        $collection = $this->_categoryCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setStore($this->_storeManager->getStore());
        $collection->addIsActiveFilter();
        $collection->addAttributeToFilter('is_home_category','1');
        $collection->addAttributeToFilter('entity_id',array('neq'=>'1'));
        return $collection;
    }

    public function getCategory($categoryId) 
    {
        $_category = $this->_categoryFactory->create();
        $_category->load($categoryId);        
        return $_category;
    }
}