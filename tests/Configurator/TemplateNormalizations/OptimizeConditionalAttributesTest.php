<?php

namespace s9e\TextFormatter\Tests\Configurator\TemplateNormalizations;

/**
* @covers s9e\TextFormatter\Configurator\TemplateNormalizations\OptimizeConditionalAttributes
*/
class OptimizeConditionalAttributesTest extends AbstractTest
{
	public function getData()
	{
		return array(
			array(
				'<a><xsl:if test="@title"><xsl:attribute name="title"><xsl:value-of select="@title"/></xsl:attribute></xsl:if><xsl:apply-templates/></a>',
				'<a><xsl:copy-of select="@title"/><xsl:apply-templates/></a>'
			),
			array(
				'<a><xsl:if test="@foo"><xsl:attribute name="title"><xsl:value-of select="@foo"/></xsl:attribute></xsl:if><xsl:apply-templates/></a>',
				'<a><xsl:if test="@foo"><xsl:attribute name="title"><xsl:value-of select="@foo"/></xsl:attribute></xsl:if><xsl:apply-templates/></a>'
			),
		);
	}
}