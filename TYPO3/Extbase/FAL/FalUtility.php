<?php

namespace Sle\TYPO3\Extbase\FAL;

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * FAL-Utility for TYPO3 Extbase
 *
 * @author Steve Lenz <kontakt@steve-lenz.de>
 * @copyright (c) 2014, Steve Lenz
 */
class FalUtility
{

    /**
     * Finds FAL objects by uid
     *
     * @param array $fileUids - Array of File-UIDs
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public static function findFileReferenceObjects(array $fileUids)
    {
        $entities = new ObjectStorage();

        if (!empty($fileUids)) {
            $resourceFactory = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\ResourceFactory');

            foreach ($fileUids as $uid) {
                $fileReference = $resourceFactory->getFileReferenceObject($uid);
                $entities->attach($fileReference->getProperties());
            }
        }

        return $entities;
    }

    /**
     * Download a FAL-File
     *
     * @param $fileUid
     * @param array $additionalHeaders
     * @return bool|\Exception|Exception
     */
    public static function downloadFile($fileUid, $additionalHeaders = array())
    {
        $fileRepository = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
        $entity = $fileRepository->findByUid($fileUid);

        if (!$entity) {
            return false;
        }

        $properties = $entity->getProperties();

        $headers = array(
            'Pragma'                    => 'public',
            'Expires'                   => 0,
            'Cache-Control'             => 'must-revalidate, post-check=0, pre-check=0',
            'Cache-Control'             => 'public',
            'Content-Description'       => 'File Transfer',
            'Content-Type'              => $properties['mime_type'],
            'Content-Disposition'       => 'attachment; filename="' . $entity->getName() . '"',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Length'            => $properties['size'],
        );

        if (!empty($additionalHeaders)) {
            array_merge($headers, $additionalHeaders);
        }

        try {
            $response = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Mvc\\Web\\Response');

            foreach ($headers as $header => $data) {
                $response->setHeader($header, $data);
            }
            $response->sendHeaders();
            echo $entity->getContents();
            exit;
        } catch (Exception $e) {
            return $e;
        }
    }

}
