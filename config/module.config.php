<?php
return [
    'service_manager' => [
        'factories' => [
            \ApigilityObjectStorage\V1\Rest\File\FileResource::class => \ApigilityObjectStorage\V1\Rest\File\FileResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'apigility-object-storage.rest.file' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/object-storage/file[/:file_id]',
                    'defaults' => [
                        'controller' => 'ApigilityObjectStorage\\V1\\Rest\\File\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'apigility-object-storage.rest.file',
        ],
    ],
    'zf-rest' => [
        'ApigilityObjectStorage\\V1\\Rest\\File\\Controller' => [
            'listener' => \ApigilityObjectStorage\V1\Rest\File\FileResource::class,
            'route_name' => 'apigility-object-storage.rest.file',
            'route_identifier_name' => 'file_id',
            'collection_name' => 'file',
            'entity_http_methods' => [],
            'collection_http_methods' => [
                0 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ApigilityObjectStorage\V1\Rest\File\FileEntity::class,
            'collection_class' => \ApigilityObjectStorage\V1\Rest\File\FileCollection::class,
            'service_name' => 'File',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'ApigilityObjectStorage\\V1\\Rest\\File\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'ApigilityObjectStorage\\V1\\Rest\\File\\Controller' => [
                0 => 'application/vnd.apigility-object-storage.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'ApigilityObjectStorage\\V1\\Rest\\File\\Controller' => [
                0 => 'application/vnd.apigility-object-storage.v1+json',
                1 => 'application/json',
                2 => 'multipart/form-data',
                3 => 'multipart/mixed',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \ApigilityObjectStorage\V1\Rest\File\FileEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-object-storage.rest.file',
                'route_identifier_name' => 'file_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \ApigilityObjectStorage\V1\Rest\File\FileCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-object-storage.rest.file',
                'route_identifier_name' => 'file_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-content-validation' => [
        'ApigilityObjectStorage\\V1\\Rest\\File\\Controller' => [
            'input_filter' => 'ApigilityObjectStorage\\V1\\Rest\\File\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'ApigilityObjectStorage\\V1\\Rest\\File\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'data',
                'type' => \Zend\InputFilter\FileInput::class,
                'description' => '文件数据',
                'error_message' => '请输入文件数据',
            ],
        ],
    ],
];
