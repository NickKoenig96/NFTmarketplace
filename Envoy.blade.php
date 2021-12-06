@servers(['web' => ['-i id_rsa_deploybot deploybot@139.162.136.17']])

@setup
    $workdir_staging = '/home/deploybot/staging/NFTmarketplace/';
    $workdir_production = '/home/deploybot/production/NFTmarketplace/';
    $db_name_staging = 'musicapp';
    $db_name_production = 'musicapp2';
    $db_user = 'root';
@endsetup


@story('deploy-staging')
    pull_repository_code_staging
    drop_old_database_staging
    create_new_database_staging
    deploy_code_staging
@endstory

@story('deploy-production')
    pull_repository_code_production
    drop_old_database_production
    create_new_database_production
    deploy_code_production
@endstory

@task('pull_repository_code_staging')
    echo "Pulling repository code"
    cd {{ $workdir_staging }}
    git pull origin main
@endtask

@task('pull_repository_code_production')
    echo "Pulling repository code"
    cd {{ $workdir_production }}
    git pull origin main
@endtask


@task('drop_old_database_staging')
    cd {{ $workdir_staging }}
    source .env
    echo "Dropping old database"
    mysql -u {{ $db_user }} -p$DB_PASSWORD -e 'DROP DATABASE {{ $db_name_staging }};' || true
@endtask

@task('drop_old_database_production')
    cd {{ $workdir_production }}
    source .env
    echo "Dropping old database"
    mysql -u {{ $db_user }} -p$DB_PASSWORD -e 'DROP DATABASE {{ $db_name_production }};' || true
@endtask


@task('create_new_database_staging')
    cd {{ $workdir_staging }}
    source .env
    echo "Creating new database"
    mysql -u {{ $db_user }} -p$DB_PASSWORD -e 'CREATE DATABASE {{ $db_name_staging }};'
@endtask

@task('create_new_database_production')
    cd {{ $workdir_production }}
    source .env
    echo "Creating new database"
    mysql -u {{ $db_user }} -p$DB_PASSWORD -e 'CREATE DATABASE {{ $db_name_production }};'
@endtask


@task('deploy_code_staging')
    cd {{ $workdir_staging }}
    echo "Deploying Laravel code"
    php artisan migrate --force
    php artisan db:seed
    echo "Successful deployment on staging, now you can enjoy your website"
@endtask

@task('deploy_code_production')
    cd {{ $workdir_production }}
    echo "Deploying Laravel code"
    php artisan migrate --force
    php artisan db:seed
    echo "Successful deployment on production, now you can enjoy your website"
@endtask