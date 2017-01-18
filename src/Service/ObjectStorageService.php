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
        if (isset($config['apigility-object-storage'])) {
            $config = $config['apigility-object-storage'];

            if ($config['adapter']['aliyun']['enable']) $this->adapter = new Aliyun($config['adapter']['aliyun']['params']);
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

    /**
     * 上传一个文件并返回已保存的相对路径
     *
     * @param $file_path
     * @param $remote_dir_path
     * @return string
     */
    public function uploadFile($file_path, $remote_dir_path)
    {
        return $this->adapter->uploadFile($file_path, $remote_dir_path);
    }
}