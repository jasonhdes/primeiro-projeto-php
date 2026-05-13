#!/bin/bash
set -e

# The application hardcodes "localhost" as the MySQL host (access.php cannot be modified).
# socat forwards TCP connections from 127.0.0.1:3306 on this container to the db service.
echo "[entrypoint] Starting socat proxy: localhost:3306 → db:3306"
socat TCP-LISTEN:3306,fork,reuseaddr TCP:db:3306 &

# Give socat a moment to bind before Apache starts accepting requests
sleep 1

echo "[entrypoint] Starting Apache"
exec apache2-foreground
