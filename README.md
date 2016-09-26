# historical_report
This is a php project to create a report platform (XAMPP is required)

# TODO
- Create Docker file so the tool can be run in a docker container
    * myphpadmin container - DONE not integrated
    * php web server - to host the site asusing the docker myphpadmin image has PHP7 and the code is no longer valid
    OPTION - move to http://www.phpclasses.org/blog/package/9199/post/3-Smoothly-Migrate-your-PHP-Code-using-the-Old-MySQL-extension-to-MySQLi.html
- step up instructions
- Pagination for the dashboard
    * show top 10|50|100
- Pull code to generate headers into a utils file    

# POST MVP
- Header module
- Better styling of the site
- Other type of reports like:
    * Most commonly failed test cases
    * Most commonly failed test tags
- Additional information like
    * Browser used
- Search by:
    * Tags
    * Test Case name
    
# Current local notes
    - I can run `dmyphp` from `home`
    - I can run `dclean` from `home`
    - I can set up myphpamdin with docker
    - I can copy using `docker cp historical_report CONTAINER_ID:/www/historical_report`
    - I can ssh to the box `docker exec -it CONTAINER_ID /bin/sh`