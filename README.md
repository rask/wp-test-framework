# rask/wp-test-framework

Extracted and librarized version of WordPress core's PHPUnit test framework to help with writing integration tests in WordPress plugins and themes.

The test framework is fetched from `https://develop.svn.wordpress.org/trunk/tests/phpunit/` and is stored in `src/phpunit` (with minor changes to make it work better as a Composer package).

The sources are updated when needed, so there may be minor differences between the core framework and this extracted library version. Let the maintainers know if there are bigger changes which need to be merged here.

## Installation

This library should be installed as a Composer dependency inside your plugin or theme:

    $ composer require --dev msaari/wp-test-framework
    
### WordPress testing installation setup

You need to have a WordPress instance downloaded locally into a directory where your user account can load and execute PHP code from:

    $ cd /home/you/wordpress
    $ wp-cli core download
    
Next, you do not need to install WP in there but instead you need a `wp-tests-config.php` file to be available. It is similar to a regular `wp-config.php` but is solely for testing purposes.

You can find an example configuration at `https://develop.svn.wordpress.org/trunk/wp-tests-config-sample.php`. Copy the contents into the WordPress root
directory (`ABSPATH`) and set up the configuration for your system (databases, etc.).

Your plugin/theme can (and probably should) live outside the WordPress testing installation.

## Setting up PHPUnit for your plugin/theme

Inside your plugin/theme directory you need to setup PHPUnit. Any regular-ish `phpunit.xml` configuration should work. In your PHPUnit bootstrap file you should load the WordPress test framework as such:

    <?php
    
    require_once './vendor/autoload.php';
    
    \msaari\WpTestFramework\Framework::load();

Then you should load your plugin or theme. In the same bootstrap file you can do the following:

    <?php
    
    require_once './vendor/autoload.php';
    
    \msaari\WpTestFramework\Framework::load();
    
    // Load your plugin
    
    require_once dirname(__DIR__) . '/my-plugin.php';
    
    // You can also add WP configuration here if you need to
    
Now your plugin tests are bootstrapped to use the test framework and your test cases can now act as integration tests that use the whole WordPress stack. In other words you can run tests just like WordPress core tests are run!

## Running your tests

You need to define an environment variable that contains a filesystem path (absolute or relative) to the WordPress testing installation you created earlier. The environment variable name is

    WP_TESTS_INSTALLATION
    
You can use the environment variable with PHPUnit as follows:

    $ WP_TESTS_INSTALLATION=/home/you/wordpress phpunit
    
Now you should see the WordPress get loaded and installed and you can start writing tests against the WordPress stack.

## Contributing

The upstream test framework might need mirroring from time to time so feel free to ping the maintainers in case a refresh is needed.

Submitting code is OK as long as it fits the purpose of this library and works. Documentation is also very welcome.

If something does not work as expected be sure to raise an issue.

## Other notes

Thanks for the WordPress team for the test framework.

## License

As the source framework and WordPress in general is GPLv2+, this library uses GPLv3+. See [LICENSE.md](LICENSE.md).
