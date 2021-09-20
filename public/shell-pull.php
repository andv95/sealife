<?php
$output = $exit = null;
echo getcwd() . "\n";
exec( '/usr/bin/git pull origin master 2>&1', $output, $exit );
echo implode("\n", $output);

//print_r( $output );
var_dump( $exit );
