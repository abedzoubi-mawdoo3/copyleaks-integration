# Copyleaks Integration
This is unofficial SDK package for copyleaks.com integration
To install this package:

```
composer require mawdoo3com/copyleaks-integration
```

**Usage**:
```
<?php

require_once __DIR__ . "/vendor/autoload.php";

use MWCopyleaks\Authentication;
use MWCopyleaks\Scan;

try {
    $auth = new Authentication(ACCOUNT_EMAIL, API_KEY);
    $token = $auth->getAccessToken();
    $scan = new Scan($token);
    $text = 'Your plain text';
    $body_base64 = base64_encode($text);
    $scan_id = uniqid();
    $scan->scanByFile($body_base64, 'filename.txt', 'https://domain.com/webhook/{STATUS}/'.$scan_id, $scan_id, true);
} catch (\Exception $ex) {
    
}

```
---
