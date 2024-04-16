<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
use Fulll\App\Calculator;

class FeatureContext implements Context
{

    private array $vars;
    
    /**
     * @When I multiply :a by :b into :var
     */
    public function iMultiply(int $a, int $b, string $var): void
    {
        $calculator = new Calculator();
        $value = $calculator->multiply($a, $b);
        $this->setVar($var);
        $this->setVarValue($var, $value);
    }

    /**
     * @Then :var should be equal to :value
     */
    public function aShouldBeEqualTo(string $var, int $value): void
    {
        if ($value !== $this->getVar($var)) {
            throw new \RuntimeException(sprintf('%s is expected to be equal to %s, got %s', $var, $value, $this->getVar($var)));
        }
    }
    

    private function setVar(string $var): void
    {
        $this->vars[$var] = null;
    }

    private function getVar(string $var): int
    {
        return $this->vars[$var];
    }

    private function setVarValue(string $var, int $value): void
    {
        $this->vars[$var] = $value;
    }


}
