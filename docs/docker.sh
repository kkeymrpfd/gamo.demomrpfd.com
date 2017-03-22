#!/bin/bash

parentdir="$(dirname "$PWD")"
domain="gamo_demomrpfd"

docker run -it -p 80:80 -v $parentdir:/var/www/$domain mrpfd/lamp-kickstart /bin/bash -c "/start.sh $domain /pub/ inc/config.default.php docs/structure.sql && mysql --default-character-set=utf8 -u root $domain < /var/www/${domain}/docs/structure_update.sql && echo 'ready' && /bin/bash"
