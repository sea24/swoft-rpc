<?php
/**
 * Created by PhpStorm.
 * User: yanghailong
 * Date: 2019/8/10
 * Time: 3:37 PM
 */

return [
    'consul' => [
        'address' => '47.106.178.79',
        'port' => 8500,
        'register' => [
            'ID' => 'test-4',
            'Name' => 'test-4',
            'Tags' => ['primary'],
            'Address' => '47.106.178.79',
            'Port' => 9810,
            'Check' => [
                'tcp' => '47.106.178.79:9801',
                'interval' => '10s',
                'timeout' => '2s',
            ],
            'Weights' => [
                "Passing" => 5,
                "Warning" => 1
            ]
        ],
        'discovery' => [
            'name' => 'user',
            'dc' => 'dc',
            'passing' => true
        ]
    ],
];