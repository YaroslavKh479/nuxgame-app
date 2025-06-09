#!/bin/bash

set -eux

cd "$(dirname "$0")/.."

docker compose up --build -d

echo "⏳ Waiting for http://127.0.0.1:8801 to become available..."

for i in {1..30}; do
  if curl -s --head http://127.0.0.1:8801 | grep "200 OK" > /dev/null; then
    echo "✅ Service is up!"
    break
  fi
  sleep 1
done

explorer.exe "http://127.0.0.1:8801" || echo "Open manually: http://127.0.0.1:8801"
