<?php

namespace Sle\TYPO3\Extbase\FAL;

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * FAL-Helper for TYPO3 Extbase
 *
 * @author Steve Lenz <kontakt@steve-lenz.de>
 * @copyright (c) 2014, Steve Lenz
 */
class FalHelper
{

    /**
     * Finds FAL objects by uid
     *
     * @param string $elementUids - UIDs as CSV
     * @return array
     */
    protected function findFileReferenceObjects($elementUids)
    {
        $elements = array();
        $sliderItemUids = explode(',', $elementUids);

        if (!empty($sliderItemUids)) {
            $resourceFactory = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\ResourceFactory');
            foreach ($sliderItemUids as $uid) {
                $fileReference = $resourceFactory->getFileReferenceObject($uid);
                $elements[$uid] = $fileReference->getProperties();
            }
        }

        return $elements;
    }

    /**
     * Download a FAL-File
     *
     * @param int $uid uid of originalFile (originalResource.originalFile.properties.uid)
     * @return boolean|\Xima\XmBildarchiv\Controller\Exception
     */
    public function downloadFile($uid)
    {
        $fileRepository = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
        $entity = $fileRepository->findByUid($uid);

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
