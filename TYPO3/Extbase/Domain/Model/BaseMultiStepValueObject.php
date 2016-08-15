<?php

namespace Sle\TYPO3\Extbase\Domain\Model;

/**
 * TYPO3 BaseMultiStepValueObject
 *
 * @author Steve Lenz <kontakt@steve-lenz.de>
 * @copyright (c) 2015, Steve Lenz
 */
class BaseMultiStepValueObject extends BaseValueObject
{

    /**
     * Count of steps
     *
     * @var integer
     */
    protected $steps = 2;

    /**
     * Current step
     *
     * @var integer
     */
    protected $step = 1;

    /**
     * Returns the steps
     *
     * @return string $steps
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * Sets the steps
     *
     * @param string $steps
     * @return void
     */
    public function setSteps($steps)
    {
        $this->steps = $steps;
    }

    /**
     * Returns the step
     *
     * @return string $step
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * Sets the step
     *
     * @param string $step
     * @return void
     */
    public function setStep($step)
    {
        $this->step = $step;
    }

    /**
     * Returns the nextStep
     *
     * @return string $nextStep
     */
    public function getNextStep()
    {
        return $this->step + 1;
    }

    /**
     * Returns the previousStep
     *
     * @return string $previousStep
     */
    public function getPreviousStep()
    {
        return ($this->step <= 1) ? null : $this->step - 1;
    }

}
