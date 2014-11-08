<?php

namespace s9e\TextFormatter\Tests\Plugins\Keywords;

use s9e\TextFormatter\Plugins\Keywords\Configurator;
use s9e\TextFormatter\Tests\Test;

/**
* @covers s9e\TextFormatter\Plugins\Keywords\Configurator
*/
class ConfiguratorTest extends Test
{
	/**
	* @testdox Automatically creates a "KEYWORD" tag
	*/
	public function testCreatesTag()
	{
		$this->configurator->Keywords;
		$this->assertTrue($this->configurator->tags->exists('KEYWORD'));
	}

	/**
	* @testdox The name of the tag used can be changed through the "tagName" constructor option
	*/
	public function testCustomTagName()
	{
		$this->configurator->plugins->load('Keywords', array('tagName' => 'FOO'));
		$this->assertTrue($this->configurator->tags->exists('FOO'));
	}

	/**
	* @testdox The name of the attribute used can be changed through the "attrName" constructor option
	*/
	public function testCustomAttrName()
	{
		$this->configurator->plugins->load('Keywords', array('attrName' => 'bar'));
		$this->assertTrue($this->configurator->tags['KEYWORD']->attributes->exists('bar'));
	}

	/**
	* @testdox asConfig() returns FALSE if no keyword was added
	*/
	public function testConfigFalse()
	{
		$this->assertFalse($this->configurator->Keywords->asConfig());
	}

	/**
	* @testdox The config array contains the name of the tag
	*/
	public function testConfigTagName()
	{
		$this->configurator->Keywords->add('foo');
		$config = $this->configurator->Keywords->asConfig();

		$this->assertArrayHasKey('tagName', $config);
		$this->assertSame('KEYWORD', $config['tagName']);
	}

	/**
	* @testdox The config array contains the name of the attribute
	*/
	public function testConfigAttrName()
	{
		$plugin = $this->configurator->plugins->load('Keywords', array('attrName' => 'bar'));
		$plugin->add('foo');

		$config = $plugin->asConfig();

		$this->assertArrayHasKey('attrName', $config);
		$this->assertSame('bar', $config['attrName']);
	}

	/**
	* @testdox The config array contains an array of regexps
	*/
	public function testConfigRegexps()
	{
		$this->configurator->Keywords->add('foo');

		$config = $this->configurator->Keywords->asConfig();

		$this->assertArrayHasKey('regexps', $config);
		$this->assertEquals(array('/\\bfoo\\b/S'), array_map('strval', $config['regexps']));
	}

	/**
	* @testdox Keywords are split in groups to generate regexps smaller than ~32KB
	*/
	public function testConfigRegexpsHuge()
	{
		for ($i = 0; $i < 7; ++$i)
		{
			$this->configurator->Keywords->add(str_repeat($i, 8000));
		}

		$config = $this->configurator->Keywords->asConfig();

		$this->assertArrayHasKey('regexps', $config);
		$this->assertEquals(
			array(
				'/\\b(?>' . str_repeat('0', 8000) . '|' . str_repeat('1', 8000) . '|' . str_repeat('2', 8000) . ')\\b/S',
				'/\\b(?>' . str_repeat('3', 8000) . '|' . str_repeat('4', 8000) . '|' . str_repeat('5', 8000) . ')\\b/S',
				'/\\b' . str_repeat('6', 8000) . '\\b/S'
			),
			$config['regexps']
		);
	}

	/**
	* @testdox Regexps are case-insensitive if $plugin->caseSensitive is false
	*/
	public function testCaseInsensitive()
	{
		$this->configurator->Keywords->add('foo');
		$this->configurator->Keywords->caseSensitive = false;

		$config = $this->configurator->Keywords->asConfig();

		$this->assertArrayHasKey('regexps', $config);
		$this->assertEquals(array('/\\bfoo\\b/Si'), array_map('strval', $config['regexps']));
	}

	/**
	* @testdox Regexps that contain a non-ASCII character use Unicode mode
	*/
	public function testUnicode()
	{
		$this->configurator->Keywords->add('föo');

		$config = $this->configurator->Keywords->asConfig();

		$this->assertArrayHasKey('regexps', $config);
		$this->assertEquals(array('/\\bföo\\b/Su'), array_map('strval', $config['regexps']));
	}

	/**
	* @testdox asConfig() does not return an entry for onlyFirst by default
	*/
	public function testOnlyFirstDefault()
	{
		$this->configurator->Keywords->add('foo');

		$config = $this->configurator->Keywords->asConfig();

		$this->assertArrayNotHasKey('onlyFirst', $config);
	}

	/**
	* @testdox asConfig() has an entry for onlyFirst if it's true
	*/
	public function testOnlyFirstTrue()
	{
		$this->configurator->Keywords->add('foo');
		$this->configurator->Keywords->onlyFirst = true;

		$config = $this->configurator->Keywords->asConfig();

		$this->assertArrayHasKey('onlyFirst', $config);
		$this->assertTrue($config['onlyFirst']);
	}

	/**
	* @testdox asConfig() does not return an entry for onlyFirst if it's false
	*/
	public function testOnlyFirstFalse()
	{
		$this->configurator->Keywords->add('foo');
		$this->configurator->Keywords->onlyFirst = false;

		$config = $this->configurator->Keywords->asConfig();

		$this->assertArrayNotHasKey('onlyFirst', $config);
	}
}