# EntityHelperBundle
Bundle for Symfony 2.6+ which introduces entity helper classes for each Doctrine entity in your bundle

## Installation

### Step 1: Add the following to the "require" section of composer.json

```
"sideclick/entity-helper-bundle": "dev-master"
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Sideclick\EntityHelperBundle\SideclickEntityHelperBundle(),
    );
}
```
## Usage

Entity helper classes should be defined in the /Entity/Helper directory, here is the basic structure of an Entity Helper class for an entity named 'User':

``` php
<?php
//Sideclick\CoreBundle\Entity\Helper\UserHelper.php

namespace Sideclick\CoreBundle\Entity\Helper;

use Sideclick\CoreBundle\Entity\Helper\HelperAbstract;
use Sideclick\CoreBundle\Entity\User;

class UserHelper extends HelperAbstract
{
    protected $_user;

    public function setUser(User $user)
    {
        $this->_user = $user;
    }
    
}
```

There is a service named sc_core.entity_helper_factory which makes it easy to get an instance of an Entity Helper for an object, for example, in your controller you could do:

``` php
$userHelper = $this->get('sideclick_entity_helper.twig.entity_helper_extension')->getEntityHelper($user);
```

Also, there is a twig function to get a helper in your templates:

``` twig
get_entity_helper(user)
```



More documentation to come...
