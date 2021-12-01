@servers(['development' => ['-i /home/jonathan/.ssh/authorized_keys/ jonathan@139.162.134.152 ']]);

@task('deploy', ['on' => 'development'])
    cd /home/hacker/beta
    php artisan down
    git reset --hard HEAD
    git pull origin master
    php composer.phar install
    php composer.phar dump-autoload
    php artisan migrate --force
    php artisan up
@endtask 