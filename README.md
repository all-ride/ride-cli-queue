# Ride: Queue CLI

This module adds various CLI commands for the queue library

## queue status
Retrieve the status of the queue system, a queue or a job

**alias** : qs

## queue worker
Run a worker for a queue. 
The worker will poll the queue for jobs and invoke those retrieved jobs.

**alias** : qw

## Worker.sh

In the _src_ directory, you will find a script called _worker.sh_.
This script is a wrapper around the queue worker command.
It runs as an infinite loop so when your worker crashes due to bugger jobs or whatever, it will restart and continue to work.

You can copy this script to your application directory to set it up for your project.
Use this script for a _@reboot_ cron job.
