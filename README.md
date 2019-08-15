# Historical Reports

[![Run Status](https://api.shippable.com/projects/5d53694131101c00068c1561/badge?branch=master)]()

This is a php project to create a historical report platform using phpmyAdmin and docker (Docker is required)

## Step by Step set up

- Install docker in the server where you will be running this app
- Pull docker images for myphp and mysql
- start Docker container for mySQL version 5.7, with generic root host and root as password

`docker run --name mySql1 -e MYSQL_ROOT_HOST=% -e MYSQL_ROOT_PASSWORD=root -d mysql/mysql-server:5.7`

- Start Docker for historical reports

`docker run --name myadmin -d --link mySql1:db -p 80:80 morsisdivine/cucurbitaceae`

- log into phpmyadmin and create user `report` and `yumyum` -> this can be updated later
- `docker exec -it db-container mysql -u root -p` password `root` then enter the below sql command
  
```sql
GRANT ALL PRIVILEGES ON *.* TO 'report'@'%' IDENTIFIED BY 'yumyum';
```

- Run this endpoint to create the relevant table `http://localhost/create_script.php`

## Move to API test (newman)

- Go to the `./reports/test` folder and run Chimp locally -> refer on how to install chimpt at [Chimp](https://chimp.readme.io/)
- Update all of the IPs on the code so this can be run externally

## PAGES

- `http://localhost/reports/` all plus latest 10|50|100
- `http://localhost/reports/testing.php` paginated page testing page
- `http://localhost/reports/refinetag.php?tag=tag` list of tags
- `http://localhost/reports/refinename.php?name=Test_pagination_92` list of test by name
- `http://localhost/historical_report/creation_script.php` create DB and table using user `report` and psw `yumyum` manually created
- `http://localhost/reports/cleanup.php` clears the table, (not drop)
- `http://localhost/reports/insert.php?id=FOODqwerty1&name=alejandrogrid&status=1&agent=1&domain=AWW&tags=` inserts a record
- Pie Chart report at `http://localhost/reports/graphs/pi3d.html`

## POST MVP

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
- Creat Config page

### Completed

- [x] how to connect containers when created as the IP can be dinamyc and localhost is not working
-- Use `-e MYSQL_ROOT_HOST=%` during creation of mySql server docker container
-- Create `report` user with access to `%` Hosts
- [x] move docker image creation to dockerfile
- [x] move all connection details to the utils folder `creation_script.php` is hard coded

## Current local notes

- I can ssh to the box `docker exec -it CONTAINER_ID /bin/sh`
  