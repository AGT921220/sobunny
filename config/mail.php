<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send all email
    | messages unless another mailer is explicitly specified when sending
    | the message. All additional mailers can be configured within the
    | "mailers" array. Examples of each type of mailer are provided.
    |
    */
    
    'default' => env('MAIL_MAILER', 'smtp'),
	
	/*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the mailers used by your application plus
    | their respective settings. Several examples have been configured for
    | you and you are free to add your own as your application requires.
    |
    | Laravel supports a variety of mail "transport" drivers that can be used
    | when delivering an email. You may specify which one you're using for
    | your mailers below. You may also add additional mailers if needed.
    |
    | Supported: "smtp", "sendmail", "mailgun", "ses", "ses-v2",
    |            "postmark", "log", "array", "failover", "roundrobin", "sparkpost", "mailersend"
    |
    */
	
	'mailers' => [
		'smtp' => [
			'transport'    => 'smtp',
			'url'          => env('MAIL_URL'),
			'host'         => env('MAIL_HOST', '127.0.0.1'),
			'port'         => env('MAIL_PORT', 2525),
			'encryption'   => env('MAIL_ENCRYPTION', 'tls'),
			'username'     => env('MAIL_USERNAME'),
			'password'     => env('MAIL_PASSWORD'),
			'timeout'      => env('MAIL_TIMEOUT'),
			'verify_peer'  => env('MAIL_VERIFY_PEER', false), // Set to true if using proper CA certificates
			'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
		],
		
		'ses' => [
			'transport' => 'ses',
		],
		
		'mailgun' => [
			'transport' => 'mailgun',
			// 'client' => [
			//     'timeout' => 5,
			// ],
		],
		
		'postmark' => [
			'transport'         => 'postmark',
			'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
			// 'client' => [
			//     'timeout' => 5,
			// ],
		],
		
		'sparkpost' => [
			'transport' => 'sparkpost',
		],
		
		'resend' => [
			'transport' => 'resend',
		],
		
		'mailersend' => [
			'transport' => 'mailersend',
		],
		
		'brevo' => [
			'transport' => 'brevo',
		],
		
		'sendmail' => [
			'transport' => 'sendmail',
			'path'      => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
		],
		
		'log' => [
			'transport' => 'log',
			'channel'   => env('MAIL_LOG_CHANNEL'),
		],
		
		'array' => [
			'transport' => 'array',
		],
		
		'failover' => [
			'transport' => 'failover',
			'mailers' => [
				'smtp',
				'mailgun',
				'sendmail',
				'log',
			],
		],
		
		'roundrobin' => [
			'transport' => 'roundrobin',
			'mailers' => [
				'ses',
				'postmark',
			],
		],
	],
	
	/*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all e-mails sent by your application to be sent from
    | the same address. Here, you may specify a name and address that is
    | used globally for all e-mails that are sent by your application.
    |
    */
	
	'from' => [
		'address' => env('MAIL_FROM_ADDRESS', null),
		'name'    => env('MAIL_FROM_NAME', null),
	],
	
	/*
	|--------------------------------------------------------------------------
	| Markdown Mail Settings
	|--------------------------------------------------------------------------
	|
	| If you are using Markdown based email rendering, you may configure your
	| theme and component paths here, allowing you to customize the design
	| of the emails. Or, you may simply stick with the Laravel defaults!
	|
	*/
	
	'markdown' => [
		'theme' => 'default',
		
		'paths' => [
			resource_path('views/vendor/mail'),
		],
	],
	
];