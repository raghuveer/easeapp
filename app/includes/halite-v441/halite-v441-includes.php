<?php
//Paragonie Halite Cryptographic library that is based on LibSodium Cryptographic Library Start
//echo "halite v4.41 includes<br>";
//The following is from /app/includes/halite-v441/autoload.php
//include "../app/includes/halite-v441/halite-v441-includes.php";
//echo dirname( __DIR__ ) . '/app/includes/halite-v441/src/';
//echo __DIR__.'/src/';
//exit;
  /**
 * You aren't using Composer, so, here's an autoloader instead.
 */
spl_autoload_register(function ($class) {
	$prefix = 'ParagonIE\\Halite\\';
	$base_dir = __DIR__.'/src/';
	//$base_dir = dirname( __DIR__ ) . '/app/includes/halite-v441/src/';
	//$base_dir = dirname( __DIR__ ) . '/app/includes/halite-v441/src/';
	
	// Does the class use the namespace prefix?
	$len = \strlen($prefix);
	if (\strncmp($prefix, $class, $len) !== 0) {
		// no, move to the next registered autoloader
		return;
	}

	// Get the relative class name
	$relative_class = \substr($class, $len);

	// Replace the namespace prefix with the base directory, replace namespace
	// separators with directory separators in the relative class name, append
	// with .php
	$file = $base_dir.
		\str_replace(
			['\\', '_'],
			'/',
			$relative_class
		).'.php';

	// If the file exists, require it
	if (\file_exists($file) && \strpos(\realpath($file), $base_dir) === 0) {
		require $file;
	}
});

//Paragonie Halite Cryptographic library that is based on LibSodium Cryptographic Library End
?>