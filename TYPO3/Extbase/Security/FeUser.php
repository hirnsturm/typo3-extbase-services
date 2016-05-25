<?php

namespace Sle\TYPO3\Extbase\Security;

/**
 * Helper for FeUser
 *
 * @author Steve Lenz <kontakt@steve-lenz.de>
 * @copyright (c) 2015, Steve Lenz
 */
class FeUser
{

    /**
     * @var FeUser
     */
    private $user = null;

    /**
     * @var FeUser groupData
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
     * @return int
     */
    public function getUid()
    {
        return $this->user['uid'];
    }

    /**
     * @return array
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return array
     */
    public function getGroupData()
    {
        return $this->groupData;
    }

    /**
     * Checks if fe_user is authenticated.
     *
     * @return bool
     */
    public function feUserIsAuthenticated()
    {
        return (null != $this->getUid());
    }

    /**
     * Checks if fe_user is authenticated and has given role.
     *
     * @param string $role
     * @return bool
     */
    public function feUserHasRole($role)
    {
        return ($this->feUserIsAuthenticated() && in_array($role, $this->groupData['title']));
    }

    /**
     * Checks if fe_user is authenticated and has given role id.
     *
     * @param int $role
     * @return bool
     */
    public function feUserHasRoleId($role)
    {
        return ($this->feUserIsAuthenticated() && in_array($role, $this->groupData['uid']));
    }

}
