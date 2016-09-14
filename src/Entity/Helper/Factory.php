<?php
namespace Sideclick\CoreBundle\Entity\Helper;

use Doctrine\ORM\EntityManager;

/**
 * Class Factory
 *
 * Facilitates the instantiation of the Entity Helper Class for a given Entity
 *
 * @package Sideclick\CoreBundle\Entity\Helper
 */
class Factory
{
    protected $_entityManager;
    
    protected $_container;

    /**
     * Constructor takes an Entity Manager that will be passed to the constructor of the Entity Helper
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em, $container)
    {
        $this->_entityManager = $em;
        
        $this->_container = $container;
    }

    /**
     * Takes the Given entity and returns an instantiation of its Entity Helper class
     *
     * @param $entity
     * @return mixed
     */
    public function getEntityHelper($entity)
    {
        // get the class name of the given entity, including namespace
        // Note that we use doctrine because the entity might be a proxy
        $entityFullClassName = \Doctrine\Common\Util\ClassUtils::getClass($entity);;

        // split out the namespace and class name
        $parsedClassName = $this->parseClassname($entityFullClassName);

        // prepare the expected class name of the helper class for this entity
        $helperClassName = $parsedClassName['namespace'] . '\\Helper\\' . $parsedClassName['classname'] . 'Helper';

        // initiate the Helper Class object
        $helperObject = new $helperClassName($this->_entityManager, $this->_container);

        // sent the entity to the helper class via the expected setter method
        $helperObject->{'set'.$parsedClassName['classname']}($entity);

        // return the helper object
        return $helperObject;
    }

    /**
     * Splits a php classname into an array holding the namespace and the classname
     *
     * @param $name
     * @return array
     */
    function parseClassname ($name)
    {
        return array(
            'namespace' => join('\\',array_slice(explode('\\', $name), 0, -1)),
            'classname' => join('', array_slice(explode('\\', $name), -1)),
        );
    }
}