<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@backend/mail',
            'useFileTransport' => false,//set this property to false to send mails to real email addresses
            //comment the following array to send mail using php's mail function
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'deadfonki@gmail.com',
                'password' => 'nvfrkgedgzksyhjc',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
