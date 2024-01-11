<?php return spl_autoload_register( function( string $class ) : void {
    if( ( $map = require __DIR__ . '/classmap.php' )[ $class ] ?? null ) require __DIR__ . $map[ $class ];
} ); # This file is part of https://github.com/PiotrPress/composer-classmapper package.