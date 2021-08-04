<?php

namespace Tests\Unit;

use App\Utils\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_reverse()
    {
        $tests = [
            '' => '',
            'abc' => 'cba',
            '你好' => '好你',
            ' abc' => 'cba '
        ];

        foreach ($tests as $input => $want) {
            $got = Str::reverse($input);

            $this->assertEquals($want, $got);
        }
    }
}
