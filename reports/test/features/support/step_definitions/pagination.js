function randomValue(){
    return Date.now();
}
var world = require('../world');
var randomId = randomValue();

module.exports = function() {
    this.Given(/^I have more than x "([^"]*)" of completed runs$/, function (number) {
        for (var i = -1; i < number; ++i) {
            browser.url(world.Urls.home_page+"insert.php?id="+
                randomId+i+"&name=Test pagination "+i+"&status=0&tags=@tag");
            expect(browser.isExisting("#db_error")).not.toEqual("false");
        }
    });

    this.Then(/^I can see the first "([^"]*)" records on my table$/, function (number) {
        //Clicks on the link to filter the amount of records retrieved
        browser.click("a="+number);

        //Validates the number of rows is the same as the expected number
        var rows = ((browser.elements("tr").getValue().length)-1);
        console.log(rows);
        expect(rows.toString()).toEqual(number);
    });
};
