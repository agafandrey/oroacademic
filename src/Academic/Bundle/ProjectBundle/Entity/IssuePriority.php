<?php

namespace Academic\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Academic\Bundle\ProjectBundle\Model\ExtendIssuePriority;

/**
 * @ORM\Entity
 * @ORM\Table(name="academic_issue_status")
 * @Config(
 *      defaultValues={
 *          "entity"={
 *              "icon"="book"
 *          }
 *      }
 * )
 */
class IssuePriority extends ExtendIssuePriority
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="weight", type="integer", unique=true)
     */
    private $weight;

    /**
     * @ORM\Column(name="label", type="string", length=20, unique=true)
     */
    private $label;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return IssuePriority
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return IssuePriority
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
}
