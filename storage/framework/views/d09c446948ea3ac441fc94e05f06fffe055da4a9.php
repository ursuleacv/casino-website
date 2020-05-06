<?php $__env->startSection('title'); ?>
    <?php echo e(__('Maintenance')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-3">
        <span class="badge badge-primary p-2 mr-2"><?php echo e(__('System info')); ?></span><?php echo e($system_info); ?>

    </div>
    <div class="card border-primary mb-3">
        <div class="card-body">
            <h5 class="card-title"><?php echo e(__('Application version')); ?></h5>
            <?php if(version_compare($releases->app->version, config('app.version'), '>')): ?>
                <p class="text-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php echo e(__('New version :v is available.', ['v' => $releases->app->version])); ?>

                </p>
            <?php else: ?>
                <p class="text-success">
                    <i class="fas fa-check"></i>
                    <?php echo e(__('The latest application release is installed.')); ?>

                </p>
            <?php endif; ?>
        </div>
    </div>
    <div class="card border-primary mb-3">
        <div class="card-body">
            <h5 class="card-title"><?php echo e(__('Maintenance mode')); ?></h5>
            <p class="text-muted"><?php echo e(__('Enable maintenance mode when you are upgrading the application, installing add-ons or doing other service tasks. All users except for administrators will not be able to use the website.')); ?></p>
            <?php if(!app()->isDownForMaintenance()): ?>
                <p class="text-muted"><?php echo e(__('Maintenance mode is currently disabled.')); ?></p>
                <form method="POST" action="<?php echo e(route('backend.maintenance.enable')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="input-group">
                        <input name="message" type="text" class="form-control" value="<?php echo e(__('Sorry, we are doing some maintenance. Please check back soon.')); ?>">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><?php echo e(__('Enable')); ?></button>
                        </div>
                    </div>
                </form>
            <?php else: ?>
                <p class="text-muted"><?php echo e(__('Maintenance mode is currently enabled.')); ?></p>
                <form method="POST" action="<?php echo e(route('backend.maintenance.disable')); ?>">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-primary" type="submit"><?php echo e(__('Disable')); ?></button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <div class="card border-primary mb-3">
        <div class="card-body">
            <h5 class="card-title"><?php echo e(__('Cache')); ?></h5>
            <p class="text-muted"><?php echo e(__('Application templates, config files, translation strings are cached. It is necessary to clear cache when making any changes to the source code or installing upgrades.')); ?></p>
            <form method="POST" action="<?php echo e(route('backend.maintenance.cache')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-primary"><?php echo e(__('Clear cache')); ?></button>
            </form>
        </div>
    </div>
    <div class="card border-primary mb-3">
        <div class="card-body">
            <h5 class="card-title"><?php echo e(__('Database updates')); ?></h5>
            <p class="text-muted"><?php echo e(__('When upgrading to a new version of the application it is essentially to run database updates.')); ?></p>
            <form method="POST" action="<?php echo e(route('backend.maintenance.migrate')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-primary"><?php echo e(__('Run database updates')); ?></button>
            </form>
        </div>
    </div>
    <div class="card border-primary mb-3">
        <div class="card-body">
            <h5 class="card-title"><?php echo e(__('Tasks')); ?></h5>
            <p class="text-muted">
                <?php echo e(__('')); ?>

            </p>
            <p class="text-muted"><?php echo e(__('The app provides a number of commands, which can be executed to perform certain actions.')); ?></p>
            <form method="POST" action="<?php echo e(route('backend.maintenance.task')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <select name="command" class="custom-select">
                        <?php $__currentLoopData = $commands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $command): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($command['class']); ?>"><?php echo e($command['description']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo e(__('Execute task')); ?></button>
            </form>
        </div>
    </div>
    <div class="card border-primary mb-3">
        <div class="card-body">
            <h5 class="card-title"><?php echo e(__('Cron')); ?></h5>
            <p class="text-muted"><?php echo e(__('Certain tasks should run on a regular basis. In order for the application to execute them automatically you should add the following system cron job:')); ?></p>
            <pre class="alert alert-info">* * * * * php -d register_argc_argv=On <?php echo e(base_path()); ?>/artisan schedule:run >> /dev/null 2>&1</pre>
            <p class="text-muted">
                <?php echo e(__('Please note that the command-line PHP version on your server should also meet the PHP version requirements, otherwise the cron job will fail to execute.')); ?>

                <?php echo e(__('On some servers with multi-PHP versions support you might need to explicitly specify the path to the proper version of PHP.')); ?>

            </p>
            <form method="POST" action="<?php echo e(route('backend.maintenance.cron')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-primary"><?php echo e(__('Run cron job manually')); ?></button>
            </form>
        </div>
    </div>
    <div class="card border-primary mb-3">
        <div class="card-body">
            <h5 class="card-title"><?php echo e(__('Logs')); ?></h5>
            <?php if($log_size): ?>
                <p class="text-muted"><?php echo e(__('Application log file size is :n MB.', ['n' => $log_size])); ?></p>
                <a href="<?php echo e(route('backend.maintenance.log.view')); ?>" class="btn btn-primary" target="_blank"><?php echo e(__('View')); ?></a>
                <a href="<?php echo e(route('backend.maintenance.log.download')); ?>" class="btn btn-primary" target="_blank"><?php echo e(__('Download')); ?></a>
            <?php else: ?>
                <p class="text-muted"><?php echo e(__('No application log file found.')); ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>