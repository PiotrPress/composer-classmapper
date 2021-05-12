<?php declare(strict_types=1);

namespace PiotrPress\Composer;

use PiotrPress\Classmap;

class Autoloader {
    public static function dump() : bool {
        $directory = \dirname( \dirname( \dirname( __DIR__ ) ) );
        $classmap = new Classmap( \dirname( $directory ) );
        $file = '/autoload.php';

        if ( self::rmdir( $directory . '/composer' ) ) echo "Composer directory removed successfully\n";
        else throw new \Exception( 'Something went wrong while removing composer directory' );

        if ( $classmap->dump( $directory . '/classmap.php' ) ) echo "Classmap file created successfully\n";
        else throw new \Exception( 'Something went wrong while creating classmap file' );

        if ( \copy( __DIR__ . $file, $directory . $file ) ) echo "Autoload file created successfully\n";
        else throw new \Exception( 'Something went wrong while creating autoload file' );

        return true;
    }

    protected static function rmdir( string $directory ) : bool {
        if ( \is_dir( $directory ) ) {
            $directory = \rtrim( \str_replace( '\\', '/', $directory ), '/' ) . '/';
            $files = \glob( $directory . '*', \GLOB_MARK );

            foreach( $files as $file ) self::rmdir( $file );
            return \rmdir( $directory );
        } elseif( \is_file( $directory ) ) return \unlink( $directory );
        return false;
    }
}