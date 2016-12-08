<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/8
 * Time: 11:02
 */
namespace ApigilityObjectStorage\Adapter;

interface AdapterInterface
{
    /**
     * @param $uri
     * @return string
     */
    public function renderUriToUrl($uri);
}