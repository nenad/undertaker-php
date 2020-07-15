<?php declare(strict_types=1);

namespace Tests\Nenad\Undertaker;

use Nenad\Undertaker\Extractor;
use PHPUnit\Framework\TestCase;

class ExtractorTest extends TestCase
{
    public function successTestCases()
    {
        return [
            [
                'filename' => __DIR__ . '/fqcnFixtures/simple_class.php',
                'fqcn' => 'Simple\HelloWorld',
            ],
            [
                'filename' => __DIR__ . '/fqcnFixtures/abstract_class.php',
                'fqcn' => 'Abstracted\HelloWorld',
            ],
            [
                'filename' => __DIR__ . '/fqcnFixtures/no_namespace.php',
                'fqcn' => 'HelloWorld',
            ],
            [
                'filename' => __DIR__ . '/fqcnFixtures/trait.php',
                'fqcn' => 'Hello\World',
            ],
        ];
    }

    public function failureTestCases()
    {
        return [
            [
                'filename' => __DIR__ . '/fqcnFixtures/empty_file.php',
                'exception' => sprintf('could not find file type for: %s', __DIR__ . '/fqcnFixtures/empty_file.php'),
            ],
        ];
    }

    /**
     * @dataProvider successTestCases
     */
    public function testSuccessfulFQCNExtraction(string $filename, string $expected)
    {
        self::assertSame($expected, Extractor::FQCN($filename));
    }

    /**
     * @dataProvider failureTestCases
     */
    public function testFailedFQCNExtraction(string $filename, string $expected)
    {
        $this->expectExceptionMessage($expected);
        Extractor::FQCN($filename);
    }
}
