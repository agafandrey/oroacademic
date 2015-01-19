<?php

namespace Academic\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Oro\Bundle\UserBundle\Entity\User;
use Oro\Bundle\OrganizationBundle\Entity\BusinessUnit;
use Oro\Bundle\OrganizationBundle\Entity\Organization;

use Academic\Bundle\ProjectBundle\Model\ExtendProject;

/**
 * @ORM\Entity
 * @ORM\Table(name="academic_project")
 * @ORM\HasLifecycleCallbacks()
 * @Config(
 *      defaultValues={
 *          "ownership"={
 *              "owner_type"="BUSINESS_UNIT",
 *              "owner_field_name"="owner",
 *              "owner_column_name"="owner_business_unit_id",
 *              "organization_field_name"="organization",
 *              "organization_column_name"="organization_id"
 *          },
 *          "entity"={
 *              "icon"="book"
 *          }
 *      }
 * )
 */
class Project extends ExtendProject
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(name="summary", type="text")
     */
    private $summary;

    /**
     * @ORM\ManyToMany(targetEntity="\Oro\Bundle\UserBundle\Entity\User")
     *
     */
    private $participant;

    /**
     * @ORM\OneToMany(targetEntity="\Academic\Bundle\ProjectBundle\Entity\Issue", mappedBy="project")
     *
     */
    private $issues;

    /**
     * @var BusinessUnit
     * @ORM\ManyToOne(targetEntity="\Oro\Bundle\OrganizationBundle\Entity\BusinessUnit")
     * @ORM\JoinColumn(name="owner_business_unit_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $owner;

    /**
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\OrganizationBundle\Entity\Organization")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $organization;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Soap\ComplexType("dateTime", nillable=true)
     * @ConfigField(
     *      defaultValues={
     *          "entity"={
     *              "label"="oro.ui.created_at"
     *          },
     *          "importexport"={
     *              "excluded"=true
     *          }
     *      }
     * )
     */
    private $created_at;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Soap\ComplexType("dateTime", nillable=true)
     * @ConfigField(
     *      defaultValues={
     *          "entity"={
     *              "label"="oro.ui.updated_at"
     *          },
     *          "importexport"={
     *              "excluded"=true
     *          }
     *      }
     * )
     */
    private $updated_at;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->participant = new \Doctrine\Common\Collections\ArrayCollection();
        $this->issues = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return Project
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Add participant
     *
     * @param \Oro\Bundle\UserBundle\Entity\User $participant
     * @return Project
     */
    public function addParticipant(\Oro\Bundle\UserBundle\Entity\User $participant)
    {
        $this->participant[] = $participant;

        return $this;
    }

    /**
     * Remove participant
     *
     * @param \Oro\Bundle\UserBundle\Entity\User $participant
     */
    public function removeParticipant(\Oro\Bundle\UserBundle\Entity\User $participant)
    {
        $this->participant->removeElement($participant);
    }

    /**
     * Get participant
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * Add issues
     *
     * @param \Academic\Bundle\ProjectBundle\Entity\Issue $issues
     * @return Project
     */
    public function addIssue(\Academic\Bundle\ProjectBundle\Entity\Issue $issues)
    {
        $this->issues[] = $issues;

        return $this;
    }

    /**
     * Remove issues
     *
     * @param \Academic\Bundle\ProjectBundle\Entity\Issue $issues
     */
    public function removeIssue(\Academic\Bundle\ProjectBundle\Entity\Issue $issues)
    {
        $this->issues->removeElement($issues);
    }

    /**
     * Get issues
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIssues()
    {
        return $this->issues;
    }

    /**
     * @return \Oro\Bundle\OrganizationBundle\Entity\BusinessUnit
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param \Oro\Bundle\OrganizationBundle\Entity\BusinessUnit $owningBusinessUnit
     * @return Project
     */
    public function setOwner($owningBusinessUnit)
    {
        $this->owner = $owningBusinessUnit;

        return $this;
    }

    /**
     * Set organization
     *
     * @param \Oro\Bundle\OrganizationBundle\Entity\Organization $organization
     * @return Project
     */
    public function setOrganization(Organization $organization = null)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get organization
     *
     * @return \Oro\Bundle\OrganizationBundle\Entity\Organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Project
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Project
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Pre persist event listener
     *
     * @ORM\PrePersist
     */
    public function beforeSave()
    {
        $this->created_at = new \DateTime('now', new \DateTimeZone('UTC'));
        $this->updated_at = new \DateTime('now', new \DateTimeZone('UTC'));
    }

    /**
     * Pre update event handler
     *
     * @ORM\PreUpdate
     */
    public function doPreUpdate()
    {
        $this->updated_at = new \DateTime('now', new \DateTimeZone('UTC'));
    }
}
