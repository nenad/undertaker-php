<?php declare(strict_types=1);

namespace Nenad\Undertaker;

use Composer\Autoload\ClassLoader;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RecursiveRegexIterator;
use RegexIterator;
use RuntimeException;
use Throwable;

final class Preloader
{
    /**
     * @var ClassLoader
     */
    private $loader;

    public function __construct(string $composerLoader)
    {
        $this->loader = include $composerLoader;
    }

    /**
     * Preloads all classes/interfaces/traits found in a directory by running `require_once` on them.
     *
     * @param string $src Directory where to look for .php files
     * @return string[] List of all preloaded objects
     */
    public function load(string $src): array
    {
        $dir = new RecursiveDirectoryIterator($src);
        $iter = new RecursiveIteratorIterator($dir);
        $files = new RegexIterator($iter, '/^.+\.php$/', RecursiveRegexIterator::GET_MATCH);

        $allClasses = [];
        foreach ($files as $file) {
            try {
                $allClasses[] = Extractor::FQCN($file[0]);
            } catch (RuntimeException $e) {
                printf("Error while extracting FQCN: %s\n", $e->getMessage());
            }
        }

        foreach ($allClasses as $class) {
            try {
                require_once $this->loader->findFile($class);
            } catch (Throwable $e) {
                printf("Error while loading class %s: %s\n", $class, $e->getMessage());
            }
        }

        return $allClasses;
    }
}
