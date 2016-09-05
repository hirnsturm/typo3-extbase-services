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
     * Transforms an array into ObjectStorage
     *
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

    /**
     * Merges two equal entities into the target entity
     *
     * @param $targetEntity
     * @param $mergeEntity
     * @return mixed
     */
    public static function mergeEntities($targetEntity, $mergeEntity)
    {
        $reflect = new \ReflectionClass($mergeEntity);
        $properties = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {

            if (!method_exists($mergeEntity, 'get' . ucfirst($property->getName()))) {
                continue;
            }

            $value = $mergeEntity->{'get' . ucfirst($property->getName())}();

            if (is_a($value, '\\TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage')) {
                $targetEntity->{'set' . ucfirst($property->getName())}(new ObjectStorage());
                $singular = (preg_match('~s$~i', $property->getName()) > 0)
                    ? rtrim($property->getName(), 's')
                    : sprintf('%ss', $property->getName());
                foreach ($value->toArray() as $item) {
                    $targetEntity->{'add' . ucfirst($singular)}($item);
                }
            } elseif (!empty(trim($value))) {
                $targetEntity->{'set' . ucfirst($property->getName())}($value);
            }
        }

        return $targetEntity;
    }

}
