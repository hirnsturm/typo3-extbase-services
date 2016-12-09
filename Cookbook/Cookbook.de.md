# Cookbook

## Inhalt
- [Session](#Session)
- [FeUser](#FeUser)
- [FalUtility](#FalUtility)
- [UserFunctions](#UserFunctions)

## <a name="Session">Session</a>
Mit Hilfer der Session-Klasses erhält man einen einfachen Zugriff auf die TYPO3 FeUser Session.

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
Einfacher Zugriff auf die FeUser-Daten.

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
FalUtility bietet verschiedene Methoden zum Arbeiten mit FAL-Dateien ([File Abstraction Layer](https://docs.typo3.org/typo3cms/FileAbstractionLayerReference/))


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
    userFunc = Sle\TYPO3\Extbase\UserFunc\ExtensionUserFunc->getExtensionVersion
    # extensionKey [mandatory]
    extensionKey = my_ext_key
    # Overrides default label [optional]
    label = Version:&nbsp;
}
```
