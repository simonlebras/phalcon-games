FROM ubuntu:14.04

MAINTAINER Simon Le Bras <lebras.simon@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN echo "deb http://archive.ubuntu.com/ubuntu trusty main restricted universe" > /etc/apt/sources.list ;\
    echo "deb http://security.ubuntu.com/ubuntu trusty-security main restricted universe" >> /etc/apt/sources.list ;\
    apt-get update -q ;\
    apt-get upgrade -y -q ;\
    apt-get dist-upgrade -y -q

RUN apt-get install -y -q php5-dev php5-mcrypt php5-curl php5-pgsql php5-mysql php5-sqlite php5-mongo php5-memcached php5-xdebug php-apc php5-imagick php5-gd php5-geoip gcc git libpcre3-dev

RUN git clone --depth=1 git://github.com/phalcon/cphalcon.git /usr/local/src/cphalcon
RUN cd /usr/local/src/cphalcon/build && ./install ;\
    echo "extension=phalcon.so" > /etc/php5/mods-available/phalcon.ini ;\
    php5enmod phalcon

RUN apt-get clean

ENV DEBIAN_FRONTEND dialog

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get install -y -q apache2 libapache2-mod-php5 ;\
    a2enmod rewrite

RUN apt-get clean

ADD etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf

ENV DEBIAN_FRONTEND dialog

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_PID_FILE /var/run/apache2/apache2.pid

EXPOSE 80

ENTRYPOINT ["/usr/sbin/apache2"]
CMD ["-D", "FOREGROUND"]