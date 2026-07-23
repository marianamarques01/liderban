FROM wordpress:php8.2-apache

COPY wp-content/themes/liderban-theme /usr/src/wordpress/wp-content/themes/liderban-theme
COPY wp-content/plugins/liderban-instagram-feed /usr/src/wordpress/wp-content/plugins/liderban-instagram-feed
COPY wp-content/uploads /usr/src/wordpress/wp-content/uploads

ENV WORDPRESS_CONFIG_EXTRA='\
if ( ! empty( $_SERVER["HTTP_HOST"] ) ) { \
  $host = preg_replace("/:\\d+$/", "", $_SERVER["HTTP_HOST"]); \
  define("WP_HOME", "https://" . $host); \
  define("WP_SITEURL", "https://" . $host); \
} \
define("WP_ENVIRONMENT_TYPE", "staging"); \
'

CMD ["/bin/sh", "-c", "a2dismod mpm_event mpm_worker || true; a2enmod mpm_prefork || true; exec docker-entrypoint.sh apache2-foreground"]
