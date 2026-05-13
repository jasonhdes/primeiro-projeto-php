#!/bin/bash
set -e

# access.php uses 127.0.0.1 as the MySQL host, which forces PHP to connect
# via TCP instead of a Unix socket. socat listens on that TCP port and
# forwards each connection to the db service by name.
echo "[entrypoint] Starting socat proxy: 127.0.0.1:3306 → db:3306"
socat TCP-LISTEN:3306,bind=127.0.0.1,fork,reuseaddr TCP:db:3306 &

# Give socat time to create the socket before Apache starts serving requests
sleep 1

echo "[entrypoint] Starting Apache"
exec apache2-foreground
