#!/bin/bash
set -e

# PHP's mysqli_connect("localhost") uses a Unix socket, not TCP.
# The php:7.4-apache image is built without --with-mysql-sock, so the
# compiled-in default socket path is /tmp/mysql.sock.
# /tmp is world-writable, so the www-data Apache worker can connect.
# socat creates that socket and forwards each connection to the db service.
echo "[entrypoint] Starting socat proxy: /tmp/mysql.sock → db:3306"
socat UNIX-LISTEN:/tmp/mysql.sock,fork,reuseaddr TCP:db:3306 &

# Give socat time to create the socket before Apache starts serving requests
sleep 1

echo "[entrypoint] Starting Apache"
exec apache2-foreground
