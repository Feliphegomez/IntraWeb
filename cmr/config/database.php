<?php

define('HOST_DB', 'localhost');
define('USER_DB', 'admin_intraweb');
define('PASS_DB', 'admin_intraweb');
define('NAME_DB', 'admin_intraweb');


$settings = [
    'driver' => 'mysql',
    'address' => HOST_DB,
    'database' => NAME_DB,
    'username' => USER_DB,
    'password' => PASS_DB,
    'controllers' => 'records,openapi', //records,columns,cache,openapi
    'middlewares' => 'cors', //cors,jwtAuth,basicAuth,authorization,validation,sanitation,multiTenancy,customization
    // 'jwtAuth.mode' => 'optional',
    //'jwtAuth.time' => '1538207605',
    //'jwtAuth.secret' => 'axpIrCGNGqxzx2R9dtXLIPUSqPo778uhb8CA0F4Hx',
    //'basicAuth.mode' => 'optional',
    //'basicAuth.passwordFile' => __DIR__ . DIRECTORY_SEPARATOR . '.htpasswd',
    'debug' => true,
	'openApiBase' => '{"info":{"title":"API Rest FelipheGomez","version":"2.0.0"}}',
];
define('SETTINGS_API_REST', $settings);