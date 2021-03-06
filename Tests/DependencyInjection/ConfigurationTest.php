<?php
/**
 * @copyright 2013 Instaclick Inc.
 */

namespace IC\Bundle\Base\RiakBundle\Tests\DependencyInjection;

use IC\Bundle\Base\RiakBundle\DependencyInjection\Configuration;
use IC\Bundle\Base\TestBundle\Test\DependencyInjection\ConfigurationTestCase;

/**
 * Test for Configuration
 *
 * @group ICBaseRiakBundle
 * @group Unit
 * @group DependencyInjection
 *
 * @author Anthon Pang <anthon.pang@gmail.com>
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class ConfigurationTest extends ConfigurationTestCase
{
    /**
     * Test valid data.
     *
     * @param array $config
     *
     * @dataProvider provideValidData
     */
    public function testValidData($config)
    {
        $configuration = $this->processConfiguration(new Configuration(), $config);

        $this->assertEquals('default.connection', $configuration['default_connection']);
        $this->assertEquals('riak.host', $configuration['connections']['default']['host']);
        $this->assertEquals('riak.port', $configuration['connections']['default']['port']);
        $this->assertEquals('connection1', $configuration['buckets']['ic_bucket1']['connection']);
        $this->assertEquals('name1', $configuration['buckets']['ic_bucket1']['name']);
        $this->assertArrayNotHasKey('property_list', $configuration['buckets']['ic_bucket1']);
        $this->assertEquals('connection2', $configuration['buckets']['ic_bucket2']['connection']);
        $this->assertEquals('name2', $configuration['buckets']['ic_bucket2']['name']);
        $this->assertEquals(2, $configuration['buckets']['ic_bucket2']['property_list']['n_value']);
        $this->assertEquals(true, $configuration['buckets']['ic_bucket2']['property_list']['allow_multiple']);
    }

    /**
     * Provide valid data.
     *
     * @return array
     */
    public function provideValidData()
    {
        return array(
            array(
                'test1' => array(
                    'ic_base_riak' => array(
                        'default_connection' => 'default.connection',
                        'connections' => array(
                            'default' => array(
                                'host' => 'riak.host',
                                'port' => 'riak.port',
                            ),
                        ),
                        'buckets' => array(
                            'ic_bucket1' => array(
                                'connection'    => 'connection1',
                                'name'          => 'name1',
                            ),
                            'ic_bucket2' => array(
                                'connection'    => 'connection2',
                                'name'          => 'name2',
                                'property_list' => array(
                                    'n_value'        => 2,
                                    'allow_multiple' => true,
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );
    }
}
