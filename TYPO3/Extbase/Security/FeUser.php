<?php

namespace Sle\TYPO3\Extbase\Security;

/**
 * Layer for the TYPO3 fe_user
 *
 * @author Steve Lenz <kontakt@steve-lenz.de>
 * @copyright (c) 2015, Steve Lenz
 */
class FeUser
{

    /**
     * Checks whether fe_user exists
     *
     * @return bool
     */
    public static function isFeUser()
    {
        return ($GLOBALS['TSFE']->fe_user->user) ? true : false;
    }

    /**
     * Returns the fe_user uid
     *
     * @return int
     */
    public static function getUid()
    {
        return $GLOBALS['TSFE']->fe_user->user['uid'];
    }

    /**
     * Returns fe_user data
     *
     * @param null $key - If null you get the whole user data array
     * @return mixed - false if key not exists
     */
    public static function getUser($key = null)
    {
        if (null == $key) {
            return $GLOBALS['TSFE']->fe_user->user;
        } else {
            return (isset($GLOBALS['TSFE']->fe_user->user[$key])) ? $GLOBALS['TSFE']->fe_user->user[$key] : false;
        }

    }

    /**
     * Returns the whole fe_user group data
     *
     * @return array
     */
    public static function getGroupData()
    {
        return $GLOBALS['TSFE']->fe_user->groupData;
    }

    /**
     * Checks whether fe_user is authenticated
     *
     * @return bool
     */
    public static function isAuthenticated()
    {
        return (self::isFeUser() && null != self::getUid());
    }

    /**
     * Checks whether fe_user is authenticated and has given role
     *
     * @param string $role
     * @return bool
     */
    public static function hasRole($role)
    {
        return (self::isFeUser()
            && self::isAuthenticated()
            && in_array($role, $GLOBALS['TSFE']->fe_user->groupData['title'])
        );
    }

    /**
     * Checks whether fe_user is authenticated and has given role id
     *
     * @param int $role
     * @return bool
     */
    public static function hasRoleId($role)
    {
        return (self::isFeUser()
            && self::isAuthenticated()
            && in_array($role, $GLOBALS['TSFE']->fe_user->groupData['uid'])
        );
    }

}
