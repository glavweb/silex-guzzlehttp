<?php

/*
 * This file is part of the GLAVWEB.cms SilexGuzzleHttp package.
 *
 * (c) Andrey Nilov <nilov@glavweb.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glavweb\SilexGuzzleHttp\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use GuzzleHttp\Client;

/**
 * GuzzleHttpServiceProvider
 *
 * @package Glavweb\SilexGuzzleHttp
 * @author Andrey Nilov <nilov@glavweb.ru>
 */
class GuzzleHttpServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['composite_object_service'] = function () use ($app) {
            $configuration = [];

            if (isset($app['guzzle.base_uri'])) {
                $configuration['base_uri'] = $app['guzzle.base_uri'];
            }

            if (isset($app['guzzle.timeout'])) {
                $configuration['timeout'] = $app['guzzle.timeout'];
            }

            if (isset($app['guzzle.debug'])) {
                $configuration['debug'] = $app['guzzle.debug'];
            }

            if (isset($app['guzzle.request_options']) && is_array($app['guzzle.request_options'])) {
                foreach ($app['guzzle.request_options'] as $name => $value) {
                    $configuration[$name] = $value;
                }
            }

            return new Client($configuration);
        };
    }
}
