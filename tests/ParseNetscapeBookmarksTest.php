<?php

/**
 * Ensure basic Netscape bookmarks are properly parsed
 *
 * @see https://msdn.microsoft.com/en-us/library/aa753582%28v=vs.85%29.aspx
 * @see http://www.w3schools.com/tags/tag_dl.asp
 */
class ParseNetscapeBookmarksTest extends PHPUnit_Framework_TestCase
{
    /**
     * Parse a basic Netscape file
     */
    public function testParseBasic()
    {
        $bkm = parse_netscape_bookmarks(
            file_get_contents('tests/input/netscape_basic.htm')
        );
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
        $bkm = parse_netscape_bookmarks(
            file_get_contents('tests/input/netscape_multiline.htm')
        );
        $this->assertEquals(2, sizeof($bkm));
        $this->assertEquals(
            'List:'.PHP_EOL.'- item1'.PHP_EOL.'- item2'.PHP_EOL.'- item3',
            $bkm[0]['note']
        );
        $this->assertEquals(
            'Nested lists:'
           .PHP_EOL.'- list1'.PHP_EOL.'  - item1.1'.PHP_EOL.'  - item1.2'.PHP_EOL.'  - item1.3'
           .PHP_EOL.'- list2'.PHP_EOL.'  - item2.1',
            $bkm[1]['note']
        );
    }

    /**
     * Parse log dates
     */
    public function testParseLogDates()
    {
        $this->assertEquals(
            '971211336',
            parse_bookmark_date('10/Oct/2000:13:55:36 -0700')
        );
        $this->assertEquals(
            '971186136',
            parse_bookmark_date('10/Oct/2000:13:55:36 +0000')
        );
        $this->assertEquals(
            '971175336',
            parse_bookmark_date('10/Oct/2000:13:55:36 +0300')
        );
    }

    /**
     * Parse Unix timestamps
     */
    public function testParseUnixDates()
    {
        $this->assertEquals(
            '1456433748',
            parse_bookmark_date('1456433748')
        );
        $this->assertEquals(
            '971175336',
            parse_bookmark_date('971175336')
        );
        $this->assertEquals(
            '-371211336',
            parse_bookmark_date('-371211336')
        );
    }

    /**
     * Use a default tag if none is found
     */
    public function testAddDefaultTag()
    {
        $bkm = parse_netscape_bookmarks(
            '<A HREF="http://no.tag">NoTag</A>'
        );
        $this->assertEquals(
            'imported-'.date('Ymd'),
            $bkm[0]['tags']
        );
    }

    /**
     * Use a user-defined default tag if none is found
     */
    public function testAddUserDefaultTag()
    {
        $bkm = parse_netscape_bookmarks(
            '<A HREF="http://no.tag">NoTag</A>',
            'im port ed'
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
        $bkm = parse_netscape_bookmarks(
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
        $bkm = parse_netscape_bookmarks(
            '<A HREF="http://space.tag" TAGS="t1 t2">SpaceTag</A>'
        );
        $this->assertEquals(
            't1 t2',
            $bkm[0]['tags']
        );

        $bkm = parse_netscape_bookmarks(
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
        $bkm = parse_netscape_bookmarks(
            '<A HREF="http://comma.tag" TAGS="t1,t2,t3">CommaTag</A>'
        );
        $this->assertEquals(
            't1 t2 t3',
            $bkm[0]['tags']
        );

        $bkm = parse_netscape_bookmarks(
            '<A HREF="http://comma.tag" TAGS="t1,.t2,.t_3">CommaTag</A>'
        );
        $this->assertEquals(
            't1 .t2 .t_3',
            $bkm[0]['tags']
        );
    }
}
