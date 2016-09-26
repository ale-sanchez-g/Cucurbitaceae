#
# Super simple example of a Dockerfile
#
FROM phpmyadmin/phpmyadmin
MAINTAINER Alejandro Sanchez Giraldo "morsisdivine@gmail.com"


ADD ./Applications/XAMPP/xamppfiles/htdocs/historical_report /usr/share/nginx/html/custom_404.html


EXPOSE 80 8080


docker run --name myadmin -d --link mysql_db_server:db -p 8080:80 phpmyadmin/phpmyadmin
