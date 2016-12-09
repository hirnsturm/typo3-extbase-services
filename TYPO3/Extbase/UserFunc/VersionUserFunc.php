<?php

namespace Sle\TYPO3\Extbase\UserFunc;

use TYPO3\CMS\Core\Package\Package;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extensionmanager\Utility\ListUtility;


/**
 * Class TcaUserFunc
 *
 * @package Sle\TYPO3\Extbase
 */
class VersionUserFunc
{

    /**
     * Returns the version of the given extension
     *
     * @param  string          Empty string (no content to process)
     * @param  array           TypoScript configuration
     * @return string          Version
     *
     * Example:
     * lib.version = USER
     * lib.version {
     *      userFunc = Sle\TYPO3\Extbase\UserFunc\VersionUserFunc->getExtensionVersion
     *      # extensionKey [mandatory]
     *      extensionKey = xm_tools
     *      # Overrides default label [optional]
     *      label = Version:&nbsp;
     * }
     *
     */
    public function getExtensionVersion($content, $conf)
    {
        $version = null;
        $label = (array_key_exists('label', $conf)) ? $conf['label'] : 'Version:&nbsp;';
        /** @var ObjectManager $om */
        $om = GeneralUtility::makeInstance(ObjectManager::class);
        /** @var ListUtility $listUtility */
        $listUtility = $om->get(ListUtility::class);

        if (array_key_exists('extensionKey', (array)$conf)) {

            $packages = $listUtility->getAvailableExtensions();

            if (array_key_exists($conf['extensionKey'], $packages)) {
                /** @var Package $ext */
                $package = $listUtility->getExtension($conf['extensionKey']);

                if ($package instanceof Package) {
                    $version = $package->getValueFromComposerManifest('version');
                }
            }
        }

        return (null == $version) ? $label . 'No version found.' : $label . $version;
    }

}
