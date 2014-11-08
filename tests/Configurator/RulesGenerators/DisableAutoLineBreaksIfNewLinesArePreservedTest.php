<?php

namespace s9e\TextFormatter\Tests\Configurator\RulesGenerators;

/**
* @covers s9e\TextFormatter\Configurator\RulesGenerators\DisableAutoLineBreaksIfNewLinesArePreserved
*/
class DisableAutoLineBreaksIfNewLinesArePreservedTest extends AbstractTest
{
	/**
	* @testdox Does not generate a disableAutoLineBreaks rule for <ol>
	*/
	public function testNotDisableAutoLineBreaksOl()
	{
		$this->assertBooleanRules(
			'<ol><xsl:apply-templates/></ol>',
			array()
		);
	}

	/**
	* @testdox Generates a disableAutoLineBreaks rule for <pre>
	*/
	public function testDisableAutoLineBreaksPre()
	{
		$this->assertBooleanRules(
			'<pre><xsl:apply-templates/></pre>',
			array('disableAutoLineBreaks' => true)
		);
	}
}