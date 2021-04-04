set -e

echo "Deploying application ..."

set -e

echo "Deploying application ..."

# Enter maintenance mode
# (php artisan down --message 'The app is being (quickly!) updated. Please try again in a minute.') || true
    # Update codebase
    git stash save
    git pull origin master

    # Clear Cache
    composer clear-all
# Exit maintenance mode
# php artisan up
echo "Application deployed!"
