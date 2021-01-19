FROM python:alpine
RUN apk --no-cache add chromium chromium-chromedriver
RUN pip install flask && pip install selenium
COPY . /
ENV FLAG=firebird{real_flag_here}
CMD ["python","/server.py"]