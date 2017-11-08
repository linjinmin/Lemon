<?php
namespace Lemon\Tests\Query;

use Lemon\Query\Query;
use PHPUnit\Framework\TestCase;

class QueryTest extends TestCase
{
    public function testQuery()
    {
        $result = Query::query('5304');
        $info   = json_decode($result);
        $this->assertNotEmpty($info);
        $this->assertEquals('玉溪市', $info->city);
        $this->assertEquals('云南省', $info->province);

        try {
            Query::query('aaad3232ds');
            $this->fail();
        } catch (\InvalidArgumentException $exception) {
        }
        try {
            Query::query('123');
            $this->fail();
        } catch (\InvalidArgumentException $exception) {
        }
    }
}
