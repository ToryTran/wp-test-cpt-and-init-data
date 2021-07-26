$(sleep 10 && chown -R www-data:www-data /var/www/html/) & 

# Run the parent's ENTRYPOINT and CMD as defined in its Dockerfile
#     (https://github.com/gsusI/wordpress/blob/master/php7.4/apache/Dockerfile)

docker-entrypoint.sh apache2-foreground # run parent entrypoint.