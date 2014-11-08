<?php

namespace s9e\TextFormatter\Tests\Configurator\Helpers;

use s9e\TextFormatter\Tests\Test;
use s9e\TextFormatter\Configurator\Helpers\TemplateForensics;

/**
* @covers s9e\TextFormatter\Configurator\Helpers\TemplateForensics
*/
class TemplateForensicsTest extends Test
{
	/**
	* @testdox getDOM() returns the template as a DOMDocument
	*/
	public function testGetDOM()
	{
		$templateForensics = new TemplateForensics('<br/>');

		$this->assertInstanceOf('DOMDocument', $templateForensics->getDOM());
	}

	public function runCase($k)
	{
		static $tests;
		if (!isset($cases))
		{
			$tests = $this->getData();
		}

		$title  = $tests[$k][0];
		$xslSrc = $tests[$k][1];
		$rule   = $tests[$k][2];
		$xslTrg = (isset($tests[$k][3])) ? $tests[$k][3] : null;

		$src = new TemplateForensics($xslSrc);
		$trg = new TemplateForensics($xslTrg);

		$assert = ($rule[0] === '!') ? 'assertFalse' : 'assertTrue';
		$method = ltrim($rule, '!');

		$this->$assert($src->$method($trg), $title);
	}

	// Start of content generated by ../../../../scripts/patchTemplateForensicsTest.php
	/** @testdox <span> does not allow <div> as child */
	public function test2CBBE8A9() { $this->runCase(0); }

	/** @testdox <span> does not allow <div> as child even with a <span> sibling */
	public function test650ADBD4() { $this->runCase(1); }

	/** @testdox <span> and <div> does not allow <span> and <div> as child */
	public function test1806C2AF() { $this->runCase(2); }

	/** @testdox <li> closes parent <li> */
	public function test55335E88() { $this->runCase(3); }

	/** @testdox <div> closes parent <p> */
	public function test4405B696() { $this->runCase(4); }

	/** @testdox <p> closes parent <p> */
	public function testA3342EC1() { $this->runCase(5); }

	/** @testdox <div> does not close parent <div> */
	public function test95ADC105() { $this->runCase(6); }

	/** @testdox <span> does not close parent <span> */
	public function test78511A05() { $this->runCase(7); }

	/** @testdox <a> denies <a> as descendant */
	public function testD33EA39A() { $this->runCase(8); }

	/** @testdox <a> allows <img> with no usemap attribute as child */
	public function testD351929A() { $this->runCase(9); }

	/** @testdox <a> denies <img usemap="#foo"> as child */
	public function testA40F2EB6() { $this->runCase(10); }

	/** @testdox <a> does not allow <iframe> as child */
	public function test28076BC4() { $this->runCase(11); }

	/** @testdox <div><a> allows <div> as child */
	public function test21CE8315() { $this->runCase(12); }

	/** @testdox <span><a> denies <div> as child */
	public function test041F623B() { $this->runCase(13); }

	/** @testdox <audio> with no src attribute allows <source> as child */
	public function test8B0A9455() { $this->runCase(14); }

	/** @testdox <audio src="..."> denies <source> as child */
	public function test2E32CC58() { $this->runCase(15); }

	/** @testdox <a> is considered transparent */
	public function test922375F7() { $this->runCase(16); }

	/** @testdox <a><span> is not considered transparent */
	public function test314E8100() { $this->runCase(17); }

	/** @testdox <span><a> is not considered transparent */
	public function test444B39F8() { $this->runCase(18); }

	/** @testdox A template composed entirely of a single <xsl:apply-templates/> is considered transparent */
	public function test70793519() { $this->runCase(19); }

	/** @testdox A template with no <xsl:apply-templates/> is not considered transparent */
	public function test1A9435FA() { $this->runCase(20); }

	/** @testdox <span> allows <unknownElement> as child */
	public function test655D9122() { $this->runCase(21); }

	/** @testdox <unknownElement> allows <span> as child */
	public function testEE29F1FF() { $this->runCase(22); }

	/** @testdox <textarea> allows text nodes */
	public function test2E7367FF() { $this->runCase(23); }

	/** @testdox <style> allows text nodes */
	public function test19B9DD8B() { $this->runCase(24); }

	/** @testdox <xsl:apply-templates/> allows text nodes */
	public function test1457EEC0() { $this->runCase(25); }

	/** @testdox <table> disallows text nodes */
	public function test6107CF00() { $this->runCase(26); }

	/** @testdox <table><tr><td> allows "Hi" */
	public function test5ED10B0C() { $this->runCase(27); }

	/** @testdox <div><table> disallows "Hi" */
	public function test55D2B228() { $this->runCase(28); }

	/** @testdox <table> disallows <xsl:value-of/> */
	public function testAF701A06() { $this->runCase(29); }

	/** @testdox <table> disallows <xsl:text>Hi</xsl:text> */
	public function test069CFF2A() { $this->runCase(30); }

	/** @testdox <table> allows <xsl:text>  </xsl:text> */
	public function test9F935BDA() { $this->runCase(31); }

	/** @testdox <b> is a formatting element */
	public function test0FEB502E() { $this->runCase(32); }

	/** @testdox <b><u> is a formatting element */
	public function test845660E9() { $this->runCase(33); }

	/** @testdox <span> is not a formatting element */
	public function test19D60ECB() { $this->runCase(34); }

	/** @testdox <span class="..."> is a formatting element */
	public function testC7510D70() { $this->runCase(35); }

	/** @testdox <span style="..."> is a formatting element */
	public function test08F36A4A() { $this->runCase(36); }

	/** @testdox <span class=""> is not a formatting element */
	public function test27C4BD88() { $this->runCase(37); }

	/** @testdox <span style=""> is not a formatting element */
	public function testD9E668BC() { $this->runCase(38); }

	/** @testdox <span style="..." onclick="..."> is not a formatting element */
	public function testF18E5BC3() { $this->runCase(39); }

	/** @testdox <div> is not a formatting element */
	public function testA5F32A8C() { $this->runCase(40); }

	/** @testdox <div><u> is not a formatting element */
	public function test2EF441C1() { $this->runCase(41); }

	/** @testdox "Hi" is not a formatting element */
	public function test14421B19() { $this->runCase(42); }

	/** @testdox A template composed entirely of a single <xsl:apply-templates/> is not a formatting element */
	public function testE1E4F3F4() { $this->runCase(43); }

	/** @testdox <img> uses the "empty" content model */
	public function test26941BF9() { $this->runCase(44); }

	/** @testdox <hr><xsl:apply-templates/></hr> uses the "empty" content model */
	public function test11094568() { $this->runCase(45); }

	/** @testdox <div><hr><xsl:apply-templates/></hr></div> uses the "empty" content model */
	public function testACE6126C() { $this->runCase(46); }

	/** @testdox <span> is not empty */
	public function testBF70FDFF() { $this->runCase(47); }

	/** @testdox <colgroup span="2"> uses the "empty" content model */
	public function testAA6266BB() { $this->runCase(48); }

	/** @testdox <colgroup> does not use the "empty" content model */
	public function test62BCC022() { $this->runCase(49); }

	/** @testdox <span> allows elements */
	public function test034C13C1() { $this->runCase(50); }

	/** @testdox <script> does not allow elements even if it has an <xsl:apply-templates/> child */
	public function test8CA0651D() { $this->runCase(51); }

	/** @testdox <script> does not allow <span> as a child, even if it has an <xsl:apply-templates/> child */
	public function testCAAEE63E() { $this->runCase(52); }

	/** @testdox <script> does not allow <span> as a descendant, even if it has an <xsl:apply-templates/> child */
	public function testC2B440E5() { $this->runCase(53); }

	/** @testdox <pre> preserves new lines */
	public function testC726DD16() { $this->runCase(54); }

	/** @testdox <pre><code> preserves new lines */
	public function test824949C9() { $this->runCase(55); }

	/** @testdox <span> does not preserve new lines */
	public function test1E3DCEEF() { $this->runCase(56); }

	/** @testdox <span style="white-space: pre"> preserves new lines */
	public function test1B533902() { $this->runCase(57); }

	/** @testdox <span><xsl:if test="@foo"><xsl:attribute name="style">white-space:pre</xsl:attribute></xsl:if> preserves new lines */
	public function testDD7861D0() { $this->runCase(58); }

	/** @testdox <pre style="white-space: normal"> does not preserve new lines */
	public function testEB8BE183() { $this->runCase(59); }

	/** @testdox <span style="white-space: pre-line"><span style="white-space: inherit"> preserves new lines */
	public function testACA921AF() { $this->runCase(60); }

	/** @testdox <span style="white-space: pre"><span style="white-space: normal"> preserves new lines */
	public function testA1BAD462() { $this->runCase(61); }

	/** @testdox <img/> is void */
	public function test5D210713() { $this->runCase(62); }

	/** @testdox <img> is void even with a <xsl:apply-templates/> child */
	public function test53CD3F08() { $this->runCase(63); }

	/** @testdox <span> is not void */
	public function test2218364A() { $this->runCase(64); }

	/** @testdox <xsl:apply-templates/> is not void */
	public function test517E8D2B() { $this->runCase(65); }

	/** @testdox <blockquote> is a block-level element */
	public function test602395E3() { $this->runCase(66); }

	/** @testdox <span> is not a block-level element */
	public function testE222869D() { $this->runCase(67); }

	/** @testdox <br/> is not passthrough */
	public function test56F3372F() { $this->runCase(68); }

	/** @testdox <b/> is not passthrough */
	public function test64B82909() { $this->runCase(69); }

	/** @testdox <b><xsl:apply-templates/></b> is passthrough */
	public function test3FC3E4F9() { $this->runCase(70); }

	/** @testdox <ruby> allows <rb> as a child */
	public function test83E45529() { $this->runCase(71); }

	/** @testdox <ruby> allows <rp> as a child */
	public function testCE0B797D() { $this->runCase(72); }

	/** @testdox <ruby> allows <rt> as a child */
	public function testE3AAA89C() { $this->runCase(73); }

	/** @testdox <ruby> allows <rtc> as a child */
	public function testD2C9A11F() { $this->runCase(74); }

	/** @testdox <ruby> does not allow <blockquote> as a child */
	public function testE184DDD9() { $this->runCase(75); }

	/** @testdox <ul> does not allow <br> as a child */
	public function testBC507AD5() { $this->runCase(76); }

	/** @testdox <ul> allows <br> as a descendant */
	public function test85D748CE() { $this->runCase(77); }
	// End of content generated by ../../../../scripts/patchTemplateForensicsTest.php

	public function getData()
	{
		return array(
			array(
				'<span> does not allow <div> as child',
				'<span><xsl:apply-templates/></span>',
				'!allowsChild',
				'<div><xsl:apply-templates/></div>'
			),
			array(
				'<span> does not allow <div> as child even with a <span> sibling',
				'<span><xsl:apply-templates/></span>',
				'!allowsChild',
				'<span>xxx</span><div><xsl:apply-templates/></div>'
			),
			array(
				'<span> and <div> does not allow <span> and <div> as child',
				'<span><xsl:apply-templates/></span><div><xsl:apply-templates/></div>',
				'!allowsChild',
				'<span/><div/>'
			),
			array(
				'<li> closes parent <li>',
				'<li/>',
				'closesParent',
				'<li><xsl:apply-templates/></li>'
			),
			array(
				'<div> closes parent <p>',
				'<div/>',
				'closesParent',
				'<p><xsl:apply-templates/></p>'
			),
			array(
				'<p> closes parent <p>',
				'<p/>',
				'closesParent',
				'<p><xsl:apply-templates/></p>'
			),
			array(
				'<div> does not close parent <div>',
				'<div/>',
				'!closesParent',
				'<div><xsl:apply-templates/></div>'
			),
			array(
				// This test mainly exist to ensure nothing bad happens with HTML tags that don't
				// have a "cp" value in TemplateForensics::$htmlElements
				'<span> does not close parent <span>',
				'<span/>',
				'!closesParent',
				'<span><xsl:apply-templates/></span>'
			),
			array(
				'<a> denies <a> as descendant',
				'<a><xsl:apply-templates/></a>',
				'!allowsDescendant',
				'<a/>'
			),
			array(
				'<a> allows <img> with no usemap attribute as child',
				'<a><xsl:apply-templates/></a>',
				'allowsChild',
				'<img/>'
			),
			array(
				'<a> denies <img usemap="#foo"> as child',
				'<a><xsl:apply-templates/></a>',
				'!allowsChild',
				'<img usemap="#foo"/>'
			),
			array(
				'<a> does not allow <iframe> as child',
				'<a href=""><xsl:apply-templates/></a>',
				'!allowsChild',
				'<iframe/>'
			),
			array(
				'<div><a> allows <div> as child',
				'<div><a><xsl:apply-templates/></a></div>',
				'allowsChild',
				'<div/>'
			),
			array(
				'<span><a> denies <div> as child',
				'<span><a><xsl:apply-templates/></a></span>',
				'!allowsChild',
				'<div/>'
			),
			array(
				'<audio> with no src attribute allows <source> as child',
				'<audio><xsl:apply-templates/></audio>',
				'allowsChild',
				'<source/>'
			),
			array(
				'<audio src="..."> denies <source> as child',
				'<audio src="{@src}"><xsl:apply-templates/></audio>',
				'!allowsChild',
				'<source/>'
			),
			array(
				'<a> is considered transparent',
				'<a><xsl:apply-templates/></a>',
				'isTransparent'
			),
			array(
				'<a><span> is not considered transparent',
				'<a><span><xsl:apply-templates/></span></a>',
				'!isTransparent'
			),
			array(
				'<span><a> is not considered transparent',
				'<span><a><xsl:apply-templates/></a></span>',
				'!isTransparent'
			),
			array(
				'A template composed entirely of a single <xsl:apply-templates/> is considered transparent',
				'<xsl:apply-templates/>',
				'isTransparent'
			),
			array(
				'A template with no <xsl:apply-templates/> is not considered transparent',
				'<hr/>',
				'!isTransparent'
			),
			array(
				'<span> allows <unknownElement> as child',
				'<span><xsl:apply-templates/></span>',
				'allowsChild',
				'<unknownElement/>'
			),
			array(
				'<unknownElement> allows <span> as child',
				'<unknownElement><xsl:apply-templates/></unknownElement>',
				'allowsChild',
				'<span/>'
			),
			array(
				'<textarea> allows text nodes',
				'<textarea><xsl:apply-templates/></textarea>',
				'allowsText'
			),
			array(
				'<style> allows text nodes',
				'<style><xsl:apply-templates/></style>',
				'allowsText'
			),
			array(
				'<xsl:apply-templates/> allows text nodes',
				'<xsl:apply-templates/>',
				'allowsText'
			),
			array(
				'<table> disallows text nodes',
				'<table><xsl:apply-templates/></table>',
				'!allowsText'
			),
			array(
				'<table><tr><td> allows "Hi"',
				'<table><tr><td><xsl:apply-templates/></td></tr></table>',
				'allowsChild',
				'Hi'
			),
			array(
				'<div><table> disallows "Hi"',
				'<div><table><xsl:apply-templates/></table></div>',
				'!allowsChild',
				'Hi'
			),
			array(
				'<table> disallows <xsl:value-of/>',
				'<table><xsl:apply-templates/></table>',
				'!allowsChild',
				'<xsl:value-of select="@foo"/>'
			),
			array(
				'<table> disallows <xsl:text>Hi</xsl:text>',
				'<table><xsl:apply-templates/></table>',
				'!allowsChild',
				'<xsl:text>Hi</xsl:text>'
			),
			array(
				'<table> allows <xsl:text>  </xsl:text>',
				'<table><xsl:apply-templates/></table>',
				'allowsChild',
				'<xsl:text>  </xsl:text>'
			),
			array(
				'<b> is a formatting element',
				'<b><xsl:apply-templates/></b>',
				'isFormattingElement'
			),
			array(
				'<b><u> is a formatting element',
				'<b><u><xsl:apply-templates/></u></b>',
				'isFormattingElement'
			),
			array(
				'<span> is not a formatting element',
				'<span><xsl:apply-templates/></span>',
				'!isFormattingElement'
			),
			array(
				'<span class="..."> is a formatting element',
				'<span class="foo"><xsl:apply-templates/></span>',
				'isFormattingElement'
			),
			array(
				'<span style="..."> is a formatting element',
				'<span style="color:red"><xsl:apply-templates/></span>',
				'isFormattingElement'
			),
			array(
				'<span class=""> is not a formatting element',
				'<span class=""><xsl:apply-templates/></span>',
				'!isFormattingElement'
			),
			array(
				'<span style=""> is not a formatting element',
				'<span style=""><xsl:apply-templates/></span>',
				'!isFormattingElement'
			),
			array(
				'<span style="..." onclick="..."> is not a formatting element',
				'<span style="color:red" onclick="alert(1)"><xsl:apply-templates/></span>',
				'!isFormattingElement'
			),
			array(
				'<div> is not a formatting element',
				'<div><xsl:apply-templates/></div>',
				'!isFormattingElement'
			),
			array(
				'<div><u> is not a formatting element',
				'<div><u><xsl:apply-templates/></u></div>',
				'!isFormattingElement'
			),
			array(
				'"Hi" is not a formatting element',
				'Hi',
				'!isFormattingElement'
			),
			array(
				'A template composed entirely of a single <xsl:apply-templates/> is not a formatting element',
				'<xsl:apply-templates/>',
				'!isFormattingElement'
			),
			array(
				'<img> uses the "empty" content model',
				'<img/>',
				'isEmpty'
			),
			array(
				'<hr><xsl:apply-templates/></hr> uses the "empty" content model',
				'<hr><xsl:apply-templates/></hr>',
				'isEmpty'
			),
			array(
				'<div><hr><xsl:apply-templates/></hr></div> uses the "empty" content model',
				'<div><hr><xsl:apply-templates/></hr></div>',
				'isEmpty'
			),
			array(
				'<span> is not empty',
				'<span><xsl:apply-templates/></span>',
				'!isEmpty'
			),
			array(
				'<colgroup span="2"> uses the "empty" content model',
				'<colgroup span="2"><xsl:apply-templates/></colgroup>',
				'isEmpty'
			),
			array(
				'<colgroup> does not use the "empty" content model',
				'<colgroup><xsl:apply-templates/></colgroup>',
				'!isEmpty'
			),
			array(
				'<span> allows elements',
				'<span><xsl:apply-templates/></span>',
				'allowsChildElements'
			),
			array(
				'<script> does not allow elements even if it has an <xsl:apply-templates/> child',
				'<script><xsl:apply-templates/></script>',
				'!allowsChildElements'
			),
			array(
				'<script> does not allow <span> as a child, even if it has an <xsl:apply-templates/> child',
				'<script><xsl:apply-templates/></script>',
				'!allowsChild',
				'<span/>'
			),
			array(
				'<script> does not allow <span> as a descendant, even if it has an <xsl:apply-templates/> child',
				'<script><xsl:apply-templates/></script>',
				'!allowsDescendant',
				'<span/>'
			),
			array(
				'<pre> preserves new lines',
				'<pre><xsl:apply-templates/></pre>',
				'preservesNewLines'
			),
			array(
				'<pre><code> preserves new lines',
				'<pre><code><xsl:apply-templates/></code></pre>',
				'preservesNewLines'
			),
			array(
				'<span> does not preserve new lines',
				'<span><xsl:apply-templates/></span>',
				'!preservesNewLines'
			),
			array(
				'<span style="white-space: pre"> preserves new lines',
				'<span style="white-space: pre"><xsl:apply-templates/></span>',
				'preservesNewLines'
			),
			array(
				'<span><xsl:if test="@foo"><xsl:attribute name="style">white-space:pre</xsl:attribute></xsl:if> preserves new lines',
				'<span><xsl:if test="@foo"><xsl:attribute name="style">white-space:pre</xsl:attribute></xsl:if><xsl:apply-templates/></span>',
				'preservesNewLines'
			),
			array(
				'<pre style="white-space: normal"> does not preserve new lines',
				'<pre style="white-space: normal"><xsl:apply-templates/></pre>',
				'!preservesNewLines'
			),
			array(
				'<span style="white-space: pre-line"><span style="white-space: inherit"> preserves new lines',
				'<span style="white-space: pre-line"><span style="white-space: inherit"><xsl:apply-templates/></span></span>',
				'preservesNewLines'
			),
			array(
				'<span style="white-space: pre"><span style="white-space: normal"> preserves new lines',
				'<span style="white-space: pre"><span style="white-space: normal"><xsl:apply-templates/></span></span>',
				'!preservesNewLines'
			),
			array(
				'<img/> is void',
				'<img><xsl:apply-templates/></img>',
				'isVoid'
			),
			array(
				'<img> is void even with a <xsl:apply-templates/> child',
				'<img><xsl:apply-templates/></img>',
				'isVoid'
			),
			array(
				'<span> is not void',
				'<span><xsl:apply-templates/></span>',
				'!isVoid'
			),
			array(
				'<xsl:apply-templates/> is not void',
				'<xsl:apply-templates/>',
				'!isVoid'
			),
			array(
				'<blockquote> is a block-level element',
				'<blockquote><xsl:apply-templates/></blockquote>',
				'isBlock'
			),
			array(
				'<span> is not a block-level element',
				'<span><xsl:apply-templates/></span>',
				'!isBlock'
			),
			array(
				'<br/> is not passthrough',
				'<br/>',
				'!isPassthrough'
			),
			array(
				'<b/> is not passthrough',
				'<b/>',
				'!isPassthrough'
			),
			array(
				'<b><xsl:apply-templates/></b> is passthrough',
				'<b><xsl:apply-templates/></b>',
				'isPassthrough'
			),
			array(
				'<ruby> allows <rb> as a child',
				'<ruby><xsl:apply-templates/></ruby>',
				'allowsChild',
				'<rb/>'
			),
			array(
				'<ruby> allows <rp> as a child',
				'<ruby><xsl:apply-templates/></ruby>',
				'allowsChild',
				'<rp/>'
			),
			array(
				'<ruby> allows <rt> as a child',
				'<ruby><xsl:apply-templates/></ruby>',
				'allowsChild',
				'<rt/>'
			),
			array(
				'<ruby> allows <rtc> as a child',
				'<ruby><xsl:apply-templates/></ruby>',
				'allowsChild',
				'<rtc/>'
			),
			array(
				'<ruby> does not allow <blockquote> as a child',
				'<ruby><xsl:apply-templates/></ruby>',
				'!allowsChild',
				'<blockquote/>'
			),
			array(
				'<ul> does not allow <br> as a child',
				'<ul><xsl:apply-templates/></ul>',
				'!allowsChild',
				'<br/>'
			),
			array(
				'<ul> allows <br> as a descendant',
				'<ul><xsl:apply-templates/></ul>',
				'allowsDescendant',
				'<br/>'
			),
		);
	}
}