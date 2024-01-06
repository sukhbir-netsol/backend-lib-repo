# SDK to use the Firebase function

This SDK is used to register on Firebase by consuming API developed in the node using Firebase Admin SDK.

## Installation

Use the composer to install this package.

```bash
composer require "sukhbir-netsol/firebase-auth-sdk": "dev-main"
```

## Usage

```php

# Please add this variable in the .env file which includes the path of node API. 
# It is used to register on Firebase using the Firebase admin SDK function.
SUPPLIER_NODE_SITE_URL='http://localhost:3000/api/v1/'

# Include below your code
use FirebaseAuth\FirebaseAuth;

# Initialize Firebase authentication with the authorization token
FirebaseAuth::initialize($authorizationToken);

# Call the Firebase registration method with the provided user details
FirebaseAuth::register($displayName, $email);

```


## License

[MIT](https://choosealicense.com/licenses/mit/)