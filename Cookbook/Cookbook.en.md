# Cookbook

## Table of Contents
- [Session](#Session)
- [FeUser](#FeUser)
- [FalUtility](#FalUtility)

## <a name="Session">Session</a>
With Session you have an easy access to the TYPO3 FeUser Session.

```php
// write data into session
Session::set('your-data-key', $data);

// check whether key in session exists
if (true == Session::has('your-data-key')) {
	$data = Session::get('your-data-key');
}

// remove data from session
Session::remove('your-data-key');
Session::removeAll();
```

## <a name="FeUser">FeUser</a>
Layer for the TYPO3 fe_user.

```php
// methods
FeUser::isFeUser();
FeUser::getUid();
FeUser::getUser();
FeUser::getUser('username');
FeUser::getGroupData();
FeUser::isAuthenticated();
FeUser::hasRole($role);
FeUser::hasRoleId($id);
```

## <a name="FalUtility">FalUtility</a>
Offers methods for working with FAL files

```php
// get FAL objects by file uid
FalUtility::findFileReferenceObjects(array());
// init a file download by file uid
FalUtility::downloadFile($uid, $additionalHeaders = array());
```
