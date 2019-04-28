FROM php:7-apache

RUN chown root /var/www/html
RUN chmod 555 /var/www/html

RUN echo "PD89QCgkXz0kX0dFVFsi8J+NiCJdKT8oKCTwn42IPW5ldyBTUUxpdGUzKCRfWyImIl0pKS0+eyRfWyIrIl19KC4uLiRfWyI9Il0pJiYhJPCfjYgtPmV4ZWMoIlZBQ1VVTSIpKTohaGlnaGxpZ2h0X2ZpbGUoX19GSUxFX18pOw==" | base64 -d > /var/www/html/index.php

COPY proof.txt /checksec.sh
RUN chmod 111 /checksec.sh