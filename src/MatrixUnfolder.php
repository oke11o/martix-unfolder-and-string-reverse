<?php

namespace App;

/**
 * Class MatrixUnfolder
 * @package App
 * @author Sergey Bevzenko <bevzenko.sergey@gmail.com>
 */
class MatrixUnfolder
{
    const Y_DIRECTION_LEFT = 'left';
    const Y_DIRECTION_RIGHT = 'right';
    const X_DIRECTION_UP = 'up';
    const X_DIRECTION_DOWN = 'down';

    private $x;
    private $y;

    private $leftSteps = 1;
    private $downSteps = 1;
    private $rightSteps = 2;
    private $upSteps = 2;

    public $currentDirection = self::Y_DIRECTION_LEFT;

    /**
     * @param array $matrix
     * @return string
     * @throws \Exception
     */
    public function unfold(array $matrix)
    {
        $this->assertMatrix($matrix);

        return $this->doUnfold($matrix);
    }

    /**
     * @param array $matrix
     * @throws \Exception
     */
    private function assertMatrix(array $matrix)
    {
        $len = count($matrix);
        if ($len < 3 || !($len % 2)) {
            throw new \Exception('Invalid matrix size!');
        }
        foreach ($matrix as $row) {
            if (count($row) !== $len) {
                throw new \Exception('Invalid matrix size!');
            }
        }
    }

    /**
     * @param array $matrix
     * @return string
     */
    private function doUnfold(array $matrix)
    {
        $this->x = $this->y = $this->getCenter(count($matrix));

        $result = (string) $this->getMatrixValue($matrix, $this);
        $end = false;
        while (true) {
            $dir = $this->getCurrentDirection();
            $method = $dir.'Increment';
            $value = $dir.'Steps';
            for ($i = 0; $i < $this->$value; $i++) {
                $this->$method();
                $val = $this->getMatrixValue($matrix, $this);
                if (null === $val) {
                    $end = true;
                    break;
                }
                $result .= ' '.$val;
            }
            $this->$value += 2;
            $this->setNextDirection();

            if ($end) {
                break;
            }
        }

        return $result;
    }

    private function getNextDirection($currentDirection)
    {
        switch ($currentDirection) {
            case self::Y_DIRECTION_LEFT:
                return self::X_DIRECTION_DOWN;
            case self::X_DIRECTION_DOWN:
                return self::Y_DIRECTION_RIGHT;
            case self::Y_DIRECTION_RIGHT:
                return self::X_DIRECTION_UP;
            case self::X_DIRECTION_UP:
                return self::Y_DIRECTION_LEFT;
            default:
                throw new \LogicException('Invalid direction');
        }
    }

    private function setNextDirection()
    {
        $this->setCurrentDirection($this->getNextDirection($this->getCurrentDirection()));
    }

    /**
     * @return string
     */
    private function getCurrentDirection()
    {
        return $this->currentDirection;
    }

    /**
     * @param string $currentDirection
     *
     * @return self
     */
    private function setCurrentDirection($currentDirection)
    {
        $this->currentDirection = $currentDirection;

        return $this;
    }

    /**
     * @param $matrix
     * @param $state
     * @return mixed
     */
    private function getMatrixValue($matrix, MatrixUnfolder $state)
    {
        if (isset($matrix[$state->y]) && isset($matrix[$state->y][$state->x])) {
            return $matrix[$state->y][$state->x];
        }

        return null;
    }

    /**
     * @param $len
     * @return int
     */
    private function getCenter($len)
    {
        return (int)($len / 2);
    }

    private function leftIncrement()
    {
        $this->x--;
    }
    private function rightIncrement()
    {
        $this->x++;
    }
    private function upIncrement()
    {
        $this->y--;
    }
    private function downIncrement()
    {
        $this->y++;
    }
}