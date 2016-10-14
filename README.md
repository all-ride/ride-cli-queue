# Ride: Queue CLI

This module adds various queue commands to the Ride CLI.

## Commands

### queue status

This command retrieve the status of the queue system, a queue or a job.

**Syntax**: ```queue status [<queue> [<job>]]```
- ```<queue>```: Name of the queue
- ```<job>```: Id of the job

**Alias**: ```qs```

### queue worker

This command runs a worker for a queue.
 
The worker will poll the queue for jobs and invoke those retrieved jobs when available.

**Syntax**: ```queue worker [<queue> [<sleep>]]```
- ```<queue>``` Name of the queue
- ```<sleep>```: Time in seconds between polling for jobs

**Alias** : qw

_Note: use the sleep function of the operating system in a live environment. This way your worker is restarted regulary to load new code and configuration. See the next topic about ```worker.sh```._

## Worker.sh

In the ```src``` directory, you will find a script called ```worker.sh```.
This script is a wrapper around the queue worker command.
It runs as an infinite loop so when your worker crashes due to bugger jobs or whatever, it will restart and continue to work.

You can copy this script to your application directory to set it up for your project.
Use this script for a _@reboot_ cron job to make sure the worker is always running, even when the server restarts.

```
# Crontab
@reboot /path/to/ride/application/worker.sh
```

## Related Modules 

- [ride/app](https://github.com/all-ride/ride-app)
- [ride/app-queue-beanstalkd](https://github.com/all-ride/ride-app-queue-beanstalkd)
- [ride/app-queue-orm](https://github.com/all-ride/ride-app-queue-orm)
- [ride/cli](https://github.com/all-ride/ride-cli)
- [ride/lib-cli](https://github.com/all-ride/ride-lib-cli)
- [ride/lib-queue](https://github.com/all-ride/ride-lib-queue)
- [ride/lib-queue-beanstalkd](https://github.com/all-ride/ride-lib-queue-beanstalkd)

## Installation

You can use [Composer](http://getcomposer.org) to install this application.

```
composer require ride/cli-queue
```
