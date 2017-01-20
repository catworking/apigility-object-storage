<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/8
 * Time: 11:06
 */
namespace ApigilityObjectStorage\Adapter;

use OSS\OssClient;
use OSS\Core\OssException;

class Aliyun implements AdapterInterface
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function renderUriToUrl($uri)
    {
        $url = null;
        if (empty($this->config['scheme'])) $url = '//'.$this->config['domain-outer'].'/'.$uri;
        else $url = $this->config['scheme'].'://'.$this->config['domain-outer'].'/'.$uri;
        return $url;
    }

    /**
     * 上传一个文件并返回已保存的相对路径
     *
     * @param $file_path
     * @param $remote_dir_path
     * @return string
     * @throws \Exception
     */
    public function uploadFile($file_path, $remote_dir_path)
    {
        $bucket = $this->config['bucket'];
        $ossClient = $this->getOssClient();
        if (is_null($ossClient)) throw new \Exception('初始化阿里云OSS客户端失败');

        $object_name = (new \DateTime())->format('Y') . '/' .
            (new \DateTime())->format('m') . '/' .
            (new \DateTime())->format('d') . '/' .
            time() . '-' . rand(1000, 9999);

        // 添加文件后缀
        $extension_name = pathinfo($file_path, PATHINFO_EXTENSION);
        if (!empty($extension_name)) $object_name .= '.' . $extension_name;

        if (!empty($remote_dir_path)) $object_name = $remote_dir_path . '/' . $object_name;

        try {
            $result = $ossClient->uploadFile($bucket, $object_name, $file_path);
            @unlink($file_path);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return $object_name;
    }

    public function getOssClient()
    {
        try {
            $ossClient = new OssClient($this->config['access-key'], $this->config['access-secret'], $this->config['endpoint'], false);
        } catch (OssException $e) {
            throw $e;
        }

        return $ossClient;
    }
}