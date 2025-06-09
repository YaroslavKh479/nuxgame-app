#!/bin/bash

set -uex

RUN() {
    su www-data -s /bin/bash -c "$1"
}

pushd /var/www/

  if [ ! -f ${PWD}/.env ]; then
      env | grep -E "^X_" | sed 's@"@@g;s@^X_@@g' | awk -F"=" '{print $1 "=" $2$3$4 }' | sort > ${PWD}/.env
      env -i bash
  fi

  chmod go+rw ${PWD}/.env

  chown -R www-data:www-data /var/www

  RUN "composer install --optimize-autoloader"

  RUN "composer dump-autoload"

  RUN "php artisan key:generate --force"

  RUN "php artisan migrate && php artisan optimize:clear"
  
  RUN "npm install"

  RUN "npm run build"


popd

exec "$@"
