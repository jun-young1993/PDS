<?php
namespace PDS;
class Comparator {
    private $compare;
    /**
     * Constructor.
     * @param callable|null $compareFunction - Custom compare function.
     */
    public function __construct($compareFunction = null) {
        $this->compare = $compareFunction ?: [$this, 'defaultCompareFunction'];
    }

    /**
     * Default comparison function. It assumes that "a" and "b" are strings or numbers.
     * @param string|int $a
     * @param string|int $b
     * @return int
     */
    public static function defaultCompareFunction($a, $b) {
        if ($a === $b) {
            return 0;
        }

        return $a < $b ? -1 : 1;
    }

    /**
     * Checks if two variables are equal.
     * @param mixed $a
     * @param mixed $b
     * @return bool
     */
    public function equal($a, $b) {
        return call_user_func($this->compare, $a, $b) === 0;
    }

    /**
     * Checks if variable "a" is less than "b".
     * @param mixed $a
     * @param mixed $b
     * @return bool
     */
    public function lessThan($a, $b) {
        return call_user_func($this->compare, $a, $b) < 0;
    }

    /**
     * Checks if variable "a" is greater than "b".
     * @param mixed $a
     * @param mixed $b
     * @return bool
     */
    public function greaterThan($a, $b) {
        return call_user_func($this->compare, $a, $b) > 0;
    }

    /**
     * Checks if variable "a" is less than or equal to "b".
     * @param mixed $a
     * @param mixed $b
     * @return bool
     */
    public function lessThanOrEqual($a, $b) {
        return $this->lessThan($a, $b) || $this->equal($a, $b);
    }

    /**
     * Checks if variable "a" is greater than or equal to "b".
     * @param mixed $a
     * @param mixed $b
     * @return bool
     */
    public function greaterThanOrEqual($a, $b) {
        return $this->greaterThan($a, $b) || $this->equal($a, $b);
    }

    /**
     * Reverses the comparison order.
     */
    public function reverse() {
        $compareOriginal = $this->compare;
        $this->compare = function($a, $b) use ($compareOriginal) {
            return $compareOriginal($b, $a);
        };
    }
}


