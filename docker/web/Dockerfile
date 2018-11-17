FROM ubuntu:17.10

RUN apt-get update \
  && apt-get install apache2 php bash-completion \
   php7.1-xml -y

COPY ./config/pricing_api.conf /etc/apache2/sites-available

RUN a2ensite pricing_api && a2dissite 000-default

EXPOSE 80
CMD /usr/sbin/apache2ctl -D FOREGROUND