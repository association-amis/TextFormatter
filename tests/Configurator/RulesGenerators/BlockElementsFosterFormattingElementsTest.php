<?php

namespace s9e\TextFormatter\Tests\Configurator\RulesGenerators;

/**
* @covers s9e\TextFormatter\Configurator\RulesGenerators\BlockElementsFosterFormattingElements
*/
class BlockElementsFosterFormattingElementsTest extends AbstractTest
{
	/**
	* @testdox <div> has a fosterParent rule for <b>
	*/
	public function testDivFosterB()
	{
		$this->assertTargetedRules(
			'<div><xsl:apply-templates/></div>',
			'<b><xsl:apply-templates/></b>',
			array('fosterParent')
		);
	}

	/**
	* @testdox <div> does not have a fosterParent rule for <div>
	*/
	public function testDivNoFosterDiv()
	{
		$this->assertTargetedRules(
			'<div><xsl:apply-templates/></div>',
			'<div><xsl:apply-templates/></div>',
			array()
		);
	}

	/**
	* @testdox <b> does not have a fosterParent rule for <b>
	*/
	public function testBNoFosterB()
	{
		$this->assertTargetedRules(
			'<b><xsl:apply-templates/></b>',
			'<b><xsl:apply-templates/></b>',
			array()
		);
	}
}