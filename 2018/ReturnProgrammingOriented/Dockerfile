FROM php:7.1-apache

# Install Chrome
RUN curl https://dl-ssl.google.com/linux/linux_signing_key.pub | apt-key add - 
RUN echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google.list && \
    apt-get update && \
    apt-get install  -y --no-install-recommends google-chrome-stable && \
    apt-get clean

# Enable mod-rewrite
RUN a2enmod rewrite
ADD html /var/www/html/