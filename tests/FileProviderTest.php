<?php

use Platformoncloud\Theme\Facades\Theme;

class FileProviderTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->app['config']->set([
            'themes' => [
                'enable'      => true,
                'driver'      => 'file',
                'connections' => [

                    'file' => [
                        'driver'        => 'file',
                        'default_theme' => 'default',
                        'path'          => __DIR__.DIRECTORY_SEPARATOR.'themes',
                    ],

                ],

            ],
        ]);
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testUseMethod()
    {
        $result = Theme::view('default');

        $this->assertEquals('default', $result);
    }

    public function testExistsMethod()
    {
        $resultTrue = Theme::exists('default');
        $resultFalse = Theme::exists('notExistsTheme');

        $this->assertTrue($resultTrue);
        $this->assertFalse($resultFalse);
    }

    public function testInfoMethod()
    {
        $result = Theme::info('default');

        $this->assertEquals('Default theme', $result['theme_title']);
        $this->assertEquals('https://platformoncloud.com', $result['theme_uri']);
        $this->assertEquals('web', $result['theme_type']);
        $this->assertEquals('minuwan@platformoncloud.com', $result['author_email']);
    }
}
