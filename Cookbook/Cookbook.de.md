# Cookbook

## Inhalt
- [Session](#Session)
- [FeUser](#FeUser)
- [FalUtility](#FalUtility)

## <a name="Session">Session</a>
Mit Hilfer der Session-Klasses erhält man einen einfachen Zugriff auf die TYPO3 FeUser Session.

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
Einfacher Zugriff auf die FeUser-Daten.

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
FalUtility bietet verschiedene Methoden zum Arbeiten mit FAL-Dateien ([File Abstraction Layer](https://docs.typo3.org/typo3cms/FileAbstractionLayerReference/))


```php
// get FAL objects by file uid
FalUtility::findFileReferenceObjects(array());
// init a file download by file uid
FalUtility::downloadFile($uid, $additionalHeaders = array());
```
