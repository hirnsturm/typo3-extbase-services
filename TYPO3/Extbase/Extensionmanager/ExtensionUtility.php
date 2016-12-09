<?php

namespace Sle\TYPO3\Extbase\Extensionmanager;

use TYPO3\CMS\Core\Package\Package;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extensionmanager\Utility\ListUtility;


/**
 * Class ExtensionUtility
 *
 * @package Sle\TYPO3\Extbase\Extensionmanager
 */
class ExtensionUtility
{

    /**
     * Returns the version of the given extension
     *
     * @param $extensionKey
     * @return mixed|null
     */
    public static function getExtensionVersion($extensionKey)
    {
        $version = null;
        /** @var ObjectManager $om */
        $om = GeneralUtility::makeInstance(ObjectManager::class);
        /** @var ListUtility $listUtility */
        $listUtility = $om->get(ListUtility::class);

        $packages = $listUtility->getAvailableExtensions();

        if (array_key_exists($extensionKey, $packages)) {
            /** @var Package $ext */
            $package = $listUtility->getExtension($extensionKey);

            if ($package instanceof Package) {
                $version = $package->getValueFromComposerManifest('version');
            }
        }

        return $version;
    }

}
