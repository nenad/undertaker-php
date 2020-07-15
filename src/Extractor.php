<?php declare(strict_types=1);

namespace Nenad\Undertaker;

use RuntimeException;

final class Extractor
{
    /**
     * @param string $filename Path to a .php file
     * @return string Fully qualified class name
     * @throws RuntimeException Thrown if the file does not look like a valid PHP file.
     */
    public static function FQCN(string $filename): string
    {
        $src = file_get_contents($filename);
        $matches = [];
        $res = preg_match('/^namespace\s+([a-z0-9A-Z\\\]+);/m', $src, $matches);

        $parts = [];
        if ($res) {
            $parts[] = $matches[1];
        }

        $res = preg_match('/^(abstract\sclass|final\sclass|class|trait|interface)\s+([a-zA-Z0-9]+)/m', $src, $matches);
        if (!$res) {
            throw new RuntimeException(sprintf('could not find file type for: %s', $filename));
        }
        $parts[] = $matches[2];

        return implode("\\", $parts);
    }
}
