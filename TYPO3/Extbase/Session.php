<?php

namespace Sle\TYPO3\Extbase;

/**
 * Session-Layer for TYPO3 Extbase fe_user session
 *
 * @author Steve Lenz <kontakt@steve-lenz.de>
 * @copyright (c) 2014, Steve Lenz
 */
class Session
{

    /**
     * Write data into fe_user session
     *
     * @param string $key
     * @param mixed $data
     * @param string $type - possible values: ses|user
     */
    public static function set($key, $data, $type = 'ses')
    {
        $sessionData = serialize($data);
        $GLOBALS['TSFE']->fe_user->setKey(self::isType($type), $key, $sessionData);
        $GLOBALS['TSFE']->fe_user->storeSessionData();
    }

    /**
     * Restore data from fe_user session
     *
     * @param string $key
     * @param string $type - possible values: ses|user
     * @return mixed
     */
    public static function get($key, $type = 'ses')
    {
        $sessionData = $GLOBALS['TSFE']->fe_user->getKey(self::isType($type), $key);

        return unserialize($sessionData);
    }

    /**
     * Checks whether a key in fe_user session exists
     *
     * @param string $key
     * @param string $type - possible values: ses|user
     * @return boolean
     */
    public static function has($key, $type = 'ses')
    {
        return ($GLOBALS['TSFE']->fe_user->getKey(self::isType($type), $key)) ? true : false;
    }

    /**
     * Removes fe_user session data by key
     *
     * @param string $key
     * @param string $type - possible values: ses|user
     */
    public static function remove($key, $type = 'ses')
    {
        $GLOBALS['TSFE']->fe_user->setKey(self::isType($type), $key, null);
        $GLOBALS['TSFE']->fe_user->storeSessionData();
    }

    /**
     * Stores fe_user session data in database
     */
    public static function persist()
    {
        $GLOBALS['TSFE']->fe_user->storeSessionData();
    }

    /**
     * Fetches fe_user session data from database
     */
    public static function fetch()
    {
        $GLOBALS['TSFE']->fe_user->fetchSessionData();
    }

    /**
     * Deletes fe_user session data from database
     */
    public static function delete()
    {
        $GLOBALS['TSFE']->fe_user->removeSessionData();
    }

    /**
     * @param string $type
     * @return mixed
     * @throws \Exception
     */
    protected static function isType($type)
    {
        if (false == in_array($type, array('ses', 'user'))) {
            throw new \Exception('Wrong session type "' . $type . '"!');
        }

        return $type;
    }

}
