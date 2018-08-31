<?php

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionObject;
use App\MatrixUnfolder;

class MatrixUnfolderTest extends TestCase
{
    /**
     * @test
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid matrix size!
     */
    public function thowWhenMatrixSizeSmall()
    {
        $matrix = [1, 2];

        (new MatrixUnfolder())->unfold($matrix);
    }

    /**
     * @test
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid matrix size!
     */
    public function thowWhenMatrixSizeEven()
    {
        $matrix = [1, 2, 3, 4];

        (new MatrixUnfolder())->unfold($matrix);
    }

    /**
     * @test
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid matrix size!
     */
    public function thowWhenMatrixHasDifferentSizes()
    {
        $matrix = [
            [1,2,3],
            [1,2,3],
            [1,2,3,4],
        ];

        (new MatrixUnfolder())->unfold($matrix);
    }

    /**
     * Условие, значение не могут быть null.
     * @dataProvider unfoldExamples
     */
    public function testUnfold($matrix, $expected)
    {
        $this->assertEquals($expected, (new MatrixUnfolder())->unfold($matrix));
    }

    public function unfoldExamples()
    {
        return [
            [
                'matrix' => [
                    [1, 2, 3],
                    [4, 5, 6],
                    [7, 8, 9],

                ],
                'expected' => '5 4 7 8 9 6 3 2 1',
            ],
            [
                'matrix' => [
                    [1, 2, 3, 4, 5],
                    [6, 7, 8, 9, 10],
                    [11, 12, 13, 14, 15],
                    [16, 17, 18, 19, 20],
                    [21, 22, 23, 24, 25],
                ],
                'expected' => '13 12 17 18 19 14 9 8 7 6 11 16 21 22 23 24 25 20 15 10 5 4 3 2 1',
            ],
            [
                'matrix' => [
                    [1, 2, 3, 4, 5, 6, 7],
                    [8, 9, 10, 11, 12, 13, 14],
                    [15, 16, 17, 18, 19, 20, 21],
                    [22, 23, 24, 25, 26, 27, 28],
                    [29, 30, 31, 32, 33, 34, 35],
                    [36, 37, 38, 39, 40, 41, 42],
                    [43, 44, 45, 46, 47, 48, 49],
                ],
                'expected' => '25 24 31 32 33 26 19 18 17 16 23 30 37 38 39 40 41 34 27 20 13 12 11 10 9 8 15 22 29 36 43 44 45 46 47 48 49 42 35 28 21 14 7 6 5 4 3 2 1',
            ],
        ];
    }

    /**
     * @dataProvider getCenterExamples
     */
    public function testGetCenter($size, $center)
    {
        $matrixUnfolder = new MatrixUnfolder();

        $reflection = new ReflectionObject($matrixUnfolder);
        $method = $reflection->getMethod('getCenter');
        $method->setAccessible(true);

        $this->assertEquals($center, $method->invoke($matrixUnfolder, $size));
    }

    public function getCenterExamples()
    {
        return [
            [
                'size' => 3,
                'center' => 1
            ],
            [
                'size' => 5,
                'center' => 2
            ],
            [
                'size' => 7,
                'center' => 3
            ],
            [
                'size' => 9,
                'center' => 4
            ],
        ];
    }
}
