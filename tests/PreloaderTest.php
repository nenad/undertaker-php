<?php declare(strict_types=1);

namespace Tests\Nenad\Undertaker;

use Nenad\Undertaker\Preloader;
use PHPUnit\Framework\TestCase;

class PreloaderTest extends TestCase
{
    public function testAllClassesAreLoaded()
    {
        $preloader = new Preloader(__DIR__ . '/fixture/vendor/autoload.php');

        $expected = [
            'Undertaker\Dummy\Calculator\PriceCalculator',
            'Undertaker\Dummy\Model\InhabitableInterface',
            'Undertaker\Dummy\Model\Building',
            'Undertaker\Dummy\Model\House',
        ];

        $actual = $preloader->load(__DIR__ . '/fixture/src');

        sort($expected, SORT_STRING);
        sort($actual, SORT_STRING);

        self::assertSame($expected, $actual, 'Mismatch in loaded files');
    }
}
