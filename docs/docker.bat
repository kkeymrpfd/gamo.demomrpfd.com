@echo off
for %%i in ("%~dp0..") do set "folder=%%~fi"
echo %folder%

SET domain=gamo_demomrpfd
SET com="/start.sh %domain% /pub/ inc/config.default.php docs/structure.sql && mysql --default-character-set=utf8 -u root %domain% < /var/www/%domain%/docs/structure_update.sql && echo ready && /bin/bash"

echo docker run -it -p 80:80 -v %folder%:/var/www/%domain% mrpfd/lamp-kickstart /bin/bash -c %com%
