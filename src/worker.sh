#! /bin/sh

DIRECTORY="<your-ride-installation>"
CONSOLE="$DIRECTORY/application/cli.php"
PHP="php"
QUEUE="default"
SLEEP_TIME=10
LOG_FILE="$DIRECTORY/application/data/log/worker.log"
PRIORITY=5

while true
do
    nice -n 5 $PHP $CONSOLE queue worker $QUEUE >> $LOG_FILE 2>> $LOG_FILE
    sleep $SLEEP_TIME
done
