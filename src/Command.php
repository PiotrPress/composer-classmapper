<?php declare( strict_types = 1 );

namespace PiotrPress\Composer\Autoloader;

use Composer\Command\BaseCommand;
use Composer\Autoload\ClassMapGenerator;
use Composer\Factory;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Filesystem\Filesystem;

class Command extends BaseCommand {
    protected function configure() {
        $this
            ->setName( 'autoload' )
            ->setDescription( 'Generates simple autoloader file based on a classmap file.' )
            ->addOption(
                'exclude',
                'e',
                InputOption::VALUE_OPTIONAL,
                'Regex that matches file paths to be excluded from the classmap',
                null
            );
    }

    protected function execute( InputInterface $input, OutputInterface $output ) {
        $dir = $this->getComposer( false )
            ? $this->getComposer( false )->getConfig()->get( 'vendor-dir' )
            : Factory::createConfig( $this->getIO() )->get( 'vendor-dir' );

        $fs = new Filesystem();
        $info = '<info>%s</info>';

        $map = ClassMapGenerator::createMap( \dirname( $dir ), $input->getOption( 'exclude' ), $this->getIO() );
        \array_walk( $map, function( &$file ) use( $dir, $fs ) {
            $file = '/' . \trim( $fs->makePathRelative( $file, \dirname( $dir ) ), '/' );
        } );

        $fs->dumpFile( $dir . '/classmap.php', \sprintf( '<?php return %s;', \var_export( $map, true ) ) );
        $output->writeln( \sprintf( $info, 'Classmap file created successfully' ) );

        $file = '/autoload.php';
        $fs->copy( \dirname( __DIR__ ) . '/res' . $file, $dir . $file, true );
        $output->writeln( \sprintf( $info, 'Autoload file created successfully' ) );

        return self::SUCCESS;
    }
}