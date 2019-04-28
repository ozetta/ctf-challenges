FROM php:7-apache

RUN chown root /var/www/html
RUN chmod 555 /var/www/html

RUN echo "PD89QCgoJF89JF9HRVRbIvCfjYUiXSkmJiEoY3JjMzIobWQ1KCRfLDEpKT4+MTEpKT9gJF9gOiFoaWdobGlnaHRfZmlsZShfX0ZJTEVfXyk7" | base64 -d > /var/www/html/index.php

COPY proof.txt /checksec.sh
RUN chmod 111 /checksec.sh