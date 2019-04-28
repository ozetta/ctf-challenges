FROM php:7-apache

RUN chown root /var/www/html
RUN chmod 555 /var/www/html

RUN echo "PD89QHByZWdfbWF0Y2goJy9eW1woXClcKlwtXC5cW1xdXF5dKyQvJywoJF89JF9HRVRbIvCfpaUiXSkpJiYhKHN0cmxlbigkXyk+PjEwKT9AZXZhbCgic2V0X2Vycm9yX2hhbmRsZXIoZnVuY3Rpb24oKXtleGl0KCk7fSk7ZXJyb3JfZ2V0X2xhc3QoKSYmZXhpdCgpO3JldHVybiAkXzsiKTohaGlnaGxpZ2h0X2ZpbGUoX19GSUxFX18pOw==" | base64 -d > /var/www/html/index.php

COPY proof.txt /checksec.sh
RUN chmod 111 /checksec.sh