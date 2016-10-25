# historical_report

This is a php project to create a cucumber historical report platform (Docker is required)


# Step by Step set up
- Install docker in the server where you will be running this app
- Pull docker images for myphp and mysql
- start Docker containers
    * `docker run --name my-container-name -e MYSQL_ROOT_PASSWORD=root -d mysql/mysql-server`
    * `docker run --name myadmin -d --link my-container-name:db -p 80:80 morsisdivine/cucumber-historical-reports:1`
- log into phpmyadmin adn create user `report` and psw `yumyum` -> this can be updated later
- Update the IP address in the `utils\sql_connect.php` file so it can connect to the mysql docker container


BELOW is no longer required as we now have a docker image with the below steps
- pull a copy of this repo and copy in the myphpadmin image using `docker cp historical_report CONTAINER_ID:/www/historical_report`
    - user must be in the folder where the repo is downloaded or provide the path after the command `cp`
- Create DB `testreport` and table `food` -> this can be updated later
    - this can be completed by running `http://localhost:8080/historical_report/create_script.php`
     - this will create the DB and table
- Update the IP address in the `utils\sql_connect.php` file so it can connect to the mysql docker container
    - I can ssh to the box using `docker exec -it CONTAINER_ID /bin/sh`
    - I can get the `CONTAINER_ID` running `docker ps -a`
- Go to the `./reports/test` folder and run Chimp locally -> refer on how to install chimpt at https://chimp.readme.io/
- Update all of the IPs on the code so this can be run externally

#PAGES
- `http://localhost:8080/historical_report/reports/` all plus latest 10|50|100 
- `http://localhost:8080/historical_report/reports/testing.php` paginated page
- `http://localhost:8080/historical_report/reports/refinetag.php?tag=tag` list of tags
- `http://localhost:8080/historical_report/reports/refinename.php?name=Test_pagination_92` list of test by name
- `http://localhost:8080/historical_report/creation_script.php` create DB and table usgin user `report` and psw `yumyum` manually created

# TODO
- Create Docker file so the tool can be run in a docker container
    * myphpadmin container - DONE not integrated
    * user is able to run the PHP page on the phpmyadmin docker
    * Possibility to host the graphs on a separate server using - TO investigate
- step up instructions
- Pagination for the dashboard
    * show top 10|50|100
- Pull code to generate headers into a utils file    
- Automatic build of the service

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
    - You must use the IP of the docker container `docker inspect CONTAINER_ID`
    - After copy of the content on the docker container for phpmyadmin the only broken feature is the graph
    
