<?php

/**
 * Ensure Delicious exports are properly parsed
 *
 * @see http://delicious.com/
 */
class ParseDeliciousBookmarksTest extends PHPUnit_Framework_TestCase
{
    /**
     * Parse bookmarks as exported by Delicious
     */
    public function testParse()
    {
        $parser = new NetscapeBookmarkParser();
        $bkm = $parser->parseFile('tests/input/delicious.htm');
        $this->assertEquals(5, sizeof($bkm));

        $this->assertEquals(
            'Export your bookmarks to an HTML file, which can be used as a'
           .' backup or for importing into another web browser',
            $bkm[0]['note']
        );
        $this->assertEquals('1', $bkm[0]['pub']);
        $this->assertEquals('1098309600', $bkm[0]['time']);

        $this->assertEquals('1', $bkm[1]['pub']);
        $this->assertEquals('1268866800', $bkm[1]['time']);
        $this->assertEquals(
            'https://msdn.microsoft.com/en-us/library/aa753582%28v=vs.85%29.aspx',
            $bkm[1]['uri']
        );

        $this->assertEquals('0', $bkm[2]['pub']);
        $this->assertEquals('1265670000', $bkm[2]['time']);

        $this->assertEquals('1', $bkm[3]['pub']);
        $this->assertEquals('1428876000', $bkm[3]['time']);
        $this->assertEquals(
            'http://storml.deviantart.com/art/Mine-Turtle-Instructions-'
           .'302477240?q=in%3Ascraps%20sort%3Atime%20gallery%3Astorml&qo=1',
            $bkm[3]['uri']
        );

        $this->assertEquals('1', $bkm[4]['pub']);
        $this->assertEquals(
            '@font-face os typography',
            $bkm[4]['tags']
        );
        $this->assertEquals('1412085559', $bkm[4]['time']);
    }
}
