# TYPO3 Extbase Extension Services

## What does it do?
A set of usefull services for TYPO3 Extbase extensions.

## Requirements
- PHP 5.5 or heigher
- TYPO3 6 or 7

## Installation
```bash
composer require sle/typo3-exceptionhandler
```

## Cookbook

### Session
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
