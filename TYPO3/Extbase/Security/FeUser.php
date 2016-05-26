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
     * @var fe_user
     */
    private $user = null;

    /**
     * @var fe_user groupData
     */
    private $groupData = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        if ($GLOBALS['TSFE']->fe_user->user) {
            $this->user = $GLOBALS['TSFE']->fe_user->user;
            $this->groupData = $GLOBALS['TSFE']->fe_user->groupData;
        }
    }

    /**
     * Returns the fe_user uid
     *
     * @return int
     */
    public function getUid()
    {
        return $this->user['uid'];
    }

    /**
     * Returns fe_user data
     *
     * @param null $key - If null you get the whole user data array
     * @return bool|fe_user
     */
    public function getUser($key = null)
    {
        if (null == $key) {
            return $this->user;
        } else {
            return (isset($this->user[$key])) ? $this->user[$key] : false;
        }

    }

    /**
     * Returns the whole fe_user group data
     *
     * @return array
     */
    public function getGroupData()
    {
        return $this->groupData;
    }

    /**
     * Checks if fe_user is authenticated
     *
     * @return bool
     */
    public function isAuthenticated()
    {
        return (null != $this->getUid());
    }

    /**
     * Checks if fe_user is authenticated and has given role
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return ($this->isAuthenticated() && in_array($role, $this->groupData['title']));
    }

    /**
     * Checks if fe_user is authenticated and has given role id
     *
     * @param int $role
     * @return bool
     */
    public function hasRoleId($role)
    {
        return ($this->isAuthenticated() && in_array($role, $this->groupData['uid']));
    }

}
