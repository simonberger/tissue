<?php

/*
 * This file is part of the Tissue library.
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Tissue\Tests\Util;

use CL\Tissue\Adapter\AdapterInterface;
use CL\Tissue\Util\AdapterRegistry;
use PHPUnit\Framework\TestCase;

class AdapterRegistryTest extends TestCase
{
    /**
     * @var AdapterRegistry
     */
    protected $registry;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $mockAdapter = $this->getMockBuilder(AdapterInterface::class)->getMock();

        $this->registry = new AdapterRegistry();
        $this->registry->register($mockAdapter, 'mock');
    }

    public function testGet()
    {
        $this->assertInstanceOf(AdapterInterface::class, $this->registry->get('mock'));
    }

    /**
     * Tests whether trying to get an non-registered adapter throws an exception
     *
     * @expectedException \InvalidArgumentException
     */
    public function testGetUnknown()
    {
        $this->registry->get('foobar');
    }

    public function testHas()
    {
        $this->assertTrue($this->registry->has('mock'));
        $this->assertFalse($this->registry->has('foobar'));
    }
}
