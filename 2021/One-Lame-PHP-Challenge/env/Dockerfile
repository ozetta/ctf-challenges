FROM php:8.0.0-apache
ADD index.php /var/www/html/index.php

RUN echo -e "#!/bin/sh\necho firebird{base64_encode_str_rot13_base64_decode_eval_exec}" > /proof_of_washsshssshsssshssssshsssssshssssssshaaaaaaaaaaaaaaaa.sh
RUN chown root:root /proof*.sh && chmod 555 /proof*.sh

RUN chown -R root:root /var/www && \
    find /var/www -type d -exec chmod 555 {} \; && \
    find /var/www -type f -exec chmod 444 {} \;