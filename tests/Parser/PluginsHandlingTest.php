<?php

namespace s9e\TextFormatter\Tests\Parser;

use s9e\TextFormatter\Parser;
use s9e\TextFormatter\Parser\PluginsHandling;
use s9e\TextFormatter\Tests\Test;

/**
* @covers s9e\TextFormatter\Parser\PluginsHandling
*/
class PluginsHandlingTest extends Test
{
	/**
	* @testdox disablePlugin() disables given plugin
	*/
	public function testDisablePlugin()
	{
		$dummy = new PluginsHandlingDummy;
		$dummy->disablePlugin('Test');

		$this->assertTrue($dummy->pluginsConfig['Test']['isDisabled']);
	}

	/**
	* @testdox enablePlugin() re-enables a disabled plugin
	*/
	public function testEnablePlugin()
	{
		$dummy = new PluginsHandlingDummy;
		$dummy->disablePlugin('Test');
		$dummy->enablePlugin('Test');

		$this->assertTrue(empty($dummy->pluginsConfig['Test']['isDisabled']));
	}

	/**
	* @testdox Nothing happens if disablePlugin() is called for an inexistent plugin
	*/
	public function testDisableInexistentPlugin()
	{
		$dummy = new PluginsHandlingDummy;
		$dummy->disablePlugin('Unknown');

		$this->assertArrayNotHasKey('Unknown', $dummy->pluginsConfig);
	}

	/**
	* @testdox Nothing happens if enablePlugin() is called for an inexistent plugin
	*/
	public function testEnableInexistentPlugin()
	{
		$dummy = new PluginsHandlingDummy;
		$dummy->enablePlugin('Unknown');

		$this->assertArrayNotHasKey('Unknown', $dummy->pluginsConfig);
	}

	/**
	* @testdox executePluginParsers() executes plugins' parse() method
	*/
	public function testExecutePluginParsers()
	{
		$dummy  = new PluginsHandlingDummy;
		$plugin = $this->getMock(
			's9e\\TextFormatter\\Plugins\\ParserBase',
			array('parse'),
			array($dummy, array())
		);

		$plugin->expects($this->once())
		       ->method('parse');

		$dummy->pluginParsers['Test'] = $plugin;

		$dummy->executePluginParsers();
	}

	/**
	* @testdox executePluginParsers() does not execute disabled plugins
	*/
	public function testExecutePluginParsersDisabledPlugin()
	{
		$dummy  = new PluginsHandlingDummy;
		$plugin = $this->getMock(
			's9e\\TextFormatter\\Plugins\\ParserBase',
			array('parse'),
			array($dummy, array())
		);

		$plugin->expects($this->never())
		       ->method('parse');

		$dummy->pluginParsers['Test'] = $plugin;
		$dummy->disablePlugin('Test');

		$dummy->executePluginParsers();
	}

	/**
	* @testdox executePluginParsers() executes a plugin if its quickMatch test passes
	*/
	public function testExecutePluginParsersQuickMatchPass()
	{
		$dummy  = new PluginsHandlingDummy('[.....');
		$plugin = $this->getMock(
			's9e\\TextFormatter\\Plugins\\ParserBase',
			array('parse'),
			array($dummy, array())
		);

		$plugin->expects($this->once())
		       ->method('parse');

		$dummy->pluginParsers['Test'] = $plugin;
		$dummy->pluginsConfig['Test']['quickMatch'] = '[';

		$dummy->executePluginParsers();
	}

	/**
	* @testdox executePluginParsers() does not execute a plugin if its quickMatch test fails
	*/
	public function testExecutePluginParsersQuickMatchFail()
	{
		$dummy  = new PluginsHandlingDummy;
		$plugin = $this->getMock(
			's9e\\TextFormatter\\Plugins\\ParserBase',
			array('parse'),
			array($dummy, array())
		);

		$plugin->expects($this->never())
		       ->method('parse');

		$dummy->pluginParsers['Test'] = $plugin;
		$dummy->pluginsConfig['Test']['quickMatch'] = '[';

		$dummy->executePluginParsers();
	}

	/**
	* @testdox executePluginParsers() executes a plugin if its regexp test passes
	*/
	public function testExecutePluginParsersRegexpPass()
	{
		$dummy  = new PluginsHandlingDummy('...foo...');
		$plugin = $this->getMock(
			's9e\\TextFormatter\\Plugins\\ParserBase',
			array('parse'),
			array($dummy, array())
		);

		$plugin->expects($this->once())
		       ->method('parse');

		$dummy->pluginParsers['Test'] = $plugin;
		$dummy->pluginsConfig['Test']['regexp'] = '/foo/';
		$dummy->pluginsConfig['Test']['regexpLimit'] = 1000;

		$dummy->executePluginParsers();
	}

	/**
	* @testdox executePluginParsers() does not execute a plugin if its regexp test fails
	*/
	public function testExecutePluginParsersRegexpFail()
	{
		$dummy  = new PluginsHandlingDummy;
		$plugin = $this->getMock(
			's9e\\TextFormatter\\Plugins\\ParserBase',
			array('parse'),
			array($dummy, array())
		);

		$plugin->expects($this->never())
		       ->method('parse');

		$dummy->pluginParsers['Test'] = $plugin;
		$dummy->pluginsConfig['Test']['regexp'] = '/foo/';
		$dummy->pluginsConfig['Test']['regexpLimit'] = 1000;

		$dummy->executePluginParsers();
	}

	/**
	* @testdox executePluginParsers() does not execute a plugin and throws a RuntimeException if the number of matches exceeds regexpLimit and regexpLimitAction is 'abort'
	* @expectedException RuntimeException
	* @expectedExceptionMessage Test limit exceeded
	*/
	public function testExecutePluginParsersRegexpLimitActionAbort()
	{
		$dummy  = new PluginsHandlingDummy('...foo...');
		$plugin = $this->getMock(
			's9e\\TextFormatter\\Plugins\\ParserBase',
			array('parse'),
			array($dummy, array())
		);

		$plugin->expects($this->never())
		       ->method('parse');

		$dummy->pluginParsers['Test'] = $plugin;
		$dummy->pluginsConfig['Test']['regexp'] = '/o/';
		$dummy->pluginsConfig['Test']['regexpLimit'] = 1;
		$dummy->pluginsConfig['Test']['regexpLimitAction'] = 'abort';

		$dummy->executePluginParsers();
	}

}

class PluginsHandlingDummy extends Parser
{
	public $logger;
	public $pluginParsers = array();
	public $pluginsConfig = array(
		'Test' => array(
		)
	);

	public function __construct($text = '')
	{
		$this->text = $text;
	}

	public function executePluginParsers()
	{
		return call_user_func_array('parent::executePluginParsers', func_get_args());
	}
}