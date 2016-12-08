<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/8
 * Time: 11:25
 */
namespace ApigilityObjectStorage\Service;

use ApigilityObjectStorage\Adapter\Aliyun;
use Zend\ServiceManager\ServiceManager;

class ObjectStorageService
{
    /**
     * @var \ApigilityObjectStorage\Adapter\AdapterInterface
     */
    protected $adapter;

    public function __construct(ServiceManager $services)
    {
        $config = $services->get('config');
        if (isset($config['object-storage'])) {
            $config = $config['object-storage'];

            if (isset($config['adapter']['aliyun'])) $this->adapter = new Aliyun($config['adapter']['aliyun']);
            else throw new \Exception('没有配置Object Storage Adapter', 500);
        }
    }

    /**
     * @param $uri
     * @return string
     */
    public function renderUriToUrl($uri)
    {
        return $this->adapter->renderUriToUrl($uri);
    }
}