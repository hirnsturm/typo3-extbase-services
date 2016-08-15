<?php

namespace Sle\TYPO3\Extbase;

/**
 * Session-Handler for TYPO3 Extbase
 *
 * @author Steve Lenz <kontakt@steve-lenz.de>
 * @copyright (c) 2014, Steve Lenz
 */
class Session
{

    /**
     * Write data into session
     *
     * @param string $key
     * @param mixed $data
     */
    public static function set($key, $data)
    {
        $sessionData = serialize($data);
        $GLOBALS['TSFE']->fe_user->setKey('ses', $key, $sessionData);
        $GLOBALS['TSFE']->fe_user->storeSessionData();
    }

    /**
     * Restore data from session
     *
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        $sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', $key);

        return unserialize($sessionData);
    }

    /**
     * Checks whether a key in session exists
     *
     * @param string $key
     * @return boolean
     */
    public static function has($key)
    {
        return ($GLOBALS['TSFE']->fe_user->getKey('ses', $key)) ? true : false;
    }

    /**
     * Removes session data by key
     *
     * @param string $key
     */
    public static function remove($key)
    {
        $GLOBALS['TSFE']->fe_user->setKey('ses', $key, null);
        $GLOBALS['TSFE']->fe_user->storeSessionData();
    }

    /**
     * Removes all session data
     */
    public static function removeAll()
    {
        $GLOBALS['TSFE']->fe_user->removeSessionData();
    }

}
