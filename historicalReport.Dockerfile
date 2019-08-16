FROM phpmyadmin/phpmyadmin:4.8

USER root

COPY reports /var/www/html/reports