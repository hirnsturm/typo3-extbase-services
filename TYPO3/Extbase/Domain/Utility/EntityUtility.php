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

    /**
     * Merges array data into an entity
     *
     * @param object $targetEntity
     * @param array $array
     * @return mixed
     */
    public static function mergeArrayIntoEntity($targetEntity, $array)
    {
        foreach ($array as $property => $value) {
            if (!empty($value)) {
                if (is_a($targetEntity->{'get' . ucfirst($property)}(),
                    '\\TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage')
                ) {
                    $targetEntity->{'set' . ucfirst($property)}(new ObjectStorage());
                    if (is_array($value)) {
                        $singular = (preg_match('~s$~i', $property) > 0) ? rtrim($property, 's') : sprintf('%ss',
                            $property);
                        foreach ($value as $item) {
                            $targetEntity->{'add' . ucfirst($singular)}($item);
                        }
                    }
                } else {
                    $targetEntity->{'set' . ucfirst($property)}($value);
                }
            }
        }

        return $targetEntity;
    }

    /**
     * @param $entity
     * @param $array
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public static function arrayToObjectStorage($entity, $array)
    {
        $storage = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage');
        foreach ($array as $item) {
            $storage->attach(EntityUtility::mergeArrayIntoEntity($entity, $item));
        }

        return $storage;
    }


}
