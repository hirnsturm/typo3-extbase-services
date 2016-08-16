<?php

namespace Sle\TYPO3\Extbase\Domain\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class EntityUtility
 *
 * @package Sle\TYPO3\Extbase\Domain\Utility
 * @author Steve Lenz <kontakt@steve-lenz.de>
 * @copyright (c) 2015, Steve Lenz
 */
class EntityUtility
{

    /**
     * @param mixed $value
     * @param string $fullQualifiedClassName - e.g. \\My\\App\\Entity
     * @return mixed
     */
    public static function getEntityByValueAndClass($value, $fullQualifiedClassName)
    {
        if (is_a($value, $fullQualifiedClassName)) {
            return $value;
        } else {
            $om = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
            $repo = $om->get($fullQualifiedClassName . 'Repository');
            $entity = $repo->findByUid($value);
            return $entity;
        }
    }

}
