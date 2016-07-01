<?php

/**
 * Ensure Internet Explorer bookmarks are properly parsed
 *
 * The reference data has been dumped with IE 11
 */
class ParseInternetExplorerBookmarksTest extends PHPUnit_Framework_TestCase
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
     * Parse flat IE bookmarks (no directories)
     */
    public function testParseFlat()
    {
        $parser = new NetscapeBookmarkParser(false, null, '1');
        $bkm = $parser->parseFile('tests/input/internet_explorer_11_flat.htm');
        $this->assertEquals(18, sizeof($bkm));

        $this->assertEquals('', $bkm[0]['note']);
        $this->assertEquals('1', $bkm[0]['pub']);
        $this->assertEquals('', $bkm[0]['tags']);
        $this->assertEquals('1466267453', $bkm[0]['time']);
        $this->assertEquals(
            'A better git log (Example)  Coderwall',
            $bkm[0]['title']
        );
        $this->assertEquals(
            'https://coderwall.com/p/euwpig/a-better-git-log',
            $bkm[0]['uri']
        );

        $this->assertEquals('', $bkm[1]['note']);
        $this->assertEquals('1', $bkm[1]['pub']);
        $this->assertEquals('', $bkm[1]['tags']);
        $this->assertEquals('1466271589', $bkm[1]['time']);
        $this->assertEquals(
            'Authentication Cheat Sheet - OWASP',
            $bkm[1]['title']
        );
        $this->assertEquals(
            'https://www.owasp.org/index.php/Authentication_Cheat_Sheet',
            $bkm[1]['uri']
        );

        $this->assertEquals('', $bkm[2]['note']);
        $this->assertEquals('1', $bkm[2]['pub']);
        $this->assertEquals('', $bkm[2]['tags']);
        $this->assertEquals('1466270244', $bkm[2]['time']);
        $this->assertEquals('CSS 3D Clouds', $bkm[2]['title']);
        $this->assertEquals(
            'https://www.clicktorelease.com/code/css3dclouds/#',
            $bkm[2]['uri']
        );

        $this->assertEquals('', $bkm[3]['note']);
        $this->assertEquals('1', $bkm[3]['pub']);
        $this->assertEquals('', $bkm[3]['tags']);
        $this->assertEquals('1466269537', $bkm[3]['time']);
        $this->assertEquals(
            'Dealing with line endings - User Documentation',
            $bkm[3]['title']
        );
        $this->assertEquals(
            'https://help.github.com/articles/dealing-with-line-endings/'
           .'#platform-all',
            $bkm[3]['uri']
        );

        $this->assertEquals('', $bkm[4]['note']);
        $this->assertEquals('1', $bkm[4]['pub']);
        $this->assertEquals('', $bkm[4]['tags']);
        $this->assertEquals('1466267067', $bkm[4]['time']);
        $this->assertEquals(
            'Documentation of Album Covers Recreated with MS Paint',
            $bkm[4]['title']
        );
        $this->assertEquals(
            'http://www.publiccollectors.org/MSPaintAlbumCovers.htm',
            $bkm[4]['uri']
        );

        $this->assertEquals('', $bkm[5]['note']);
        $this->assertEquals('1', $bkm[5]['pub']);
        $this->assertEquals('', $bkm[5]['tags']);
        $this->assertEquals('1466267083', $bkm[5]['time']);
        $this->assertEquals('Excuses For Lazy Coders', $bkm[5]['title']);
        $this->assertEquals('http://developerexcuses.com/', $bkm[5]['uri']);

        $this->assertEquals('', $bkm[6]['note']);
        $this->assertEquals('1', $bkm[6]['pub']);
        $this->assertEquals('', $bkm[6]['tags']);
        $this->assertEquals('1466266989', $bkm[6]['time']);
        $this->assertEquals(
            'Fifty Shades of Grey text generator  '
           .'Parody erotic fiction generated algorithmically.',
            $bkm[6]['title']
        );
        $this->assertEquals('http://www.xwray.com/fiftyshades', $bkm[6]['uri']);

        $this->assertEquals('', $bkm[7]['note']);
        $this->assertEquals('1', $bkm[7]['pub']);
        $this->assertEquals('', $bkm[7]['tags']);
        $this->assertEquals('1466267009', $bkm[7]['time']);
        $this->assertEquals(
            'GitHub - originell-django-kittenstorage '
           .'Django Storage Engine which returns images of kittens '
           .'if files could not be found.',
            $bkm[7]['title']
        );
        $this->assertEquals(
            'https://github.com/originell/django-kittenstorage',
            $bkm[7]['uri']
        );

        $this->assertEquals('', $bkm[8]['note']);
        $this->assertEquals('1', $bkm[8]['pub']);
        $this->assertEquals('', $bkm[8]['tags']);
        $this->assertEquals('1466266984', $bkm[8]['time']);
        $this->assertEquals('Heroic Programming', $bkm[8]['title']);
        $this->assertEquals(
            'http://c2.com/cgi/wiki?HeroicProgramming',
            $bkm[8]['uri']
        );

        $this->assertEquals('', $bkm[9]['note']);
        $this->assertEquals('1', $bkm[9]['pub']);
        $this->assertEquals('', $bkm[9]['tags']);
        $this->assertEquals('1466271584', $bkm[9]['time']);
        $this->assertEquals(
            'Hg Init a Mercurial tutorial by Joel Spolsky',
            $bkm[9]['title']
        );
        $this->assertEquals('http://hginit.com/', $bkm[9]['uri']);

        $this->assertEquals('', $bkm[10]['note']);
        $this->assertEquals('1', $bkm[10]['pub']);
        $this->assertEquals('', $bkm[10]['tags']);
        $this->assertEquals('1466267047', $bkm[10]['time']);
        $this->assertEquals(
            'http--www.brendangregg.com-Specials-mkzombie.c',
            $bkm[10]['title']
        );
        $this->assertEquals(
            'http://www.brendangregg.com/Specials/mkzombie.c',
            $bkm[10]['uri']
        );

        $this->assertEquals('', $bkm[11]['note']);
        $this->assertEquals('1', $bkm[11]['pub']);
        $this->assertEquals('', $bkm[11]['tags']);
        $this->assertEquals('1466271425', $bkm[11]['time']);
        $this->assertEquals('It Never works with cats...', $bkm[11]['title']);
        $this->assertEquals(
            'http://lizclimo.tumblr.com/post/132165201759/'
           .'bonus-comic-for-national-cat-day',
            $bkm[11]['uri']
        );

        $this->assertEquals('', $bkm[12]['note']);
        $this->assertEquals('1', $bkm[12]['pub']);
        $this->assertEquals('', $bkm[12]['tags']);
        $this->assertEquals('1466269580', $bkm[12]['time']);
        $this->assertEquals(
            'Learn to write Gallifreyan in 9 simple steps',
            $bkm[12]['title']
        );
        $this->assertEquals(
            'http://io9.gizmodo.com/learn-to-write-gallifreyan-in-9'
           .'-simple-steps-506989915',
            $bkm[12]['uri']
        );

        $this->assertEquals('', $bkm[13]['note']);
        $this->assertEquals('1', $bkm[13]['pub']);
        $this->assertEquals('', $bkm[13]['tags']);
        $this->assertEquals('1466271385', $bkm[13]['time']);
        $this->assertEquals('Let me google that for you', $bkm[13]['title']);
        $this->assertEquals('http://lmgtfy.com/', $bkm[13]['uri']);

        $this->assertEquals('', $bkm[14]['note']);
        $this->assertEquals('1', $bkm[14]['pub']);
        $this->assertEquals('', $bkm[14]['tags']);
        $this->assertEquals('1466269615', $bkm[14]['time']);
        $this->assertEquals('PHP Sadness', $bkm[14]['title']);
        $this->assertEquals('http://phpsadness.com/', $bkm[14]['uri']);

        $this->assertEquals('', $bkm[15]['note']);
        $this->assertEquals('1', $bkm[15]['pub']);
        $this->assertEquals('', $bkm[15]['tags']);
        $this->assertEquals('1466269520', $bkm[15]['time']);
        $this->assertEquals(
            'TEDxZurich - Jojo Mayer - Exploring the distance between 0 and 1'
           .' - YouTube',
            $bkm[15]['title']
        );
        $this->assertEquals(
            'https://www.youtube.com/watch?v=KExLCJAuTXA',
            $bkm[15]['uri']
        );

        $this->assertEquals('', $bkm[16]['note']);
        $this->assertEquals('1', $bkm[16]['pub']);
        $this->assertEquals('', $bkm[16]['tags']);
        $this->assertEquals('1466267119', $bkm[16]['time']);
        $this->assertEquals('UserFriendly - Web Designer', $bkm[16]['title']);
        $this->assertEquals(
            'http://ars.userfriendly.org/cartoons/?id=19971206',
            $bkm[16]['uri']
        );

        $this->assertEquals('', $bkm[17]['note']);
        $this->assertEquals('1', $bkm[17]['pub']);
        $this->assertEquals('', $bkm[17]['tags']);
        $this->assertEquals('1466271475', $bkm[17]['time']);
        $this->assertEquals(
            'XKCD Plots in Matplotlib Going the Whole Way',
            $bkm[17]['title']
        );
        $this->assertEquals(
            'http://jakevdp.github.io/blog/2013/07/10/'
           .'XKCD-plots-in-matplotlib/',
            $bkm[17]['uri']
        );
    }

    /**
     * Parse nested IE bookmarks (directories and subdirectories)
     */
    public function testParseNested()
    {
        $parser = new NetscapeBookmarkParser(true, null, '1');
        $bkm = $parser->parseFile(
            'tests/input/internet_explorer_11_nested.htm'
        );
        $this->assertEquals(27, sizeof($bkm));

        $this->assertEquals('', $bkm[0]['note']);
        $this->assertEquals('1', $bkm[0]['pub']);
        $this->assertEquals('comics', $bkm[0]['tags']);
        $this->assertEquals('1466271425', $bkm[0]['time']);
        $this->assertEquals(
            'It Never works with cats...',
            $bkm[0]['title']
        );
        $this->assertEquals(
            'http://lizclimo.tumblr.com/post/132165201759/'
           .'bonus-comic-for-national-cat-day',
            $bkm[0]['uri']
        );

        $this->assertEquals('', $bkm[1]['note']);
        $this->assertEquals('1', $bkm[1]['pub']);
        $this->assertEquals('comics', $bkm[1]['tags']);
        $this->assertEquals('1466267119', $bkm[1]['time']);
        $this->assertEquals(
            'UserFriendly - Web Designer',
            $bkm[1]['title']
        );
        $this->assertEquals(
            'http://ars.userfriendly.org/cartoons/?id=19971206',
            $bkm[1]['uri']
        );

        $this->assertEquals('', $bkm[2]['note']);
        $this->assertEquals('1', $bkm[2]['pub']);
        $this->assertEquals('dev php', $bkm[2]['tags']);
        $this->assertEquals('1466269615', $bkm[2]['time']);
        $this->assertEquals(
            'PHP Sadness',
            $bkm[2]['title']
        );
        $this->assertEquals(
            'http://phpsadness.com/',
            $bkm[2]['uri']
        );

        $this->assertEquals('', $bkm[3]['note']);
        $this->assertEquals('1', $bkm[3]['pub']);
        $this->assertEquals('dev python', $bkm[3]['tags']);
        $this->assertEquals('1466267009', $bkm[3]['time']);
        $this->assertEquals(
            'GitHub - originell-django-kittenstorage'
           .' Django Storage Engine which returns images of kittens'
           .' if files could not be found.',
            $bkm[3]['title']
        );
        $this->assertEquals(
            'https://github.com/originell/django-kittenstorage',
            $bkm[3]['uri']
        );

        $this->assertEquals('', $bkm[4]['note']);
        $this->assertEquals('1', $bkm[4]['pub']);
        $this->assertEquals('dev python', $bkm[4]['tags']);
        $this->assertEquals('1466271475', $bkm[4]['time']);
        $this->assertEquals(
            'XKCD Plots in Matplotlib Going the Whole Way',
            $bkm[4]['title']
        );
        $this->assertEquals(
            'http://jakevdp.github.io/blog/2013/07/10/'
           .'XKCD-plots-in-matplotlib/',
            $bkm[4]['uri']
        );

        $this->assertEquals('', $bkm[5]['note']);
        $this->assertEquals('1', $bkm[5]['pub']);
        $this->assertEquals('dev scm', $bkm[5]['tags']);
        $this->assertEquals('1466267453', $bkm[5]['time']);
        $this->assertEquals(
            'A better git log (Example)  Coderwall',
            $bkm[5]['title']
        );
        $this->assertEquals(
            'https://coderwall.com/p/euwpig/a-better-git-log',
            $bkm[5]['uri']
        );

        $this->assertEquals('', $bkm[6]['note']);
        $this->assertEquals('1', $bkm[6]['pub']);
        $this->assertEquals('dev scm', $bkm[6]['tags']);
        $this->assertEquals('1466269537', $bkm[6]['time']);
        $this->assertEquals(
            'Dealing with line endings - User Documentation',
            $bkm[6]['title']
        );
        $this->assertEquals(
            'https://help.github.com/articles/dealing-with-line-endings/'
           .'#platform-all',
            $bkm[6]['uri']
        );

        $this->assertEquals('', $bkm[7]['note']);
        $this->assertEquals('1', $bkm[7]['pub']);
        $this->assertEquals('dev scm', $bkm[7]['tags']);
        $this->assertEquals('1466271584', $bkm[7]['time']);
        $this->assertEquals(
            'Hg Init a Mercurial tutorial by Joel Spolsky',
            $bkm[7]['title']
        );
        $this->assertEquals(
            'http://hginit.com/',
            $bkm[7]['uri']
        );

        $this->assertEquals('', $bkm[8]['note']);
        $this->assertEquals('1', $bkm[8]['pub']);
        $this->assertEquals('dev', $bkm[8]['tags']);
        $this->assertEquals('1466271589', $bkm[8]['time']);
        $this->assertEquals(
            'Authentication Cheat Sheet - OWASP',
            $bkm[8]['title']
        );
        $this->assertEquals(
            'https://www.owasp.org/index.php/Authentication_Cheat_Sheet',
            $bkm[8]['uri']
        );

        $this->assertEquals('', $bkm[9]['note']);
        $this->assertEquals('1', $bkm[9]['pub']);
        $this->assertEquals('dev', $bkm[9]['tags']);
        $this->assertEquals('1466270244', $bkm[9]['time']);
        $this->assertEquals(
            'CSS 3D Clouds',
            $bkm[9]['title']
        );
        $this->assertEquals(
            'https://www.clicktorelease.com/code/css3dclouds/#',
            $bkm[9]['uri']
        );

        $this->assertEquals('', $bkm[10]['note']);
        $this->assertEquals('1', $bkm[10]['pub']);
        $this->assertEquals('dev', $bkm[10]['tags']);
        $this->assertEquals('1466267083', $bkm[10]['time']);
        $this->assertEquals(
            'Excuses For Lazy Coders',
            $bkm[10]['title']
        );
        $this->assertEquals(
            'http://developerexcuses.com/',
            $bkm[10]['uri']
        );

        $this->assertEquals('', $bkm[11]['note']);
        $this->assertEquals('1', $bkm[11]['pub']);
        $this->assertEquals('dev', $bkm[11]['tags']);
        $this->assertEquals('1466266989', $bkm[11]['time']);
        $this->assertEquals(
            'Fifty Shades of Grey text generator'
           .'  Parody erotic fiction generated algorithmically.',
            $bkm[11]['title']
        );
        $this->assertEquals(
            'http://www.xwray.com/fiftyshades',
            $bkm[11]['uri']
        );

        $this->assertEquals('', $bkm[12]['note']);
        $this->assertEquals('1', $bkm[12]['pub']);
        $this->assertEquals('dev', $bkm[12]['tags']);
        $this->assertEquals('1466266984', $bkm[12]['time']);
        $this->assertEquals(
            'Heroic Programming',
            $bkm[12]['title']
        );
        $this->assertEquals(
            'http://c2.com/cgi/wiki?HeroicProgramming',
            $bkm[12]['uri']
        );

        $this->assertEquals('', $bkm[13]['note']);
        $this->assertEquals('1', $bkm[13]['pub']);
        $this->assertEquals('dev', $bkm[13]['tags']);
        $this->assertEquals('1466267047', $bkm[13]['time']);
        $this->assertEquals(
            'http--www.brendangregg.com-Specials-mkzombie.c',
            $bkm[13]['title']
        );
        $this->assertEquals(
            'http://www.brendangregg.com/Specials/mkzombie.c',
            $bkm[13]['uri']
        );

        $this->assertEquals('', $bkm[14]['note']);
        $this->assertEquals('1', $bkm[14]['pub']);
        $this->assertEquals('microsoft websites', $bkm[14]['tags']);
        $this->assertEquals('1363037966', $bkm[14]['time']);
        $this->assertEquals(
            'IE Add-on site',
            $bkm[14]['title']
        );
        $this->assertEquals(
            'http://go.microsoft.com/fwlink/?LinkId=50893',
            $bkm[14]['uri']
        );

        $this->assertEquals('', $bkm[15]['note']);
        $this->assertEquals('1', $bkm[15]['pub']);
        $this->assertEquals('microsoft websites', $bkm[15]['tags']);
        $this->assertEquals('1363037966', $bkm[15]['time']);
        $this->assertEquals(
            'IE site on Microsoft.com',
            $bkm[15]['title']
        );
        $this->assertEquals(
            'http://go.microsoft.com/fwlink/?linkid=44661',
            $bkm[15]['uri']
        );

        $this->assertEquals('', $bkm[16]['note']);
        $this->assertEquals('1', $bkm[16]['pub']);
        $this->assertEquals('microsoft websites', $bkm[16]['tags']);
        $this->assertEquals('1363037966', $bkm[16]['time']);
        $this->assertEquals(
            'Microsoft At Home',
            $bkm[16]['title']
        );
        $this->assertEquals(
            'http://go.microsoft.com/fwlink/?linkid=55424',
            $bkm[16]['uri']
        );

        $this->assertEquals('', $bkm[17]['note']);
        $this->assertEquals('1', $bkm[17]['pub']);
        $this->assertEquals('microsoft websites', $bkm[17]['tags']);
        $this->assertEquals('1363037966', $bkm[17]['time']);
        $this->assertEquals(
            'Microsoft At Work',
            $bkm[17]['title']
        );
        $this->assertEquals(
            'http://go.microsoft.com/fwlink/?linkid=68920',
            $bkm[17]['uri']
        );

        $this->assertEquals('', $bkm[18]['note']);
        $this->assertEquals('1', $bkm[18]['pub']);
        $this->assertEquals('microsoft websites', $bkm[18]['tags']);
        $this->assertEquals('1363037966', $bkm[18]['time']);
        $this->assertEquals(
            'Microsoft Store',
            $bkm[18]['title']
        );
        $this->assertEquals(
            'http://go.microsoft.com/fwlink/?linkid=140813',
            $bkm[18]['uri']
        );

        $this->assertEquals('', $bkm[19]['note']);
        $this->assertEquals('1', $bkm[19]['pub']);
        $this->assertEquals('music', $bkm[19]['tags']);
        $this->assertEquals('1466267067', $bkm[19]['time']);
        $this->assertEquals(
            'Album Covers Recreated with MS Paint',
            $bkm[19]['title']
        );
        $this->assertEquals(
            'http://www.publiccollectors.org/MSPaintAlbumCovers.htm',
            $bkm[19]['uri']
        );

        $this->assertEquals('', $bkm[20]['note']);
        $this->assertEquals('1', $bkm[20]['pub']);
        $this->assertEquals('music', $bkm[20]['tags']);
        $this->assertEquals('1466269520', $bkm[20]['time']);
        $this->assertEquals(
            'TEDxZurich - Jojo Mayer - Exploring the distance between 0 and 1'
           .' - YouTube',
            $bkm[20]['title']
        );
        $this->assertEquals(
            'https://www.youtube.com/watch?v=KExLCJAuTXA',
            $bkm[20]['uri']
        );

        $this->assertEquals('', $bkm[21]['note']);
        $this->assertEquals('1', $bkm[21]['pub']);
        $this->assertEquals('windows live', $bkm[21]['tags']);
        $this->assertEquals('1363037966', $bkm[21]['time']);
        $this->assertEquals(
            'Get Windows Live',
            $bkm[21]['title']
        );
        $this->assertEquals(
            'http://go.microsoft.com/fwlink/?LinkId=69172',
            $bkm[21]['uri']
        );

        $this->assertEquals('', $bkm[22]['note']);
        $this->assertEquals('1', $bkm[22]['pub']);
        $this->assertEquals('windows live', $bkm[22]['tags']);
        $this->assertEquals('1363037966', $bkm[22]['time']);
        $this->assertEquals(
            'Windows Live Gallery',
            $bkm[22]['title']
        );
        $this->assertEquals(
            'http://go.microsoft.com/fwlink/?LinkId=70742',
            $bkm[22]['uri']
        );

        $this->assertEquals('', $bkm[23]['note']);
        $this->assertEquals('1', $bkm[23]['pub']);
        $this->assertEquals('windows live', $bkm[23]['tags']);
        $this->assertEquals('1363037966', $bkm[23]['time']);
        $this->assertEquals(
            'Windows Live Mail',
            $bkm[23]['title']
        );
        $this->assertEquals(
            'http://go.microsoft.com/fwlink/?LinkId=68925',
            $bkm[23]['uri']
        );

        $this->assertEquals('', $bkm[24]['note']);
        $this->assertEquals('1', $bkm[24]['pub']);
        $this->assertEquals('windows live', $bkm[24]['tags']);
        $this->assertEquals('1363037966', $bkm[24]['time']);
        $this->assertEquals(
            'Windows Live Spaces',
            $bkm[24]['title']
        );
        $this->assertEquals(
            'http://go.microsoft.com/fwlink/?LinkId=68927',
            $bkm[24]['uri']
        );

        $this->assertEquals('', $bkm[25]['note']);
        $this->assertEquals('1', $bkm[25]['pub']);
        $this->assertEquals('', $bkm[25]['tags']);
        $this->assertEquals('1466269580', $bkm[25]['time']);
        $this->assertEquals(
            'Learn to write Gallifreyan in 9 simple steps',
            $bkm[25]['title']
        );
        $this->assertEquals(
            'http://io9.gizmodo.com/learn-to-write-gallifreyan-in-9'
           .'-simple-steps-506989915',
            $bkm[25]['uri']
        );

        $this->assertEquals('', $bkm[26]['note']);
        $this->assertEquals('1', $bkm[26]['pub']);
        $this->assertEquals('', $bkm[26]['tags']);
        $this->assertEquals('1466271385', $bkm[26]['time']);
        $this->assertEquals(
            'Let me google that for you',
            $bkm[26]['title']
        );
        $this->assertEquals(
            'http://lmgtfy.com/',
            $bkm[26]['uri']
        );
    }
}
