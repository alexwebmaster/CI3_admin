FROM phpdockerio/php74-fpm:latest

LABEL maintainer="Alex Gomes <contato@alexwebmaster.com.br>"
LABEL version="0.0.1"

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install php7.4-bcmath php7.4-memcached php7.4-mysql php7.4-pgsql php7.4-gd php7.4-intl php7.4-mbstring php7.4-soap \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*