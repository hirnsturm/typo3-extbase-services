<?php

namespace Sle\TYPO3\Extbase\Domain\Model;

use \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject;

/**
 * TYPO3 BaseValueObject
 *
 * @author Steve Lenz <kontakt@steve-lenz.de>
 * @copyright (c) 2015, Steve Lenz
 */
class BaseValueObject extends AbstractValueObject
{

    /**
     * Returns the UIDs of releated entites as array
     *
     * @param string $property
     * @return array
     */
    public function getCheckedUidsAsArray($property)
    {
        $array = array();
        $entities = $this->{'get' . ucfirst($property)}();

        foreach ($entities as $item) {
            $array[$item->getUid()] = $item->getUid();
        }

        return $array;
    }

    /**
     * Checks if a property has value
     *
     * @param mixed $property array|string
     * @return boolean
     */
    public function has($property)
    {
        if (is_array($property)) {
            foreach ($property as $item) {
                if (is_a($this->{$item}, '\\TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage')) {
                    return ($this->{$item}->count()) ? true : false;
                } else {
                    return (!empty($this->{$item})) ? true : false;
                }
            }
        } else {
            if (is_a($this->{$property}, '\\TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage')) {
                return ($this->{$property}->count()) ? true : false;
            } else {
                return (!empty($this->{$property})) ? true : false;
            }
        }
    }

}
