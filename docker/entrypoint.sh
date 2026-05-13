#!/bin/bash
set -e

# PHP treats "localhost" as a Unix socket host, not TCP.
# mysqli_connect("localhost") looks for /var/run/mysqld/mysqld.sock — never touches TCP port 3306.
# socat creates that socket file and forwards each connection to the db service over TCP.
mkdir -p /var/run/mysqld

echo "[entrypoint] Starting socat proxy: /var/run/mysqld/mysqld.sock → db:3306"
socat UNIX-LISTEN:/var/run/mysqld/mysqld.sock,fork,reuseaddr TCP:db:3306 &

# Give socat time to create the socket before Apache starts serving requests
sleep 1

echo "[entrypoint] Starting Apache"
exec apache2-foreground
