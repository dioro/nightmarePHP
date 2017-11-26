# NightmarePHP

PHP wrapper for [NightmareJS](http://www.nightmarejs.org/)

## Usage

Raw option (recommended):

    use shinoshi\nightmarePHP\nightmarePHP;
    
    $nightmare = new nightmarePHP();
    
    $nightmare->rawInput("
    const Nightmare = require(\"nightmare\");
    const nightmare = Nightmare({ show: false });

    nightmare
        .goto('https://www.reddit.com/r/news/')
        .wait('#siteTable > div:first-child .title > a')
        .evaluate(() => document.querySelector(\"#siteTable > div:first-child .title > a\").textContent)
    .end()
        .then(console.log)
        .catch((error) => {console.error('Search failed:', error);});")
        ->run();

    var_dump($nightmare->getResult()); #returns latest title of the /r/news subreddit
    
Predefined method option:

    use shinoshi\nightmarePHP\nightmarePHP;

    $nightmare = new nightmarePHP();

    $nightmare->config("show: false");

    $nightmare
    ->_goto('https://www.reddit.com/r/news/')
    ->wait('#siteTable > div:first-child .title > a')
    ->evaluate("() => document.querySelector(\"#siteTable > div:first-child .title > a\").textContent")
    ->end()
    ->then("console.log")
    ->_catch("(error) => {console.error('Search failed:', error);}")
    ->run();

    var_dump($nightmare->getResult()); #returns latest title of the /r/news subreddit
    
    
Predefined method option may not include all up to date options that NightmareJS offers to which the documentation can be found their official [github repo](https://github.com/segmentio/nightmare)
