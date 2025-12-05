<?php
// Base URL for links
define('BASE_URL', '/carapp');

// Filesystem root for includes
define('APP_PATH', __DIR__);

// Database settings from Render env
define('DB_HOST', getenv('DB_HOST'));
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASS', getenv('DB_PASS'));
define('DB_PORT', getenv('DB_PORT') ?: 3306);
