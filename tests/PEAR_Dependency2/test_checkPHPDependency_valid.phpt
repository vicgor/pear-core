--TEST--
PEAR_Dependency2->checkPHPDependency() valid
--SKIPIF--
<?php
if (!getenv('PHP_PEAR_RUNTESTS')) {
    echo 'skip';
}
?>
--FILE--
<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'setup.php.inc';
$dep = &new test_PEAR_Dependency2($config, array(), array('channel' => 'pear.php.net',
    'package' => 'mine'), PEAR_VALIDATE_INSTALLING);
$phpunit->assertNoErrors('create 1');

$dep->setPHPversion('4.3.11');

$result = $dep->validatePhpDependency(
    array(
        'min' => '4.0.0',
        'max' => '5.0.0',
        'exclude' => array('4.3.9','4.3.10')
    ));
$phpunit->assertNoErrors('exclude 3');
$phpunit->assertTrue($result, 'exclude 3');

$dep = &new test_PEAR_Dependency2($config, array(), array('channel' => 'pear.php.net',
    'package' => 'mine'), PEAR_VALIDATE_DOWNLOADING);
$phpunit->assertNoErrors('create 2');

$dep->setPHPversion('4.3.11');

$result = $dep->validatePhpDependency(
    array(
        'min' => '4.0.0',
        'max' => '5.0.0',
        'exclude' => array('4.3.9','4.3.10')
    ));
$phpunit->assertNoErrors('exclude 3');
$phpunit->assertTrue($result, 'exclude 3');
echo 'tests done';
?>
--CLEAN--
<?php
require_once dirname(__FILE__) . '/teardown.php.inc';
?>
--EXPECT--
tests done
