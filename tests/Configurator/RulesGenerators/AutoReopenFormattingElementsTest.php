<?php

namespace s9e\TextFormatter\Tests\Configurator\RulesGenerators;

/**
* @covers s9e\TextFormatter\Configurator\RulesGenerators\AutoReopenFormattingElements
*/
class AutoReopenFormattingElementsTest extends AbstractTest
{
	/**
	* @testdox Generates an autoReopen rule for <b>
	*/
	public function testAutoReopen()
	{
		$this->assertBooleanRules(
			'<b><xsl:apply-templates/></b>',
			array('autoReopen' => true)
		);
	}

	/**
	* @testdox Does not generate an autoReopen rule for <div>
	*/
	public function testNoAutoReopen()
	{
		$this->assertBooleanRules(
			'<div><xsl:apply-templates/></div>',
			array()
		);
	}

	/**
	* @testdox Does not generate an autoReopen rule for <div><b>
	*/
	public function testNoAutoReopenFormattingBlock()
	{
		$this->assertBooleanRules(
			'<div><b><xsl:apply-templates/></b></div>',
			array()
		);
	}
}