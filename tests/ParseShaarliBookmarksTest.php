<?php

/**
 * Ensure Shaarli exports are properly parsed
 *
 * @see https://github.com/shaarli/Shaarli
 */
class ParseShaarliBookmarksTest extends PHPUnit_Framework_TestCase
{
    protected $parser = null;

    /**
     * Initialize test resources
     */
    public function setUp()
    {
        $this->parser = new NetscapeBookmarkParser();
    }

    /**
     * Parse bookmarks as exported by Shaarli - no plugin enabled
     */
    public function testParseNoPlugins()
    {
        $bkm = $this->parser->parseFile('tests/input/shaarli.htm');
        $this->assertEquals(6, sizeof($bkm));

        $this->assertEquals('1', $bkm[0]['pub']);
        $this->assertEquals('1459371397', $bkm[0]['time']);
        $this->assertEquals(
            "Kouign'amann recipes",
            $bkm[0]['title']
        );

        // Shaarli note (permalink)
        $this->assertEquals(
            "&quot;Is there anything more fabulous than something created"
           ." through the wonder and miracle of caramelization?&quot;".PHP_EOL
           .PHP_EOL
           ."- http://www.davidlebovitz.com/2005/08/long-live-the-k/".PHP_EOL
           ."- http://www.bonappetit.com/recipe/kouign-amann".PHP_EOL
           .PHP_EOL
           ."&quot;It is strictly forbidden to think about diet while"
           ." you're making a Kouign Amann&quot;",
            $bkm[0]['note']
        );
        $this->assertEquals(
            'breton recipe kouign amann traditional caramel butter',
            $bkm[0]['tags']
        );
        $this->assertEquals('1459371397', $bkm[0]['time']);
        $this->assertEquals('?lY47tw', $bkm[0]['uri']);

        $this->assertEquals('1', $bkm[1]['pub']);
        $this->assertEquals(
            'teapot computer generation graphics 3d',
            $bkm[1]['tags']
        );
        $this->assertEquals('1459371358', $bkm[1]['time']);
        $this->assertEquals(
            'http://nautil.us/blog/the-most-important-object-'
           .'in-computer-graphics-history-is-this-teapot',
            $bkm[1]['uri']
        );

        $this->assertEquals('0', $bkm[2]['pub']);
        $this->assertEquals('1459371224', $bkm[2]['time']);
        $this->assertEquals(
            'https://sebastian-bergmann.de/archives/881-Testing-Your-Privates.html',
            $bkm[2]['uri']
        );

        $this->assertEquals('1', $bkm[3]['pub']);
        $this->assertEquals('1459371140', $bkm[3]['time']);
        $this->assertEquals(
            'http://storml.deviantart.com/art/Mine-Turtle-Instructions-302477240'
           .'?q=in%3Ascraps%20sort%3Atime%20gallery%3Astorml&amp;qo=1',
            $bkm[3]['uri']
        );

        $this->assertEquals(
            'Welcome to Shaarli! This is your first public bookmark.'
           .' To edit or delete me, you must first login.'.PHP_EOL
           .PHP_EOL
           .'To learn how to use Shaarli, consult the link &quot;Help/documentation&quot;'
           .' at the bottom of this page.'.PHP_EOL
           .PHP_EOL
           .'You use the community supported version of the original Shaarli project,'
           .' by Sebastien Sauvage.',
            $bkm[4]['note']
        );
        $this->assertEquals('1', $bkm[4]['pub']);
        $this->assertEquals('1459370973', $bkm[4]['time']);
        $this->assertEquals(
            'https://github.com/shaarli/Shaarli/wiki',
            $bkm[4]['uri']
        );

        $this->assertEquals('0', $bkm[5]['pub']);
        $this->assertEquals('1459370913', $bkm[5]['time']);
        $this->assertEquals(
            'http://sebsauvage.net/paste/?8434b27936c09649#'
            .'bR7XsXhoTiLcqCpQbmOpBi3rq2zzQUC5hBI7ZT1O3x8=',
            $bkm[5]['uri']
        );
    }

    /**
     * Parse bookmarks as exported by Shaarli - Markdown plugin enabled
     */
    public function testParseMarkdown()
    {
        $bkm = $this->parser->parseFile('tests/input/shaarli_markdown.htm');
        $this->assertEquals(3, sizeof($bkm));

        // Markdown code
        $this->assertEquals(
            'PHP stuff:'.PHP_EOL
             .PHP_EOL
             .'    &lt;?php'.PHP_EOL
             .'    phpinfo();'.PHP_EOL
             .'    ?&gt;'.PHP_EOL
             .PHP_EOL
             .'Python stuff:'.PHP_EOL
             .PHP_EOL
             .'    import logging'.PHP_EOL
             .'    import os'.PHP_EOL
             .PHP_EOL
             ."    if __name__ == '__main__':".PHP_EOL
             .'        logging.info(&quot;Current directory: %s&quot;, os.getcwd())',
            $bkm[0]['note']
        );
        $this->assertEquals('1', $bkm[0]['pub']);
        $this->assertEquals('1463262544', $bkm[0]['time']);
        $this->assertEquals('?Z-mb0g', $bkm[0]['uri']);

        // Markdown lists
        $this->assertEquals(
            'Standard:'.PHP_EOL
             .'* item1'.PHP_EOL
             .'* item2'.PHP_EOL
             .'* item3'.PHP_EOL
             .PHP_EOL
             .'Nested:'.PHP_EOL
             .'- item1'.PHP_EOL
             .'    - item1.1'.PHP_EOL
             .'    - item1.2'.PHP_EOL
             .'- item2',
             $bkm[1]['note']
        );
        $this->assertEquals('1', $bkm[1]['pub']);
        $this->assertEquals('1463262338', $bkm[1]['time']);
        $this->assertEquals('?9PvbnA', $bkm[1]['uri']);

        // Markdown headers
        $this->assertEquals(
            'A First Level Header'.PHP_EOL
           .'===================='.PHP_EOL
           .PHP_EOL
           .'A Second Level Header'.PHP_EOL
           .'---------------------'.PHP_EOL
           .PHP_EOL
           .'Now is the time for all good men to come to'.PHP_EOL
           .'the aid of their country. This is just a'.PHP_EOL
           .'regular paragraph.'.PHP_EOL
           .PHP_EOL
           .'The quick brown fox jumped over the lazy'.PHP_EOL
           .'dog\'s back.'.PHP_EOL
           .PHP_EOL
           .'### Header 3'.PHP_EOL
           .PHP_EOL
           .'&gt; This is a blockquote.'.PHP_EOL
           .'&gt; '.PHP_EOL
           .'&gt; This is the second paragraph in the blockquote.'.PHP_EOL
           .'&gt;'.PHP_EOL
           .'&gt; ## This is an H2 in a blockquote',
            $bkm[2]['note']
        );
        $this->assertEquals('1', $bkm[2]['pub']);
        $this->assertEquals('1463262269', $bkm[2]['time']);
        $this->assertEquals('?GIvbSw', $bkm[2]['uri']);
    }
}
