function randomValue(){
    return Date.now();
}
var world = require('../world');
var randomId = randomValue();

module.exports = function() {

    this.Given(/^I navigate to my dashboard$/, function () {
        browser.url(world.Urls.home_page+"index.php");
        expect(browser.getText('h1')).toEqual("Historical Execution Report");
    });

    this.Then(/^I can see a table with the historical results$/, function () {
        console.log(browser.getAttribute('#report_table', 'id'));
    });

    this.When(/^I review the content of my table$/, function () {
        console.log(browser.getText("#report_table th"));
    });

    this.Then(/^I can see the below fields$/, function (table) {
        var rows = table.raw();
        console.log(rows);
        expect(rows).toContain(browser.getText("#report_table th"));
    });

    this.Given(/^The test execution is completed with the below results$/, function (table) {
        var rows = table.hashes();
        for (var i = 0; i < rows.length; ++i) {
            var row = rows[i];
            browser.url(world.Urls.home_page+"insert.php?id="+
                randomId+i+"&name="+row['TEST_NAME']+"&status="+
                row['STATUS']+"&agent="+row['AGENT']+
                "&domain="+row['DOMAIN']+"&tags="+row['TAGS']);
            expect(browser.isExisting("#db_error")).not.toEqual("false");
        }
    });

    this.Then(/^I can see the result at the top of the table$/, function (table) {
        console.log("looking for id ::: "+randomId);

        var reporttable = browser.element("#report_table");
        var rows = table.hashes();

        for (var i = 0; i < rows.length; ++i) {
            var row = rows[i];
            console.log(randomId + i +":"+ row['TEST_NAME'] +":"+ row['STATUS'] +":"+ row['AGENT']+":"+ row['DOMAIN']+":"+ row['TAGS']) ;
            reporttable.getText("td="+randomId+i);
            reporttable.getText("td="+row['TEST_NAME']);
            reporttable.getText("td="+row['STATUS']);
            reporttable.getText("td="+row['AGENT']);
            reporttable.getText("td="+row['DOMAIN']);
            reporttable.getText("td="+row['TAGS']);
        }
    });

    this.Then(/^The test execution is completed with duplicate results$/, function (table) {

        var rows = table.hashes();
        for (var i = 0; i < rows.length; ++i) {
            var row = rows[i];
            browser.url(world.Urls.home_page+"insert.php?id="+
                randomId+"&name="+row['TEST_NAME']+"&status="+
                row['STATUS']+"&tags="+row['TAGS']);
        }
    });

    this.Then(/^I will be presented with the Message "([^"]*)"$/, function (errMsg) {
        expect(browser.getText("#sql_err")).toContain(errMsg);
    });

    this.When(/^I navigate to my status count page$/, function () {
        browser.url(world.Urls.home_page+"utils/status_count.php");
    });

    this.Then(/^I can see the status (\d+) is (\d+) and status (\d+) is (\d+)$/, function (fstatus, fvalue, sstatus, svalue) {
        var jsonCall = browser.getText("body");
        var results = JSON.parse(jsonCall);
        expect(results[fstatus]["count(status)"]).toEqual(fvalue);
        expect(results[sstatus]["count(status)"]).toEqual(svalue);
    });

    this.Then(/^I can refine my report base on "([^"]*)" tag$/, function (tagName) {
        browser.click('a='+tagName);
        browser.waitForExist("h1#titleID",2000);
        expect(browser.getText("h1#titleID")).toMatch("Report Refined by "+tagName)
    });

    this.Then(/^I can refine my report base on "([^"]*)" scenario name$/, function (scenarioName) {
        browser.click('a='+scenarioName);
        browser.waitForExist("h1#titleID",10000);
        expect(browser.getText("h1#titleID")).toMatch("Report Refined by "+scenarioName)
    });

    this.Then(/^I can go back to the Dashboard using the "([^"]*)" link$/, function (link) {
        browser.click("label");
        browser.click("a="+link);
        expect(browser.getUrl()).toEqual(world.Urls.home_page);
    });

    this.Then(/^I can see there are (\d+) records on the table$/, function (counter) {
        var rows = ((browser.elements("tr").getValue().length)-1);
        expect(rows.toString()).toEqual(counter);
    });


};