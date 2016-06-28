# Cookbook

## Table of Contents
- [Session](#Session)
- [FeUser](#FeUSer)
- [FalUtility](#FalUtility)

## <a name="Session">Session</a>
With Session you have an easy access to the TYPO3 FeUser Session.

```php
// init session access
$session = new Sle\TYPO3\Extbase\Session();

// write data into session
$session->set('your-data-key', $data);

// check whether key in session exists
if (true == $session->has('your-data-key')) {
	$data = $session->get('your-data-key');
}

// remove data from session
$session->remove('your-data-key');
```

## <a name="FeUser">FeUser</a>
Layer for the TYPO3 fe_user.

```php
// init FeUser access
$feUser = new Sle\TYPO3\Extbase\Security\FeUser();

// methods
$feUser->getUid();
$feUser->getUser();
$feUser->getUser('username');
$feUser->getGroupData();
$feUser->isAuthenticated();
$feUser->hasRole($role);
$feUser->hasRoleId($id);
```

## <a name="FalUtility">FalUtility</a>
Offers methods for working with FAL files

```php
// get FAL objects by file uid
FalUtility::findFileReferenceObjects(array());
// init a file download by file uid
FalUtility::downloadFile($uid, $additionalHeaders = array());
```
