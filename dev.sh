#!/bin/sh
## script to start or stop web-dev daemons including docker
##
## usage script.sh [start|stop|restart]

action() {
	systemctl ${1} nginx php-fpm mariadb
	systemctl --user ${1} docker
}

if [ -z ${1} ]; then
	action restart
else
	case "${1}" in
		"restart") action restart;;
		"start") action start;;
		"stop") action stop;;
	esac
fi

exit 0