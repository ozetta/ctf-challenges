FROM buildpack-deps:buster
RUN apt-get update && apt-get install -y socat

RUN echo -e "#!/bin/sh\necho firebird{real_flag_here}" > /proof_of_wtttttttfffffffffffuuuuuuuuuuuuu.sh
COPY htttttttpd-v0.12.4-nightly /htttttttpd-v0.12.4-nightly
RUN chmod 555 /proof*.sh /htttttttpd-v0.12.4-nightly

ADD html /var/www/html/
RUN chmod 555 /var/www/html/*

WORKDIR /var/www/html/
RUN adduser --disabled-password --no-create-home htttttttpd
USER htttttttpd
CMD socat TCP-LISTEN:80,reuseaddr,fork EXEC:"/htttttttpd-v0.12.4-nightly"

