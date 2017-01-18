<?php
namespace ApigilityObjectStorage\V1\Rest\File;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use Zend\ServiceManager\ServiceManager;
use ZF\ApiProblem\ApiProblem;

class FileResource extends ApigilityResource
{
    /**
     * @var \ApigilityObjectStorage\Service\FileService
     */
    protected $fileService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->fileService = $this->serviceManager->get('ApigilityObjectStorage\Service\FileService');
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        try {
            return new FileEntity($this->fileService->createFile($data), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
