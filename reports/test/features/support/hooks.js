function randomValue(){
    return Date.now();
}


var hooks = function () {
    var world = require('./world');

    this.Before(function (scenario) {
        browser.url(world.Urls.home_page+"cleanup.php");
    });

    this.After(function (scenario) {
        var randomId = randomValue();
        var tags='';
        if (scenario.getTags().length == '1'){
            tags = scenario.getTags()[0].getName();
        } else {
            for (var i=0; i<scenario.getTags().length;i++){
                tags = scenario.getTags()[i].getName()+","+tags;
            }
            //clean tags
            tags=tags.substr(0, tags.length-1);
        }


        if (scenario.isSuccessful()) {
            browser.url(world.Urls.home_page+"insert.php?id="+randomId+"&name="+scenario.getName()+"&status=0&tags="+tags);
        } else {
            console.log("if is not Passed is FAILED");
            browser.url(world.Urls.home_page+"insert.php?id="+randomId+"&name="+scenario.getName()+"&status=1&tags="+tags);
        }
        browser.url(world.Urls.home_page);
    });
};

module.exports = hooks;


// Options for Cucumber Scenario
//getKeyword:     function getKeyword()     { return astScenario.getKeyword(); },
//getName:        function getName()        { return astScenario.getName(); },
//getDescription: function getDescription() { return astScenario.getDescription(); },
//getUri:         function getUri()         { return astScenario.getUri(); },
//getLine:        function getLine()        { return astScenario.getLine(); },
//getTags:        function getTags()        { return astScenario.getTags(); },
//isSuccessful:   function isSuccessful()   { return astTreeWalker.getScenarioStatus() === Cucumber.Status.PASSED; },
//isFailed:       function isFailed()       { return astTreeWalker.getScenarioStatus() === Cucumber.Status.FAILED; },
//isPending:      function isPending()      { return astTreeWalker.getScenarioStatus() === Cucumber.Status.PENDING; },
//isUndefined:    function isUndefined()    { return astTreeWalker.getScenarioStatus() === Cucumber.Status.UNDEFINED; },
//isSkipped:      function isSkipped()      { return astTreeWalker.getScenarioStatus() === Cucumber.Status.SKIPPED; },
//getException:   function getException()   { return astTreeWalker.getScenarioFailureException(); },
//getAttachments: function getAttachments() { return astTreeWalker.getAttachments(); },