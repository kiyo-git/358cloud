#!/bin/bash

USER_NAME=pist6-admin-user
PASSWD=pist6-admin-pwd
CRYPTPASS=`openssl passwd -crypt ${PASSWD}`

echo "${USER_NAME}:${CRYPTPASS}" >> /etc/nginx/.htpasswd