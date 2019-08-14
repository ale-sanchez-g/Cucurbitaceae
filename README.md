# Historical Reports

This is a php project to create a historical report platform using phpmyAdmin and docker (Docker is required)

## Step by Step set up

- Install docker in the server where you will be running this app
- Pull docker images for myphp and mysql
- start Docker container for mySQL version 5.7, with generic root host and root as password

`docker run --name mySql1 -e MYSQL_ROOT_HOST=% -e MYSQL_ROOT_PASSWORD=root -d mysql/mysql-server:5.7`

- Start Docker for historical reports

`docker run --name myadmin -d --link mySql1:db -p 80:80 morsisdivine/cucumber-historical-reports`

- log into phpmyadmin and create user `report` and `yumyum` -> this can be updated later
  
```sql
GRANT ALL PRIVILEGES ON *.* TO 'report'@'%' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON `report\_%`.* TO 'report'@'%';
```

- Update the IP address in the below files so it can connect to the mysql docker container
`.\reports\utils\sql_connect.php`
`.\creation_script.php`

BELOW is no longer required as we now have a docker image with the below steps

- pull a copy of this repo and copy in the myphpadmin image using `docker cp historical_report CONTAINER_ID:/www/historical_report` -> need to create a `dockerfile`
-- user must be in the folder where the repo is downloaded or provide the path after the command `cp`
- Create DB `testreport` and table `food` -> this can be updated later
-- this can be completed by running `http://localhost:8080/historical_report/create_script.php`
-- this will create the DB and table
- Update the IP address in the `utils\sql_connect.php` file so it can connect to the mysql docker container
-- I can ssh to the box using `docker exec -it CONTAINER_ID /bin/sh` or `docker exec -it CONTAINER_NAME /bin/sh`
-- I can get the `CONTAINER_ID` running `docker ps -a`
- Go to the `./reports/test` folder and run Chimp locally -> refer on how to install chimpt at https://chimp.readme.io/
- Update all of the IPs on the code so this can be run externally

## PAGES

- `http://localhost/historical_report/reports/` all plus latest 10|50|100
- `http://localhost/historical_report/reports/testing.php` paginated page testing page
- `http://localhost/historical_report/reports/refinetag.php?tag=tag` list of tags
- `http://localhost/historical_report/reports/refinename.php?name=Test_pagination_92` list of test by name
- `http://localhost/historical_report/creation_script.php` create DB and table using user `report` and psw `yumyum` manually created
- `http://localhost/historical_report/reports/cleanup.php` clears the table, (not drop) 
- `http://localhost/historical_report/reports/insert.php?id=FOODqwerty1&name=alejandrogrid&status=1&agent=1&domain=AWW&tags=` inserts a record

## POST MVP

- move docker image creation to dockerfile
- move all connection details to the utils folder `creation_script.php` is hard coded
- how to get report graphs
- Pagination for the dashboard
- Automatic build of the service
- Better styling of the site => `continue to review`
- Other type of reports like:
-- Most commonly failed test cases
-- Most commonly failed test tags
- Additional information like
-- Browser used
- Search by:
--  Agent
-- Domain
- Move test from Front end to API
- Move Success reponse to API

### Completed

- [x] how to connect containers when created as the IP can be dinamyc and localhost is not working
-- Use `-e MYSQL_ROOT_HOST=%` during creation of mySql server docker container
-- Create `report` user with access to `%` Hosts
  
## Current local notes

- I can run `dmyphp` from `home` using a bash file
- I can run `dclean` from `home` using a bash file
- I can set up myphpamdin with docker
- I can copy using `docker cp historical_report CONTAINER_ID:/www/historical_report`
- I can ssh to the box `docker exec -it CONTAINER_ID /bin/sh`
- You must use the IP of the docker container `docker inspect CONTAINER_ID`
- After copy of the content on the docker container for phpmyadmin the only broken feature is the graph
  