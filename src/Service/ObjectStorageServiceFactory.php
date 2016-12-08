<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/8
 * Time: 11:25
 */
namespace ApigilityObjectStorage\Service;

use Zend\ServiceManager\ServiceManager;

class ObjectStorageServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        return new ObjectStorageService($services);
    }
}