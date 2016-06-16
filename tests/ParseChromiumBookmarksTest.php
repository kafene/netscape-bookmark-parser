<?php

/**
 * Ensure Chromium exports are properly parsed
 *
 * The reference data has been dumped with Chromium 51.0.2704.84
 */
class ParseChromiumBookmarksTest extends PHPUnit_Framework_TestCase
{
    /**
     * Parse flat Chromium bookmarks (no directories)
     */
    public function testParseFlat()
    {
        $parser = new NetscapeBookmarkParser(false, null, '1');
        $bkm = $parser->parseFile('tests/input/chromium_flat.htm');
        $this->assertEquals(9, sizeof($bkm));

        $this->assertEquals('', $bkm[0]['note']);
        $this->assertEquals('1', $bkm[0]['pub']);
        $this->assertEquals('', $bkm[0]['tags']);
        $this->assertEquals('1466009029', $bkm[0]['time']);
        $this->assertEquals(
            'Cozy - Simple, versatile, yours',
            $bkm[0]['title']
        );
        $this->assertEquals('https://cozy.io/en/', $bkm[0]['uri']);

        $this->assertEquals('', $bkm[1]['note']);
        $this->assertEquals('1', $bkm[1]['pub']);
        $this->assertEquals('', $bkm[1]['tags']);
        $this->assertEquals('1466009059', $bkm[1]['time']);
        $this->assertEquals(
            'Framasoft ~ Page portail du réseau',
            $bkm[1]['title']
        );
        $this->assertEquals('https://framasoft.org/', $bkm[1]['uri']);

        $this->assertEquals('', $bkm[2]['note']);
        $this->assertEquals('1', $bkm[2]['pub']);
        $this->assertEquals('', $bkm[2]['tags']);
        $this->assertEquals('1466009167', $bkm[2]['time']);
        $this->assertEquals('The Linux Kernel Archives', $bkm[2]['title']);
        $this->assertEquals('https://www.kernel.org/', $bkm[2]['uri']);

        $this->assertEquals('', $bkm[3]['note']);
        $this->assertEquals('1', $bkm[3]['pub']);
        $this->assertEquals('', $bkm[3]['tags']);
        $this->assertEquals('1466009412', $bkm[3]['time']);
        $this->assertEquals('Regex Crossword', $bkm[3]['title']);
        $this->assertEquals('https://regexcrossword.com/', $bkm[3]['uri']);

        $this->assertEquals('', $bkm[4]['note']);
        $this->assertEquals('1', $bkm[4]['pub']);
        $this->assertEquals('', $bkm[4]['tags']);
        $this->assertEquals('1466009435', $bkm[4]['time']);
        $this->assertEquals('WINDOWS93', $bkm[4]['title']);
        $this->assertEquals('http://www.windows93.net/', $bkm[4]['uri']);

        $this->assertEquals('', $bkm[5]['note']);
        $this->assertEquals('1', $bkm[5]['pub']);
        $this->assertEquals('', $bkm[5]['tags']);
        $this->assertEquals('1466009639', $bkm[5]['time']);
        $this->assertEquals(
            'Are there any worse sorting algorithms than Bogosort'
           .' (a.k.a Monkey Sort)? - Stack Overflow',
            $bkm[5]['title']
        );
        $this->assertEquals(
            'http://stackoverflow.com/questions/2609857/'
           .'are-there-any-worse-sorting-algorithms-than-bogosort'
           .'-a-k-a-monkey-sort',
            $bkm[5]['uri']
        );

        $this->assertEquals('', $bkm[6]['note']);
        $this->assertEquals('1', $bkm[6]['pub']);
        $this->assertEquals('', $bkm[6]['tags']);
        $this->assertEquals('1466009667', $bkm[6]['time']);
        $this->assertEquals(
            'GitHub - lhartikk/ArnoldC: Arnold Schwarzenegger based'
           .' programming language',
            $bkm[6]['title']
        );
        $this->assertEquals(
            'https://github.com/lhartikk/ArnoldC',
            $bkm[6]['uri']
        );

        $this->assertEquals('', $bkm[7]['note']);
        $this->assertEquals('1', $bkm[7]['pub']);
        $this->assertEquals('', $bkm[7]['tags']);
        $this->assertEquals('1466010140', $bkm[7]['time']);
        $this->assertEquals(
            'OpenClassrooms, MOOCs and courses open for all',
            $bkm[7]['title']
        );
        $this->assertEquals('https://openclassrooms.com/', $bkm[7]['uri']);

        $this->assertEquals('', $bkm[8]['note']);
        $this->assertEquals('1', $bkm[8]['pub']);
        $this->assertEquals('', $bkm[8]['tags']);
        $this->assertEquals('1466010205', $bkm[8]['time']);
        $this->assertEquals(
            'Timeline of the Elves in Tolkien’s works | LotrProject Blog',
            $bkm[8]['title']
        );
        $this->assertEquals(
            'http://lotrproject.com/blog/2013/02/08/'
           .'timeline-of-the-elves-in-tolkiens-works/',
            $bkm[8]['uri']
        );
    }

    /**
     * Parse nested Chromium bookmarks (directories and subdirectories)
     */
    public function testParseNested()
    {
        $parser = new NetscapeBookmarkParser(true, null, '1');
        $bkm = $parser->parseFile('tests/input/chromium_nested.htm');
        $this->assertEquals(18, sizeof($bkm));

        $this->assertEquals('', $bkm[0]['note']);
        $this->assertEquals('1', $bkm[0]['pub']);
        $this->assertEquals('personal toolbar', $bkm[0]['tags']);
        $this->assertEquals('1466010266', $bkm[0]['time']);
        $this->assertEquals(
            'jabber.org - the original XMPP instant messaging service',
            $bkm[0]['title']
        );
        $this->assertEquals('http://www.jabber.org/', $bkm[0]['uri']);

        $this->assertEquals('', $bkm[1]['note']);
        $this->assertEquals('1', $bkm[1]['pub']);
        $this->assertEquals('', $bkm[1]['tags']);
        $this->assertEquals('1466009412', $bkm[1]['time']);
        $this->assertEquals('Regex Crossword', $bkm[1]['title']);
        $this->assertEquals('https://regexcrossword.com/', $bkm[1]['uri']);

        $this->assertEquals('', $bkm[2]['note']);
        $this->assertEquals('1', $bkm[2]['pub']);
        $this->assertEquals('', $bkm[2]['tags']);
        $this->assertEquals('1466009435', $bkm[2]['time']);
        $this->assertEquals('WINDOWS93', $bkm[2]['title']);
        $this->assertEquals('http://www.windows93.net/', $bkm[2]['uri']);

        $this->assertEquals('', $bkm[3]['note']);
        $this->assertEquals('1', $bkm[3]['pub']);
        $this->assertEquals('', $bkm[3]['tags']);
        $this->assertEquals('1466010205', $bkm[3]['time']);
        $this->assertEquals(
            'Timeline of the Elves in Tolkien’s works | LotrProject Blog',
            $bkm[3]['title']
        );
        $this->assertEquals(
            'http://lotrproject.com/blog/2013/02/08/timeline-of-the-elves'
           .'-in-tolkiens-works/',
            $bkm[3]['uri']
        );

        $this->assertEquals('', $bkm[4]['note']);
        $this->assertEquals('1', $bkm[4]['pub']);
        $this->assertEquals('dev php', $bkm[4]['tags']);
        $this->assertEquals('1466013084', $bkm[4]['time']);
        $this->assertEquals(
            'PHP Standards Recommendations - PHP-FIG',
            $bkm[4]['title']
        );
        $this->assertEquals('http://www.php-fig.org/psr/', $bkm[4]['uri']);

        $this->assertEquals('', $bkm[5]['note']);
        $this->assertEquals('1', $bkm[5]['pub']);
        $this->assertEquals('dev php', $bkm[5]['tags']);
        $this->assertEquals('1466013093', $bkm[5]['time']);
        $this->assertEquals(
            'php - Best practices to test protected methods with PHPUnit'
           .' - Stack Overflow',
            $bkm[5]['title']
        );
        $this->assertEquals(
            'http://stackoverflow.com/questions/249664/'
           .'best-practices-to-test-protected-methods-with-phpunit/'
           .'2798203#2798203',
            $bkm[5]['uri']
        );

        $this->assertEquals('', $bkm[6]['note']);
        $this->assertEquals('1', $bkm[6]['pub']);
        $this->assertEquals('dev python', $bkm[6]['tags']);
        $this->assertEquals('1466011820', $bkm[6]['time']);
        $this->assertEquals('Welcome :: CheckiO', $bkm[6]['title']);
        $this->assertEquals('https://checkio.org/', $bkm[6]['uri']);

        $this->assertEquals('', $bkm[7]['note']);
        $this->assertEquals('1', $bkm[7]['pub']);
        $this->assertEquals('dev python', $bkm[7]['tags']);
        $this->assertEquals('1466012966', $bkm[7]['time']);
        $this->assertEquals(
            'Welcome to the tox automation project — tox 2.3.2 documentation',
            $bkm[7]['title']
        );
        $this->assertEquals(
            'https://tox.readthedocs.io/en/latest/',
            $bkm[7]['uri']
        );

        $this->assertEquals('', $bkm[8]['note']);
        $this->assertEquals('1', $bkm[8]['pub']);
        $this->assertEquals('dev python', $bkm[8]['tags']);
        $this->assertEquals('1466012980', $bkm[8]['time']);
        $this->assertEquals(
            'Overview — Sphinx 1.4.4 documentation',
            $bkm[8]['title']
        );
        $this->assertEquals(
            'http://www.sphinx-doc.org/en/stable/',
            $bkm[8]['uri']
        );

        $this->assertEquals('', $bkm[9]['note']);
        $this->assertEquals('1', $bkm[9]['pub']);
        $this->assertEquals('dev', $bkm[9]['tags']);
        $this->assertEquals('1466011676', $bkm[9]['time']);
        $this->assertEquals(
            'GitHub - lhartikk/ArnoldC: Arnold Schwarzenegger based'
           .' programming language',
            $bkm[9]['title']
        );
        $this->assertEquals(
            'https://github.com/lhartikk/ArnoldC',
            $bkm[9]['uri']
        );

        $this->assertEquals('', $bkm[10]['note']);
        $this->assertEquals('1', $bkm[10]['pub']);
        $this->assertEquals('dev', $bkm[10]['tags']);
        $this->assertEquals('1466011763', $bkm[10]['time']);
        $this->assertEquals(
            'Are there any worse sorting algorithms than Bogosort'
           .' (a.k.a Monkey Sort)? - Stack Overflow',
            $bkm[10]['title']
        );
        $this->assertEquals(
            'http://stackoverflow.com/questions/2609857/'
           .'are-there-any-worse-sorting-algorithms-than-bogosort'
           .'-a-k-a-monkey-sort',
            $bkm[10]['uri']
        );

        $this->assertEquals('', $bkm[11]['note']);
        $this->assertEquals('1', $bkm[11]['pub']);
        $this->assertEquals('mooc', $bkm[11]['tags']);
        $this->assertEquals('1466011755', $bkm[11]['time']);
        $this->assertEquals(
            'OpenClassrooms, MOOCs and courses open for all',
            $bkm[11]['title']
        );
        $this->assertEquals('https://openclassrooms.com/', $bkm[11]['uri']);

        $this->assertEquals('', $bkm[12]['note']);
        $this->assertEquals('1', $bkm[12]['pub']);
        $this->assertEquals('mooc', $bkm[12]['tags']);
        $this->assertEquals('1466011780', $bkm[12]['time']);
        $this->assertEquals('Coursera', $bkm[12]['title']);
        $this->assertEquals('https://www.coursera.org/', $bkm[12]['uri']);

        $this->assertEquals('', $bkm[13]['note']);
        $this->assertEquals('1', $bkm[13]['pub']);
        $this->assertEquals('linux', $bkm[13]['tags']);
        $this->assertEquals('1466011739', $bkm[13]['time']);
        $this->assertEquals('The Linux Kernel Archives', $bkm[13]['title']);
        $this->assertEquals('https://www.kernel.org/', $bkm[13]['uri']);

        $this->assertEquals('', $bkm[14]['note']);
        $this->assertEquals('1', $bkm[14]['pub']);
        $this->assertEquals('self-hosting', $bkm[14]['tags']);
        $this->assertEquals('1466011652', $bkm[14]['time']);
        $this->assertEquals(
            'Cozy - Simple, versatile, yours',
            $bkm[14]['title']
        );
        $this->assertEquals('https://cozy.io/en/', $bkm[14]['uri']);

        $this->assertEquals('', $bkm[15]['note']);
        $this->assertEquals('1', $bkm[15]['pub']);
        $this->assertEquals('self-hosting', $bkm[15]['tags']);
        $this->assertEquals('1466011661', $bkm[15]['time']);
        $this->assertEquals(
            'Framasoft ~ Page portail du réseau',
            $bkm[15]['title']
        );
        $this->assertEquals('https://framasoft.org/', $bkm[15]['uri']);

        $this->assertEquals('', $bkm[16]['note']);
        $this->assertEquals('1', $bkm[16]['pub']);
        $this->assertEquals('self-hosting', $bkm[16]['tags']);
        $this->assertEquals('1466012934', $bkm[16]['time']);
        $this->assertEquals(
            'GitHub - shaarli/Shaarli:'
           .' The personal, minimalist, super-fast, database free,'
           .' bookmarking service - community repo',
            $bkm[16]['title']
        );
        $this->assertEquals(
            'https://github.com/shaarli/Shaarli',
            $bkm[16]['uri']
        );

        $this->assertEquals('', $bkm[17]['note']);
        $this->assertEquals('1', $bkm[17]['pub']);
        $this->assertEquals('self-hosting', $bkm[17]['tags']);
        $this->assertEquals('1466013448', $bkm[17]['time']);
        $this->assertEquals('ownCloud.org', $bkm[17]['title']);
        $this->assertEquals('https://owncloud.org/', $bkm[17]['uri']);
    }
}
