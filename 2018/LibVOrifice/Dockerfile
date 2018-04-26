FROM python:2-jessie

# Install the dependencies in a dumb way
RUN apt-get update && \
    apt-get install -y --no-install-recommends libreoffice && \
    apt-get purge -y libreoffice && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /var/cache/apt/archives/*.deb /var/cache/apt/*cache.bin

RUN curl https://downloadarchive.documentfoundation.org/libreoffice/old/6.0.0.3/deb/x86_64/LibreOffice_6.0.0.3_Linux_x86-64_deb.tar.gz > /tmp/o.gz

RUN cd /tmp && \
    tar zxvf /tmp/o.gz && \
    cd LibreOffice_6.0.0.3_Linux_x86-64_deb/DEBS/ && \
    dpkg -i *.deb

COPY flag.txt /flag
COPY run.py /run.py
RUN chmod 444 /flag
RUN chmod 555 /run.py

RUN useradd --create-home --shell /bin/bash libvorifice
USER libvorifice
WORKDIR /home/libvorifice

EXPOSE 64001

CMD python -u /run.py