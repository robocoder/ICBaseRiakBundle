# InstaClick Base Riak Bundle

*IMPORTANT NOTICE:* This bundle is still under development. Any changes will
be done without prior notice to consumers of this package. Of course this
code will become stable at a certain point, but for now, use at your own risk.

## Introduction

This bundle provides Riak support to Symfony2 applications.

This bundle requires that you are using, at least, Symfony 2.2.

## Installation

Installing this bundle can be done through these simple steps:

1. Add this bundle to your project as a composer dependency:
```javascript
    // composer.json
    {
        // ...
        require-dev: {
            // ...
            "instaclick/base-riak-bundle": "dev-master"
        }
    }
```

2. Add this bundle in your application kernel:
```php
    // application/ApplicationKernel.php
    public function registerBundles()
    {
        // ...
        $bundles[] = new IC\Bundle\Base\RiakBundle\ICBaseRiakBundle();

        return $bundles;
    }
```

3. Double check if the bundle is configured correctly:
```yaml
# application/config/ic_base_riak.yml
    ic_base_riak:
    default_connection: 'default'
    connections:
        default:
            host: 'cache-server'
            port: 8087
    buckets:
        the_manolo_bucket: ~
```

4. Create a service and inject it into the desired service
```xml
<services>
        <service id="Acme.cache.manolo"
                 class="Doctrine\Common\Cache\RiakCache">
            <argument type="service" id="ic_base_riak.bucket.the_manolo_bucket"/>
            <call method="setNamespace">
                <argument>the_manolo_bucket</argument>
            </call>
        </service>

        <service id="Acme.service.manolo" class="Acme\Service\Manolo">
            <call method="setCachepProvider">
                <argument type="service" id="ic_base_riak.bucket.the_manolo_bucket" />
            </call>
        </service>
</services>
```

## Usage

Check the [PHP-Riak extension Github Page](https://github.com/php-riak/php_riak) or the [Doctrine Cache Interface](https://github.com/doctrine/cache/blob/master/lib/Doctrine/Common/Cache/Cache.php) for a better undestanding of the Cache API.

