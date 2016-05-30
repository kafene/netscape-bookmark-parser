<?php

/**
 * Ensure basic Netscape bookmarks are properly parsed
 *
 * @see https://msdn.microsoft.com/en-us/library/aa753582%28v=vs.85%29.aspx
 * @see http://www.w3schools.com/tags/tag_dl.asp
 */
class ParseNetscapeBookmarksTest extends PHPUnit_Framework_TestCase
{
    protected $parser = null;

    /**
     * Initialize test resources
     */
    public function setUp()
    {
        $this->parser = new NetscapeBookmarkParser(true, array(), 'error');
    }

    /**
     * Parse a basic Netscape file
     */
    public function testParseBasic()
    {
        $bkm = $this->parser->parseFile('tests/input/netscape_basic.htm');

        $this->assertEquals(2, sizeof($bkm));

        $this->assertEquals('Secret stuff', $bkm[0]['title']);
        $this->assertEquals(0, $bkm[0]['pub']);
        $this->assertEquals('private secret', $bkm[0]['tags']);
        $this->assertEquals('971175336', $bkm[0]['time']);
        $this->assertEquals(
            'Super-secret stuff you\'re not supposed to know about',
            $bkm[0]['note']
        );

        $this->assertEquals('Public stuff', $bkm[1]['title']);
        $this->assertEquals(1, $bkm[1]['pub']);
        $this->assertEquals('public hello world', $bkm[1]['tags']);
        $this->assertEquals('1456433748', $bkm[1]['time']);
        $this->assertEquals('', $bkm[1]['note']);
    }

    /**
     * Parse a Netscape file containing multiline descriptions
     */
    public function testParseMultilineDescriptions()
    {
        $bkm = $this->parser->parseFile('tests/input/netscape_multiline.htm');
        $this->assertEquals(3, sizeof($bkm));

        // simple list
        $this->assertEquals(
            'List:'.PHP_EOL.'- item1'.PHP_EOL.'- item2'.PHP_EOL.'- item3',
            $bkm[0]['note']
        );

        // nested lists
        $this->assertEquals(
            'Nested lists:'
           .PHP_EOL.'- list1'.PHP_EOL.'  - item1.1'.PHP_EOL.'  - item1.2'.PHP_EOL.'  - item1.3'
           .PHP_EOL.'- list2'.PHP_EOL.'  - item2.1',
            $bkm[1]['note']
        );

        // list and paragraphs separated by several newlines
        $this->assertEquals(
            'List:'.PHP_EOL.'- item1'.PHP_EOL.'- item2'.PHP_EOL
           .PHP_EOL.'Paragraph number one.'.PHP_EOL
           .PHP_EOL.'Paragraph'.PHP_EOL.'number'.PHP_EOL.'two.',
            $bkm[2]['note']
        );
    }

    /**
     * Parse bookmarks nested in folders
     */
    public function testParseNested()
    {
        $bkm = $this->parser->parseFile('tests/input/netscape_nested.htm');
        $this->assertEquals(8, sizeof($bkm));

        $this->assertEquals('tag1 tag2', $bkm[0]['tags']);
        $this->assertEquals('1456433741', $bkm[0]['time']);
        $this->assertEquals('Nested 1', $bkm[0]['title']);

        $this->assertEquals('folder1 tag1 tag2', $bkm[1]['tags']);
        $this->assertEquals('1456433742', $bkm[1]['time']);
        $this->assertEquals('Nested 1-1', $bkm[1]['title']);

        $this->assertEquals('folder1 tag3 tag4', $bkm[2]['tags']);
        $this->assertEquals('1456433747', $bkm[2]['time']);
        $this->assertEquals('Nested 1-2', $bkm[2]['title']);

        $this->assertEquals('folder2', $bkm[3]['tags']);
        $this->assertEquals('1454433742', $bkm[3]['time']);
        $this->assertEquals('Nested 2-1', $bkm[3]['title']);

        $this->assertEquals('folder2', $bkm[4]['tags']);
        $this->assertEquals('1453233747', $bkm[4]['time']);
        $this->assertEquals('Nested 2-2', $bkm[4]['title']);

        $this->assertEquals('folder3 folder3-1 tag3', $bkm[5]['tags']);
        $this->assertEquals('1454433742', $bkm[5]['time']);
        $this->assertEquals('Nested 3-1', $bkm[5]['title']);

        $this->assertEquals('folder3 folder3-1', $bkm[6]['tags']);
        $this->assertEquals('1453233747', $bkm[6]['time']);
        $this->assertEquals('Nested 3-2', $bkm[6]['title']);

        $this->assertEquals('tag4', $bkm[7]['tags']);
        $this->assertEquals('1456733741', $bkm[7]['time']);
        $this->assertEquals('Nested 2', $bkm[7]['title']);
    }

    /**
     * Parse boolean attribute values - evaluating to TRUE
     */
    function testParseBooleanAttributesTrue()
    {
        // standard booleans
        $this->assertTrue($this->parser->parseBoolean('on'));
        $this->assertTrue($this->parser->parseBoolean('t'));
        $this->assertTrue($this->parser->parseBoolean('true'));
        $this->assertTrue($this->parser->parseBoolean('y'));
        $this->assertTrue($this->parser->parseBoolean('yes'));
        $this->assertTrue($this->parser->parseBoolean('1'));
        $this->assertTrue($this->parser->parseBoolean('one'));

        // HTML forms
        $this->assertTrue($this->parser->parseBoolean('checked'));
        $this->assertTrue($this->parser->parseBoolean('ok'));
        $this->assertTrue($this->parser->parseBoolean('okay'));

        // integers != [0, 1]
        $this->assertTrue($this->parser->parseBoolean(2));
        $this->assertTrue($this->parser->parseBoolean(5));
        $this->assertTrue($this->parser->parseBoolean(-30));

        // other
        $this->assertTrue($this->parser->parseBoolean('+'));
    }

    /**
     * Parse boolean attribute values - evaluating to FALSE
     */
    function testParseBooleanAttributesFalse()
    {
        // standard booleans
        $this->assertFalse($this->parser->parseBoolean('f'));
        $this->assertFalse($this->parser->parseBoolean('false'));
        $this->assertFalse($this->parser->parseBoolean('n'));
        $this->assertFalse($this->parser->parseBoolean('neg'));
        $this->assertFalse($this->parser->parseBoolean('nil'));
        $this->assertFalse($this->parser->parseBoolean('no'));
        $this->assertFalse($this->parser->parseBoolean('off'));
        $this->assertFalse($this->parser->parseBoolean('zero'));
        $this->assertFalse($this->parser->parseBoolean('0'));

        // empty values
        $this->assertFalse($this->parser->parseBoolean('empty'));
        $this->assertFalse($this->parser->parseBoolean('null'));
        $this->assertFalse($this->parser->parseBoolean('void'));

        // errors
        $this->assertFalse($this->parser->parseBoolean('exit'));
        $this->assertFalse($this->parser->parseBoolean('die'));

        // other
        $this->assertFalse($this->parser->parseBoolean('-'));
    }

    /**
     * Parse boolean attribute values - fail and return the default value
     */
    function testParseBooleanAttributesDefault()
    {
        $default = 'def';
        $parser = new NetscapeBookmarkParser(false, array(), $default);

        $this->assertEquals(
            $default,
            $parser->parseBoolean('nope', $default)
        );
        $this->assertEquals(
            $default,
            $parser->parseBoolean('yess', $default)
        );
        $this->assertEquals(
            $default,
            $parser->parseBoolean('yup', $default)
        );
        $this->assertEquals(
            $default,
            $parser->parseBoolean('+++', $default)
        );
        $this->assertEquals(
            $default,
            $parser->parseBoolean('--', $default)
        );
    }

    /**
     * Parse log dates
     */
    public function testParseLogDates()
    {
        $this->assertEquals(
            '971211336',
            $this->parser->parseDate('10/Oct/2000:13:55:36 -0700')
        );
        $this->assertEquals(
            '971186136',
            $this->parser->parseDate('10/Oct/2000:13:55:36 +0000')
        );
        $this->assertEquals(
            '971175336',
            $this->parser->parseDate('10/Oct/2000:13:55:36 +0300')
        );
    }

    /**
     * Parse Unix timestamps
     */
    public function testParseUnixDates()
    {
        $this->assertEquals(
            '1456433748',
            $this->parser->parseDate('1456433748')
        );
        $this->assertEquals(
            '971175336',
            $this->parser->parseDate('971175336')
        );
        $this->assertEquals(
            '-371211336',
            $this->parser->parseDate('-371211336')
        );
    }

    /**
     * Leave links with no/empty tag as-is
     */
    public function testEmptyDefaultTag()
    {
        $bkm = $this->parser->parseString(
            '<A HREF="http://no.tag">NoTag</A>'
        );
        $this->assertEquals('', $bkm[0]['tags']);
    }

    /**
     * Use a user-defined default tag if none is found
     */
    public function testAddUserDefaultTag()
    {
        $default = 'im port ed';
        $parser = new NetscapeBookmarkParser(false, array($default));

        $bkm = $parser->parseString(
            '<A HREF="http://no.tag">NoTag</A>'
        );
        $this->assertEquals(
            'im port ed',
            $bkm[0]['tags']
        );
    }

    /**
     * Keep empty tags
     */
    public function testParseEmptyTags()
    {
        $bkm = $this->parser->parseString(
            '<A HREF="http://empty.tag" TAGS="">EmptyTag</A>'
        );
        $this->assertEquals(
            '',
            $bkm[0]['tags']
        );
    }

    /**
     * Parse space-separated tags
     */
    public function testParseSpaceTags()
    {
        $bkm = $this->parser->parseString(
            '<A HREF="http://space.tag" TAGS="t1 t2">SpaceTag</A>'
        );
        $this->assertEquals(
            't1 t2',
            $bkm[0]['tags']
        );

        $bkm = $this->parser->parseString(
            '<A HREF="http://space.tag" TAGS="t_1 .t_2">SpaceTag</A>'
        );
        $this->assertEquals(
            't_1 .t_2',
            $bkm[0]['tags']
        );
    }

    /**
     * Parse comma-separated tags
     */
    public function testParseCommaTags()
    {
        $bkm = $this->parser->parseString(
            '<A HREF="http://comma.tag" TAGS="t1,t2,t3">CommaTag</A>'
        );
        $this->assertEquals(
            't1 t2 t3',
            $bkm[0]['tags']
        );

        $bkm = $this->parser->parseString(
            '<A HREF="http://comma.tag" TAGS="t1,.t2,.t_3">CommaTag</A>'
        );
        $this->assertEquals(
            't1 .t2 .t_3',
            $bkm[0]['tags']
        );
    }
}
