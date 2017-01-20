<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/30
 * Time: 16:32
 */
return [
    'apigility-object-storage' => [
        'adapter'=>[
            'aliyun'=>[
                'enable' => false,
                'params' => [
                    'bucket' => '',
                    'domain-outer'=>'',
                    'domain-inner'=>'',
                    'access-key'=>'',
                    'access-secret'=>'',
                    'endpoint'=>'',
                    'scheme'=>''
                ],
            ]
        ]
    ]
];