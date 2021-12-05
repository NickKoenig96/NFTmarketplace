@servers(['web' => ['-i id_rsa_deploybot deploybot@139.162.136.17']])

@setup
    $workdir_staging = '/home/deploybot/staging/NFTmarketplace/';
    $workdir_production = '/home/deploybot/production/NFTmarketplace/';
    $db_name_staging = 'musicapp';
    $db_name_production = 'musicapp2';
    $db_user = 'root';
    $db_pass = env('DB_PASS');
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
    echo "Dropping old database"
    mysql -u {{ $db_user }} -p{{ $db_pass }} -e 'DROP DATABASE {{ $db_name_staging }};' || true
@endtask

@task('drop_old_database_production')
    cd {{ $workdir_production }}
    echo "Dropping old database"
    mysql -u {{ $db_user }} -p{{ $db_pass }} -e 'DROP DATABASE {{ $db_name_production }};' || true
@endtask


@task('create_new_database_staging')
    cd {{ $workdir_staging }}
    echo "Creating new database"
    mysql -u {{ $db_user }} -p{{ $db_pass }} -e 'CREATE DATABASE {{ $db_name_staging }};'
@endtask

@task('create_new_database_production')
    cd {{ $workdir_production }}
    echo "Creating new database"
    mysql -u {{ $db_user }} -p{{ $db_pass }} -e 'CREATE DATABASE {{ $db_name_production }};'
@endtask


@task('deploy_code_staging')
    cd {{ $workdir_staging }}
    echo "Deploying Laravel code"
    php artisan migrate --force
    php artisan db:seed
@endtask

@task('deploy_code_production')
    cd {{ $workdir_production }}
    echo "Deploying Laravel code"
    php artisan migrate --force
    php artisan db:seed
@endtask