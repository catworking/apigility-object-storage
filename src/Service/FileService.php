<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/2
 * Time: 16:39
 */
namespace ApigilityObjectStorage\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use ApigilityObjectStorage\DoctrineEntity;

class FileService
{
    protected $classMethodsHydrator;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \ApigilityObjectStorage\Service\ObjectStorageService
     */
    protected $objectStorageService;

    public function __construct(ServiceManager $services)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
        $this->objectStorageService = $services->get('ApigilityObjectStorage\Service\ObjectStorageService');
    }

    public function createFile($data)
    {
        $file = new DoctrineEntity\File();
        $file->setType($data->type);
        $file->setTitle(isset($data->title) ? $data->title : '无标题');

        if (isset($data->data)) {
            // 把文件保存到外部存储
            if ($data->data['error'] == UPLOAD_ERR_OK) {
                $new_file_path = dirname($data->data['tmp_name']) . '/' . $data->data['name'];
                move_uploaded_file($data->data['tmp_name'], $new_file_path);
                $file->setUri($this->objectStorageService->uploadFile($new_file_path, 'apigility-object-storage'));
            }
        }

        $file->setCreateTime(new \DateTime());

        $this->em->persist($file);
        $this->em->flush();

        return $file;
    }

    public function getFile($file_id)
    {
        $file = $this->em->find('ApigilityObjectStorage\DoctrineEntity\File', $file_id);
        if (empty($file)) throw new \Exception('文件不存在', 404);
        else return $file;
    }

    public function getFiles($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('f')->from('ApigilityObjectStorage\DoctrineEntity\File', 'f');

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }

    public function deleteFile($file_id)
    {
        $file = $this->getFile($file_id);
        $this->em->remove($file);
        $this->em->flush();
        return true;
    }
}