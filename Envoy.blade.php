<<<<<<< HEAD
@servers(['web' => ['-i id_rsa_deploybot deploybot@139.162.136.17']])
=======
@servers(['development' => ['-i /home/jonathan/.ssh/authorized_keys/ jonathan@139.162.134.152 ']]);
>>>>>>> gatesAndPolicies

@setup
    $workdir_staging = '/home/deploybot/staging/NFTmarketplace/';
    $workdir_production = '/home/deploybot/production/NFTmarketplace/';
    $db_name_staging = 'musicapp';
    $db_name_production = 'musicapp2';
    $db_user = 'root';
@endsetup

@story('deploy-staging')
    pull_repository_code_staging
    deploy_code_staging
@endstory

@story('deploy-production')
    pull_repository_code_production
    deploy_code_production
@endstory

@task('pull_repository_code_staging')
    echo "Pulling repository code"
    cd {{ $workdir_staging }}
    php artisan down
    git reset --hard HEAD
    git pull origin main
@endtask

@task('pull_repository_code_production')
    echo "Pulling repository code"
    cd {{ $workdir_production }}
    php artisan down
    git reset --hard HEAD
    git pull origin main
@endtask

@task('deploy_code_staging')
    cd {{ $workdir_staging }}
    echo "Deploying Laravel code"
    composer dump-autoload
    composer install
    php artisan migrate --force
    php artisan up
    echo "Successful deployment on staging, now you can enjoy your website"
@endtask

@task('deploy_code_production')
    cd {{ $workdir_production }}
    echo "Deploying Laravel code"
    composer dump-autoload
    composer install
    php artisan migrate --force
    php artisan up
    echo "Successful deployment on production, now you can enjoy your website"
@endtask