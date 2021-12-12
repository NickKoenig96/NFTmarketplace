@servers(['staging' => ['-i id_rsa deploybot@139.162.134.114 ']]);

@setup
$workdir_staging = '/home/deploybot/staging/NFTmarketplace/';
$workdir_production = '/home/deploybot/production/NFTmarketplace/';
$db_name_staging = 'NFTmarketplace';
$db_name_production = 'NFTmarketplace';
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
