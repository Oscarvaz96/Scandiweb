<?php

namespace Scandiweb\Task1\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Locale\Resolver;
use Magento\Cms\Model\Page;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Store\Mode\StoreManagerInterface;
use Magento\Framework\Exception\LocalizedException;

class Main extends Template
{
    protected $_store;
    protected $_page;
    protected $_pageRepositoryInterface;
    protected $_searchCriteriaBuilder;
    protected $_storeInterface;
    protected $logger;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        Resolver $store,
        Page $page,
        PageRepositoryInterface $pageRepositoryInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        StoreManagerInterface $storeInterface,
        LoggerInterface $logger

    ) {
        parent::__construct($context);

        $this->_store = $store;
        $this->_page = $page;
        $this->_pageRepositoryInterface = $pageRepositoryInterface;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_storeInterface = $storeInterface;
        $this->logger = $logger;
        
    }

    public function getStoreById($id)
    {
        try {
            $store = $this->_storeInterface->getStore($id);
        } catch (LocalizedException $localizedException) {
            $this->logger->error($localizedException->getMessage());
        }
        return $store;
    }

    public function getStores(){
        $stores = $this->_page->getStores();
        return $stores;
    }

    public function getPageId(){
        $pageId = $this->_page->getId();
        return $pageId;
    }

    public function getCmsPageIdentifier(){
        $cmsPage = $this->_page->getIdentifier();
        return $cmsPage;
    }

    public function getBaseUrl(){
        return $this->getBaseUrl();
    }

    public function getLocale(){
        $language = $this->_store->getLocale();
        return $language;
    }

}
