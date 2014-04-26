<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'mail' => array(
        'name' => 'linux.ihserver1.com.br',
        'host' => 'linux.ihserver1.com.br',
        'port' => 465,
        'connectionClass' => 'login',
        'connectionConfig' => array(
            'ssl' => 'ssl',
            'username' => 'admin@limpezafacil.com',
            'password' => 'bdoz@194',
            'from' => 'admin@limpezafacil.com'
        )
    )
);
