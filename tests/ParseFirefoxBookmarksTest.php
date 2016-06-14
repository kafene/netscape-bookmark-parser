<?php

/**
 * Ensure Firefox exports are properly parsed
 *
 * The reference data has been dumped with Mozilla Firefox 46.0.1
 */
class ParseFirefoxBookmarksTest extends PHPUnit_Framework_TestCase
{
    /**
     * Parse flat Firefox bookmarks (no directories)
     */
    public function testParseFlat()
    {
        $parser = new NetscapeBookmarkParser(false, null, '1');
        $bkm = $parser->parseFile('tests/input/firefox_flat.htm');
        $this->assertEquals(24, sizeof($bkm));

        $this->assertEquals('', $bkm[0]['note']);
        $this->assertEquals('1', $bkm[0]['pub']);
        $this->assertEquals('', $bkm[0]['tags']);
        $this->assertEquals(
            '1460294956',
            $bkm[0]['time']
        );
        $this->assertEquals(
            'Recently saved',
            $bkm[0]['title']
        );
        $this->assertEquals(
            'place:folder=BOOKMARKS_MENU&folder=UNFILED_BOOKMARKS&folder=TOOLBAR'
           .'&queryType=1&sort=12&maxResults=10&excludeQueries=1',
            $bkm[0]['uri']
        );

        $this->assertEquals('', $bkm[0]['note']);
        $this->assertEquals('1', $bkm[0]['pub']);
        $this->assertEquals('', $bkm[0]['tags']);
        $this->assertEquals(
            '1460294956',
            $bkm[1]['time']
        );
        $this->assertEquals(
            'Recent tags',
            $bkm[1]['title']
        );
        $this->assertEquals(
            'place:type=6&sort=14&maxResults=10',
            $bkm[1]['uri']
        );

        $this->assertEquals(
            'netscape-bookmark-parser - a php script (function) to parse netscape'
           .' format bookmark files',
            $bkm[2]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[2]['pub']
        );
        $this->assertEquals(
            'github php netscape parser',
            $bkm[2]['tags']
        );
        $this->assertEquals(
            '1463686279',
            $bkm[2]['time']
        );
        $this->assertEquals(
            'kafene/netscape-bookmark-parser: a php script (function) to parse'
           .' netscape format bookmark files',
            $bkm[2]['title']
        );
        $this->assertEquals(
            'https://github.com/kafene/netscape-bookmark-parser',
            $bkm[2]['uri']
        );

        $this->assertEquals('', $bkm[3]['note']);
        $this->assertEquals('1', $bkm[3]['pub']);
        $this->assertEquals(
            'lua script cpp dev',
            $bkm[3]['tags']
        );
        $this->assertEquals(
            '1463686379',
            $bkm[3]['time']
        );
        $this->assertEquals(
            'Programming in Lua',
            $bkm[3]['title']
        );
        $this->assertEquals(
            'http://www.lua.org/pil/',
            $bkm[3]['uri']
        );

        $this->assertEquals('', $bkm[4]['note']);
        $this->assertEquals('1', $bkm[4]['pub']);
        $this->assertEquals(
            'php security best-practices dev web',
            $bkm[4]['tags']
        );
        $this->assertEquals(
            '1463686400',
            $bkm[4]['time']
        );
        $this->assertEquals(
            'Survive The Deep End: PHP Security — Survive The Deep End:'
           .' PHP Security :: v1.0a1',
            $bkm[4]['title']
        );
        $this->assertEquals(
            'http://phpsecurity.readthedocs.io/en/latest/index.html',
            $bkm[4]['uri']
        );

        $this->assertEquals(
            'The blog relating the daily life of web agency developers',
            $bkm[5]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[5]['pub']
        );
        $this->assertEquals(
            'webcomic commit code review dev',
            $bkm[5]['tags']
        );
        $this->assertEquals(
            '1463686493',
            $bkm[5]['time']
        );
        $this->assertEquals(
            'True story: one code review too many | CommitStrip',
            $bkm[5]['title']
        );
        $this->assertEquals(
            'http://www.commitstrip.com/en/2016/02/10/true-story-one-code-review-too-many/',
            $bkm[5]['uri']
        );

        $this->assertEquals(
            'If running a Meetup feels like a full-time job, you&#39;re probably'
           .' doing it wrong. Volunteering is important and you can make it work'
           .' with some smart maneuvering.',
            $bkm[6]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[6]['pub']
        );
        $this->assertEquals(
            'meetup presentation event community',
            $bkm[6]['tags']
        );
        $this->assertEquals(
            '1463686521',
            $bkm[6]['time']
        );
        $this->assertEquals(
            'How to run a meetup without giving up your life',
            $bkm[6]['title']
        );
        $this->assertEquals(
            'http://whistlestudios.com/2016/03/how-to-run-a-meetup-without-giving-up-your-life/',
            $bkm[6]['uri']
        );

        $this->assertEquals(
            'Let’s play a game. I’ll show you a picture and a couple videos'
           .'—just watch the first five seconds or so—and you figure out&amp;#8230;',
            $bkm[7]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[7]['pub']
        );
        $this->assertEquals(
            'teapot 418 computer graphics image sythesis',
            $bkm[7]['tags']
        );
        $this->assertEquals(
            '1463686613',
            $bkm[7]['time']
        );
        $this->assertEquals(
            'The Most Important Object In Computer Graphics History Is This Teapot'
           .' - Facts So Romantic - Nautilus',
            $bkm[7]['title']
        );
        $this->assertEquals(
            'http://nautil.us/blog/the-most-important-object-in-computer-graphics'
           .'-history-is-this-teapot',
            $bkm[7]['uri']
        );

        $this->assertEquals(
            'wincompose - Compose Key for Windows',
            $bkm[8]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[8]['pub']
        );
        $this->assertEquals(
            'github windows compose character keyboard input',
            $bkm[8]['tags']
        );
        $this->assertEquals(
            '1463686711',
            $bkm[8]['time']
        );
        $this->assertEquals(
            'samhocevar/wincompose: Compose Key for Windows',
            $bkm[8]['title']
        );
        $this->assertEquals(
            'https://github.com/samhocevar/wincompose',
            $bkm[8]['uri']
        );

        $this->assertEquals(
            'A friendly introduction to the Mercurial DVCS by Joel Spolsky',
            $bkm[9]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[9]['pub']
        );
        $this->assertEquals(
            'hg mercurial version control scm python tutorial',
            $bkm[9]['tags']
        );
        $this->assertEquals(
            '1463686747',
            $bkm[9]['time']
        );
        $this->assertEquals(
            'Hg Init: a Mercurial tutorial by Joel Spolsky',
            $bkm[9]['title']
        );
        $this->assertEquals(
            'http://hginit.com/',
            $bkm[9]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[10]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[10]['pub']
        );
        $this->assertEquals(
            'emacs editor django pony python mode',
            $bkm[10]['tags']
        );
        $this->assertEquals(
            '1463686825',
            $bkm[10]['time']
        );
        $this->assertEquals(
            'Announcing Pony Mode – a Django editing mode for Emacs « Deadpan Sincerity',
            $bkm[10]['title']
        );
        $this->assertEquals(
            'http://blog.deadpansincerity.com/2011/05/announcing-pony-mode-a-django'
            .'-editing-mode-for-emacs/',
            $bkm[10]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[11]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[11]['pub']
        );
        $this->assertEquals(
            'sysadmin test unix linux network security',
            $bkm[11]['tags']
        );
        $this->assertEquals(
            '1463686863',
            $bkm[11]['time']
        );
        $this->assertEquals(
            'Sysadmin Purity Test',
            $bkm[11]['title']
        );
        $this->assertEquals(
            'http://www.bofh.net/sl_Purity.html',
            $bkm[11]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[12]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[12]['pub']
        );
        $this->assertEquals(
            'tolkien lord rings elves timeline graphics genealogy fantasy',
            $bkm[12]['tags']
        );
        $this->assertEquals(
            '1463686918',
            $bkm[12]['time']
        );
        $this->assertEquals(
            'Timeline of the Elves in Tolkien’s works | LotrProject Blog',
            $bkm[12]['title']
        );
        $this->assertEquals(
            'http://lotrproject.com/blog/2013/02/08/timeline-of-the-elves-in-tolkiens-works/',
            $bkm[12]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[13]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[13]['pub']
        );
        $this->assertEquals(
            'xkcd webcomic slope respect',
            $bkm[13]['tags']
        );
        $this->assertEquals(
            '1463687035',
            $bkm[13]['time']
        );
        $this->assertEquals(
            'xkcd: Slippery Slope',
            $bkm[13]['title']
        );
        $this->assertEquals(
            'http://xkcd.com/1332/',
            $bkm[13]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[14]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[14]['pub']
        );
        $this->assertEquals(
            'minecraft game indie pig wtf',
            $bkm[14]['tags']
        );
        $this->assertEquals(
            '1463687183',
            $bkm[14]['time']
        );
        $this->assertEquals(
            'minecraft - Is it dangerous to go extreme pig riding in a thunderstorm? - Arqade',
            $bkm[14]['title']
        );
        $this->assertEquals(
            'http://gaming.stackexchange.com/questions/21261/is-it-dangerous-to-go-extreme'
           .'-pig-riding-in-a-thunderstorm',
            $bkm[14]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[15]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[15]['pub']
        );
        $this->assertEquals(
            'question faq bug report dev support',
            $bkm[15]['tags']
        );
        $this->assertEquals(
            '1463687293',
            $bkm[15]['time']
        );
        $this->assertEquals(
            'How To Ask Questions The Smart Way',
            $bkm[15]['title']
        );
        $this->assertEquals(
            'http://catb.org/~esr/faqs/smart-questions.html',
            $bkm[15]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[16]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[16]['pub']
        );
        $this->assertEquals(
            'dev wikiwikiweb deadline rush',
            $bkm[16]['tags']
        );
        $this->assertEquals(
            '1463687380',
            $bkm[16]['time']
        );
        $this->assertEquals(
            'Heroic Programming',
            $bkm[16]['title']
        );
        $this->assertEquals(
            'http://c2.com/cgi/wiki?HeroicProgramming',
            $bkm[16]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[17]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[17]['pub']
        );
        $this->assertEquals(
            'chocolate research wtf statistics nobel',
            $bkm[17]['tags']
        );
        $this->assertEquals(
            '1463687466',
            $bkm[17]['time']
        );
        $this->assertEquals(
            'Chocolate Consumption, Cognitive Function, and Nobel Laureates'
           .' - Chocolate consumption cognitive function and nobel laurates'
           .' (NEJM).pdf',
            $bkm[17]['title']
        );
        $this->assertEquals(
            'http://www.biostat.jhsph.edu/courses/bio621/misc/Chocolate%20'
            .'consumption%20cognitive%20function%20and%20nobel'
           .'%20laurates%20%28NEJM%29.pdf',
            $bkm[17]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[18]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[18]['pub']
        );
        $this->assertEquals(
            'statistics best-practices donot data analysis',
            $bkm[18]['tags']
        );
        $this->assertEquals(
            '1463687501',
            $bkm[18]['time']
        );
        $this->assertEquals(
            'Welcome — Statistics Done Wrong',
            $bkm[18]['title']
        );
        $this->assertEquals(
            'http://www.statisticsdonewrong.com/',
            $bkm[18]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[19]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[19]['pub']
        );
        $this->assertEquals(
            'garfield markov language parody comic',
            $bkm[19]['tags']
        );
        $this->assertEquals(
            '1463687585',
            $bkm[19]['time']
        );
        $this->assertEquals(
            'Garkov -- Garfield + Markov chains -- Josh Millard',
            $bkm[19]['title']
        );
        $this->assertEquals(
            'http://joshmillard.com/garkov/',
            $bkm[19]['uri']
        );

        $this->assertEquals(
            'Opt out of global data surveillance programs like PRISM, XKeyscore'
           .' and Tempora. Help make mass surveillance of entire populations'
           .' uneconomical! We all have a right to privacy, which you can exercise'
           .' today by encrypting your communications and ending your reliance'
           .' on proprietary services.',
            $bkm[20]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[20]['pub']
        );
        $this->assertEquals(
            'prism break privacy self-hosted web service',
            $bkm[20]['tags']
        );
        $this->assertEquals(
            '1463687628',
            $bkm[20]['time']
        );
        $this->assertEquals(
            'Opt out of global data surveillance programs like PRISM, XKeyscore,'
           .' and Tempora - PRISM Break - PRISM Break',
            $bkm[20]['title']
        );
        $this->assertEquals(
            'https://prism-break.org/en/',
            $bkm[20]['uri']
        );

        $this->assertEquals(
            'Fractal Flowchart - Spiked Math Comic - A daily math webcomic'
            .' meant to entertain and humor the geek in you...',
            $bkm[21]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[21]['pub']
        );
        $this->assertEquals(
            'math fractal flowchart chart',
            $bkm[21]['tags']
        );
        $this->assertEquals(
            '1463687722',
            $bkm[21]['time']
        );
        $this->assertEquals(
            'Fractal Flowchart - Spiked Math',
            $bkm[21]['title']
        );
        $this->assertEquals(
            'http://spikedmath.com/570.html',
            $bkm[21]['uri']
        );

        $this->assertEquals('', $bkm[23]['note']);
        $this->assertEquals('1', $bkm[23]['pub']);
        $this->assertEquals('', $bkm[23]['tags']);
        $this->assertEquals(
            '1460294956',
            $bkm[22]['time']
        );
        $this->assertEquals(
            'Most visited',
            $bkm[22]['title']
        );
        $this->assertEquals(
            'place:sort=8&maxResults=10',
            $bkm[22]['uri']
        );

        $this->assertEquals('', $bkm[23]['note']);
        $this->assertEquals('1', $bkm[23]['pub']);
        $this->assertEquals('', $bkm[23]['tags']);
        $this->assertEquals(
            '1460294956',
            $bkm[23]['time']
        );
        $this->assertEquals(
            'Getting Started',
            $bkm[23]['title']
        );
        $this->assertEquals(
            'https://www.mozilla.org/en-US/firefox/central/',
            $bkm[23]['uri']
        );
    }

    /**
     * Parse nested Firefox bookmarks (directories and subdirectories)
     */
    public function testParseNested()
    {
        $parser = new NetscapeBookmarkParser(true, null, '1');
        $bkm = $parser->parseFile('tests/input/firefox_nested.htm');
        $this->assertEquals(24, sizeof($bkm));

        $this->assertEquals('', $bkm[0]['note']);
        $this->assertEquals('1', $bkm[0]['pub']);
        $this->assertEquals('', $bkm[0]['tags']);
        $this->assertEquals(
            '1460294956',
            $bkm[0]['time']
        );
        $this->assertEquals(
            'Recently saved',
            $bkm[0]['title']
        );
        $this->assertEquals(
            'place:folder=BOOKMARKS_MENU&folder=UNFILED_BOOKMARKS&folder=TOOLBAR'
           .'&queryType=1&sort=12&maxResults=10&excludeQueries=1',
            $bkm[0]['uri']
        );

        $this->assertEquals('', $bkm[0]['note']);
        $this->assertEquals('1', $bkm[0]['pub']);
        $this->assertEquals('', $bkm[0]['tags']);
        $this->assertEquals(
            '1460294956',
            $bkm[1]['time']
        );
        $this->assertEquals(
            'Recent tags',
            $bkm[1]['title']
        );
        $this->assertEquals(
            'place:type=6&sort=14&maxResults=10',
            $bkm[1]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[2]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[2]['pub']
        );
        $this->assertEquals(
            'tolkien lord rings elves timeline graphics genealogy fantasy',
            $bkm[2]['tags']
        );
        $this->assertEquals(
            '1463686918',
            $bkm[2]['time']
        );
        $this->assertEquals(
            'Timeline of the Elves in Tolkien’s works | LotrProject Blog',
            $bkm[2]['title']
        );
        $this->assertEquals(
            'http://lotrproject.com/blog/2013/02/08/timeline-of-the-elves-in-tolkiens-works/',
            $bkm[2]['uri']
        );

        $this->assertEquals(
            'The blog relating the daily life of web agency developers',
            $bkm[3]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[3]['pub']
        );
        $this->assertEquals(
            'comics webcomic commit code review dev',
            $bkm[3]['tags']
        );
        $this->assertEquals(
            '1463686493',
            $bkm[3]['time']
        );
        $this->assertEquals(
            'True story: one code review too many | CommitStrip',
            $bkm[3]['title']
        );
        $this->assertEquals(
            'http://www.commitstrip.com/en/2016/02/10/true-story-one-code-review-too-many/',
            $bkm[3]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[4]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[4]['pub']
        );
        $this->assertEquals(
            'comics xkcd webcomic slope respect',
            $bkm[4]['tags']
        );
        $this->assertEquals(
            '1463687035',
            $bkm[4]['time']
        );
        $this->assertEquals(
            'xkcd: Slippery Slope',
            $bkm[4]['title']
        );
        $this->assertEquals(
            'http://xkcd.com/1332/',
            $bkm[4]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[5]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[5]['pub']
        );
        $this->assertEquals(
            'comics garfield markov language parody comic',
            $bkm[5]['tags']
        );
        $this->assertEquals(
            '1463687585',
            $bkm[5]['time']
        );
        $this->assertEquals(
            'Garkov -- Garfield + Markov chains -- Josh Millard',
            $bkm[5]['title']
        );
        $this->assertEquals(
            'http://joshmillard.com/garkov/',
            $bkm[5]['uri']
        );

        $this->assertEquals(
            'Fractal Flowchart - Spiked Math Comic - A daily math webcomic'
            .' meant to entertain and humor the geek in you...',
            $bkm[6]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[6]['pub']
        );
        $this->assertEquals(
            'comics math fractal flowchart chart',
            $bkm[6]['tags']
        );
        $this->assertEquals(
            '1463687722',
            $bkm[6]['time']
        );
        $this->assertEquals(
            'Fractal Flowchart - Spiked Math',
            $bkm[6]['title']
        );
        $this->assertEquals(
            'http://spikedmath.com/570.html',
            $bkm[6]['uri']
        );

        $this->assertEquals('', $bkm[7]['note']);
        $this->assertEquals('1', $bkm[7]['pub']);
        $this->assertEquals(
            'dev lua script cpp dev',
            $bkm[7]['tags']
        );
        $this->assertEquals(
            '1463686379',
            $bkm[7]['time']
        );
        $this->assertEquals(
            'Programming in Lua',
            $bkm[7]['title']
        );
        $this->assertEquals(
            'http://www.lua.org/pil/',
            $bkm[7]['uri']
        );

        $this->assertEquals(
            'Let’s play a game. I’ll show you a picture and a couple videos'
           .'—just watch the first five seconds or so—and you figure out&amp;#8230;',
            $bkm[8]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[8]['pub']
        );
        $this->assertEquals(
            'dev teapot 418 computer graphics image sythesis',
            $bkm[8]['tags']
        );
        $this->assertEquals(
            '1463686613',
            $bkm[8]['time']
        );
        $this->assertEquals(
            'The Most Important Object In Computer Graphics History Is This Teapot'
           .' - Facts So Romantic - Nautilus',
            $bkm[8]['title']
        );
        $this->assertEquals(
            'http://nautil.us/blog/the-most-important-object-in-computer-graphics'
           .'-history-is-this-teapot',
            $bkm[8]['uri']
        );

        $this->assertEquals(
            'A friendly introduction to the Mercurial DVCS by Joel Spolsky',
            $bkm[9]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[9]['pub']
        );
        $this->assertEquals(
            'dev hg mercurial version control scm python tutorial',
            $bkm[9]['tags']
        );
        $this->assertEquals(
            '1463686747',
            $bkm[9]['time']
        );
        $this->assertEquals(
            'Hg Init: a Mercurial tutorial by Joel Spolsky',
            $bkm[9]['title']
        );
        $this->assertEquals(
            'http://hginit.com/',
            $bkm[9]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[10]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[10]['pub']
        );
        $this->assertEquals(
            'dev emacs editor django pony python mode',
            $bkm[10]['tags']
        );
        $this->assertEquals(
            '1463686825',
            $bkm[10]['time']
        );
        $this->assertEquals(
            'Announcing Pony Mode – a Django editing mode for Emacs « Deadpan Sincerity',
            $bkm[10]['title']
        );
        $this->assertEquals(
            'http://blog.deadpansincerity.com/2011/05/announcing-pony-mode-a-django'
            .'-editing-mode-for-emacs/',
            $bkm[10]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[11]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[11]['pub']
        );
        $this->assertEquals(
            'dev wikiwikiweb deadline rush',
            $bkm[11]['tags']
        );
        $this->assertEquals(
            '1463687380',
            $bkm[11]['time']
        );
        $this->assertEquals(
            'Heroic Programming',
            $bkm[11]['title']
        );
        $this->assertEquals(
            'http://c2.com/cgi/wiki?HeroicProgramming',
            $bkm[11]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[12]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[12]['pub']
        );
        $this->assertEquals(
            'dev statistics best-practices donot data analysis',
            $bkm[12]['tags']
        );
        $this->assertEquals(
            '1463687501',
            $bkm[12]['time']
        );
        $this->assertEquals(
            'Welcome — Statistics Done Wrong',
            $bkm[12]['title']
        );
        $this->assertEquals(
            'http://www.statisticsdonewrong.com/',
            $bkm[12]['uri']
        );

        $this->assertEquals(
            'netscape-bookmark-parser - a php script (function) to parse netscape'
           .' format bookmark files',
            $bkm[13]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[13]['pub']
        );
        $this->assertEquals(
            'dev php github netscape parser',
            $bkm[13]['tags']
        );
        $this->assertEquals(
            '1463686279',
            $bkm[13]['time']
        );
        $this->assertEquals(
            'kafene/netscape-bookmark-parser: a php script (function) to parse'
           .' netscape format bookmark files',
            $bkm[13]['title']
        );
        $this->assertEquals(
            'https://github.com/kafene/netscape-bookmark-parser',
            $bkm[13]['uri']
        );

        $this->assertEquals('', $bkm[14]['note']);
        $this->assertEquals('1', $bkm[14]['pub']);
        $this->assertEquals(
            'dev php security best-practices web',
            $bkm[14]['tags']
        );
        $this->assertEquals(
            '1463686400',
            $bkm[14]['time']
        );
        $this->assertEquals(
            'Survive The Deep End: PHP Security — Survive The Deep End:'
           .' PHP Security :: v1.0a1',
            $bkm[14]['title']
        );
        $this->assertEquals(
            'http://phpsecurity.readthedocs.io/en/latest/index.html',
            $bkm[14]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[15]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[15]['pub']
        );
        $this->assertEquals(
            'dev chocolate research wtf statistics nobel',
            $bkm[15]['tags']
        );
        $this->assertEquals(
            '1463687466',
            $bkm[15]['time']
        );
        $this->assertEquals(
            'Chocolate Consumption, Cognitive Function, and Nobel Laureates'
           .' - Chocolate consumption cognitive function and nobel laurates'
           .' (NEJM).pdf',
            $bkm[15]['title']
        );
        $this->assertEquals(
            'http://www.biostat.jhsph.edu/courses/bio621/misc/Chocolate%20'
            .'consumption%20cognitive%20function%20and%20nobel'
           .'%20laurates%20%28NEJM%29.pdf',
            $bkm[15]['uri']
        );

        $this->assertEquals(
            'If running a Meetup feels like a full-time job, you&#39;re probably'
           .' doing it wrong. Volunteering is important and you can make it work'
           .' with some smart maneuvering.',
            $bkm[16]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[16]['pub']
        );
        $this->assertEquals(
            'floss meetup presentation event community',
            $bkm[16]['tags']
        );
        $this->assertEquals(
            '1463686521',
            $bkm[16]['time']
        );
        $this->assertEquals(
            'How to run a meetup without giving up your life',
            $bkm[16]['title']
        );
        $this->assertEquals(
            'http://whistlestudios.com/2016/03/how-to-run-a-meetup-without-giving-up-your-life/',
            $bkm[16]['uri']
        );

        $this->assertEquals(
            'wincompose - Compose Key for Windows',
            $bkm[17]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[17]['pub']
        );
        $this->assertEquals(
            'floss github windows compose character keyboard input',
            $bkm[17]['tags']
        );
        $this->assertEquals(
            '1463686711',
            $bkm[17]['time']
        );
        $this->assertEquals(
            'samhocevar/wincompose: Compose Key for Windows',
            $bkm[17]['title']
        );
        $this->assertEquals(
            'https://github.com/samhocevar/wincompose',
            $bkm[17]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[18]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[18]['pub']
        );
        $this->assertEquals(
            'floss sysadmin test unix linux network security',
            $bkm[18]['tags']
        );
        $this->assertEquals(
            '1463686863',
            $bkm[18]['time']
        );
        $this->assertEquals(
            'Sysadmin Purity Test',
            $bkm[18]['title']
        );
        $this->assertEquals(
            'http://www.bofh.net/sl_Purity.html',
            $bkm[18]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[19]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[19]['pub']
        );
        $this->assertEquals(
            'floss question faq bug report dev support',
            $bkm[19]['tags']
        );
        $this->assertEquals(
            '1463687293',
            $bkm[19]['time']
        );
        $this->assertEquals(
            'How To Ask Questions The Smart Way',
            $bkm[19]['title']
        );
        $this->assertEquals(
            'http://catb.org/~esr/faqs/smart-questions.html',
            $bkm[19]['uri']
        );

        $this->assertEquals(
            'Opt out of global data surveillance programs like PRISM, XKeyscore'
           .' and Tempora. Help make mass surveillance of entire populations'
           .' uneconomical! We all have a right to privacy, which you can exercise'
           .' today by encrypting your communications and ending your reliance'
           .' on proprietary services.',
            $bkm[20]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[20]['pub']
        );
        $this->assertEquals(
            'floss prism break privacy self-hosted web service',
            $bkm[20]['tags']
        );
        $this->assertEquals(
            '1463687628',
            $bkm[20]['time']
        );
        $this->assertEquals(
            'Opt out of global data surveillance programs like PRISM, XKeyscore,'
           .' and Tempora - PRISM Break - PRISM Break',
            $bkm[20]['title']
        );
        $this->assertEquals(
            'https://prism-break.org/en/',
            $bkm[20]['uri']
        );

        $this->assertEquals(
            '',
            $bkm[21]['note']
        );
        $this->assertEquals(
            '1',
            $bkm[21]['pub']
        );
        $this->assertEquals(
            'games minecraft game indie pig wtf',
            $bkm[21]['tags']
        );
        $this->assertEquals(
            '1463687183',
            $bkm[21]['time']
        );
        $this->assertEquals(
            'minecraft - Is it dangerous to go extreme pig riding in a thunderstorm? - Arqade',
            $bkm[21]['title']
        );
        $this->assertEquals(
            'http://gaming.stackexchange.com/questions/21261/is-it-dangerous-to-go-extreme'
           .'-pig-riding-in-a-thunderstorm',
            $bkm[21]['uri']
        );

        $this->assertEquals('', $bkm[22]['note']);
        $this->assertEquals('1', $bkm[22]['pub']);
        $this->assertEquals(
            'personal toolbar',
            $bkm[22]['tags']
        );
        $this->assertEquals(
            '1460294956',
            $bkm[22]['time']
        );
        $this->assertEquals(
            'Most visited',
            $bkm[22]['title']
        );
        $this->assertEquals(
            'place:sort=8&maxResults=10',
            $bkm[22]['uri']
        );

        $this->assertEquals('', $bkm[23]['note']);
        $this->assertEquals('1', $bkm[23]['pub']);
        $this->assertEquals(
            'personal toolbar',
            $bkm[23]['tags']
        );
        $this->assertEquals(
            '1460294956',
            $bkm[23]['time']
        );
        $this->assertEquals(
            'Getting Started',
            $bkm[23]['title']
        );
        $this->assertEquals(
            'https://www.mozilla.org/en-US/firefox/central/',
            $bkm[23]['uri']
        );
    }
}
