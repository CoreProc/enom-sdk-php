# Installation

Add this on your `composer.json`:

    "require": {
        "coreproc/enom-sdk-php": "dev-master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url":  "https://git.coreproc.ph/coreproc/enom-sdk-php.git"
        }
    ]
    
# Laravel 5.x Integration

Add this line in the `providers` array in `config/app.php`:

    'providers' => [
        // Other Service Providers
    
        Coreproc\Enom\Providers\EnomServiceProvider::class,
    ],
    
Add these lines in the `facades` array in `config/app.php`:

    'facades' => [
        // Other Facades
    
        'Tld' => Coreproc\Enom\Facades\Tld::class
        'Domain' => Coreproc\Enom\Facades\Domain::class,
    ],
    
Then run this command to publish the config file:

    php artisan vendor:publish --provider="Coreproc\Enom\Providers\EnomServiceProvider"
    
# Usage

Set up the client

    $enom = new Enom('user-id', 'password');

## TLDs

    $tld = new Tld($enom);
    
    try {
        $tld->authorize(['com', 'net', 'io']);
    } catch (Coreproc\Enom\EnomApiException $e) {
        var_dump($e->getErrors());
    }
    
### Methods

Authorize TLDs

    authorize(array $tlds)
    
Remove TLDs

    remove(array $tlds)
    
Get TLD list

    getList()
    
## Domains

    $domain = new Domain($enom);
    
    try {
        $domain->check('example', 'com');
    } catch (Coreproc\Enom\EnomApiException $e) {
        var_dump($e->getErrors());
    }
    
### Methods

    check($sld, $tld)
    
    getNameSpinner($sld, $tld, $options = [])
    
    getExtendedAttributes($tld)
    
    purchase($sld, $tld, $extendedAttributes = [])
    
    getStatus($sld, $tld, $orderId)
    
    getList()
    
    getInfo($sld, $tld)
    
    setContactInformation($sld, $tld, $contactInfo = [])
    
    getContactInformation($sld, $tld)
    
    getWhoIsContactInformation($sld, $tld)

