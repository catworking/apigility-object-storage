<?php
namespace ApigilityObjectStorage\V1\Rest\File;

class FileResourceFactory
{
    public function __invoke($services)
    {
        return new FileResource($services);
    }
}
