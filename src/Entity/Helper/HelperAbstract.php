<?php
namespace Sideclick\EntityHelperBundle\Entity\Helper;

use Doctrine\ORM\EntityManager;

/**
 * Class HelperAbstract
 *
 * All Entity Helper classes should extend this class and implement a setter method named set{EntityName}
 *
 * @package Sideclick\CoreBundle\Entity\Helper
 */
abstract class HelperAbstract
{
    protected $_entityManager;
    protected $_container;

    public function __construct(EntityManager $em, $container)
    {
        $this->_entityManager = $em;
        $this->_container = $container;
    }

    public function getEntityManager()
    {
        return $this->_entityManager;
    }
    
    public function getContainer()
    {
        return $this->_container;
    }

}
