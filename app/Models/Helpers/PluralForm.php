<?php
/**
 * User: sasik
 * Date: 3/23/16
 * Time: 2:42 PM
 */

namespace App\Models\Helpers;


class PluralForm
{

    private $number;
    /**
     * @var array
     */
    private $forms;

    /**
     * PluralForm constructor.
     * @param $number
     * @param array $forms ['балл', 'балла', 'баллов']
     */
    public function __construct($number, array $forms = [])
    {
        $this->number = $number;
        $this->forms = $forms;
    }

    public function __toString()
    {
        return $this->handle();
    }

    /**
     * @return string
     */
    private function handle()
    {
        $cases = [2, 0, 1, 1, 1, 2];
        return $this->forms[ ($this->number % 100 > 4 && $this->number % 100 < 20)? 2: $cases[min($this->number % 10, 5)] ];
    }
}