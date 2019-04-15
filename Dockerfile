FROM alpine:3.9 AS compiler

WORKDIR /

RUN apk upgrade --update
RUN apk add --no-cache expect gcc g++ make libc-dev autoconf openssl-dev php7-dev php7-openssl php7-pear && \
	pecl update-channels && \
	echo -e "#!/usr/bin/expect\n\nset timeout 300\nspawn pecl install swoole\nexpect \"enable sockets supports?*:\" {send \"yes\\\n\"}\nexpect \"enable openssl support?*:\" {send \"yes\\\n\"}\nexpect \"enable http2 support?*:\" {send \"yes\\\n\"}\nexpect \"enable mysqlnd support?*:\" {send \"yes\\\n\"}\nexpect \"enable postgresql coroutine client support?*:\" {send \"no\\\n\"}\nexpect {extension=swoole.so}" > /tmp/install_swoole.sh && \
	chmod +x /tmp/install_swoole.sh &&\
	/tmp/install_swoole.sh

FROM alpine:3.9 AS server

RUN apk upgrade --update
RUN apk add --no-cache libstdc++ && \
	apk add --no-cache php7-cli php7-openssl php7-mysqlnd php7-mbstring php7-pdo_sqlite php7-opcache php7-gd php7-pecl-xdebug php7-xml php7-json php7-ctype php7-bcmath php7-pecl-msgpack php7-sockets php7-tokenizer php7-pdo

COPY --from=compiler /usr/lib/php7/modules/swoole.so /usr/lib/php7/modules/swoole.so

RUN echo "extension=swoole.so" > /etc/php7/conf.d/99_swoole.ini