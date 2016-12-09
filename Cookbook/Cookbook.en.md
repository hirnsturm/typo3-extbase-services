# Cookbook

## Table of Contents
- [Session](#Session)
- [FeUser](#FeUser)
- [FalUtility](#FalUtility)
- [UserFunctions](#UserFunctions)

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

// Database methods
Session::persist();
Session::fetch();
Session::delete();
```

## <a name="FeUser">FeUser</a>
Layer for the TYPO3 fe_user.

```php
// methods
FeUser::isFeUser();
FeUser::getUserTSConfig();
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

## <a name="UserFunctions">UserFunctions</a>
```
// get extension version
lib.version = USER
lib.version {
    userFunc = Sle\TYPO3\Extbase\UserFunc\VersionUserFunc->getExtensionVersion
    # extensionKey [mandatory]
    extensionKey = my_ext_key
    # Overrides default label [optional]
    label = Version:&nbsp;
}
```
