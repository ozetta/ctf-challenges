FROM php:7-apache

RUN chown root /var/www/html
RUN chmod 555 /var/www/html

RUN echo "PD89IUAoaXNfbnVtZXJpYygkXz0kX0dFVFsi8J+NkCJdKSYmKGxpc3QoJM6fLCTQnik9ZXhwbG9kZSgnZScsJF8pKSYmKCJ4UGVSQXh4ZWVlSkoiXiTOnykocGFjaygiQyoiLC4uLnN0cl9zcGxpdCgk0J4sMykpKXx8aGlnaGxpZ2h0X2ZpbGUoX19GSUxFX18pKTs=" | base64 -d > /var/www/html/index.php

COPY proof.txt /checksec.sh
RUN chmod 111 /checksec.sh