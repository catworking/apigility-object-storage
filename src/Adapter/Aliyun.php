<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/8
 * Time: 11:06
 */
namespace ApigilityObjectStorage\Adapter;

class Aliyun implements AdapterInterface
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function renderUriToUrl($uri)
    {
        return $this->config['scheme'].'://'.$this->config['domain-outer'].'/'.$uri;
    }
}