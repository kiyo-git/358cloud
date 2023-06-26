FROM nginx:1.22.0

# install dependencies
RUN apt-get update && \
    apt-get install vim -y && \
    apt-get -y install sudo && \
    sudo apt-get install -y apache2-utils && \
    apt-get install -y openssl

RUN curl "https://s3.amazonaws.com/session-manager-downloads/plugin/latest/ubuntu_64bit/session-manager-plugin.deb" -o "session-manager-plugin.deb"
RUN dpkg -i session-manager-plugin.deb
RUN session-manager-plugin

# nginx config file
COPY default.conf /etc/nginx/conf.d/default.conf
# nginx basic auth file
COPY gen_htpasswd.sh /etc/nginx
RUN chmod 777 /etc/nginx/gen_htpasswd.sh
RUN /etc/nginx/gen_htpasswd.sh

WORKDIR /var/www/html