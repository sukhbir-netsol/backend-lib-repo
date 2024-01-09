# PHP SDK to integrate with supplier portal APIs

This SDK is used to integrate with supplier portal APIs for various User Authentication methods for ex:
User registration,Password reset,Reset 2FA etc.

## Installation

Use the composer to install this package.

```bash
composer require "sukhbir-netsol/firebase-auth-sdk": "dev-main"
```

## Usage

```php

# Please add this variable in the .env file which includes the end-point of supplier portal API.
SUPPLIER_NODE_SITE_URL='http://localhost:3000/portal/v1/users/'

# Include below your code
use FirebaseAuth\FirebaseAuth;

# Initialize Firebase authentication with the authorization token
FirebaseAuth::initialize($authorizationToken);

# Call the Firebase registration method with the provided user details
FirebaseAuth::register($displayName, $email);

```


## License

[MIT](https://choosealicense.com/licenses/mit/)