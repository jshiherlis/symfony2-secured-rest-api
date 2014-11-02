<?php

namespace UAW\Bundle\RestBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 *
 * @ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;

    /**
     * @var ArrayCollection $userLanguages
     *
     * @ORM\OneToMany(targetEntity="\UAW\Bundle\RestBundle\Entity\Item", mappedBy="user", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Expose
     */
    private $items;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }
}