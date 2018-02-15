<?php

namespace rask\WpTestFramework;

/**
 * Class Framework
 *
 * @package rask\WpTestFramework
 */
class Framework
{
    /**
     * Load WP core for testing.
     *
     * @throws FrameworkException
     * @static
     *
     * @return void
     */
    public static function load()
    {
        try {
            self::validateTestConfig();

            include_once __DIR__ . '/phpunit/includes/bootstrap.php';
        } catch (FrameworkException $fe) {
            throw new FrameworkException('Invalid testing configuration given', 0, $fe);
        }
    }

    /**
     * Validate the directory where wp-tests-config.php is located.
     *
     * Reads the directory from an environment variable called
     * `WP_TESTS_INSTALLATION`.
     *
     * @throws FrameworkException If ENV value not defined or is invalid.
     * @static
     *
     * @return void
     */
    protected static function validateTestConfig() : void
    {
        $env_dir = getenv('WP_TESTS_INSTALLATION');

        if ($env_dir === false) {
            throw new FrameworkException('Could not read WP test installation directory from environment');
        }

        if (!is_dir($env_dir)) {
            throw new FrameworkException('Given WP test directory does not exist');
        }

        if (!file_exists($env_dir . '/wp-tests-config.php')) {
            throw new FrameworkException('No wp-tests-config.php file found in WP test installation directory');
        }
    }
}
