<?php

namespace Academic\Bundle\ProjectBundle\Entity\Issue;

use Doctrine\ORM\Mapping as ORM;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Academic\Bundle\ProjectBundle\Model\Issue\ExtendActivity;

/**
 * @ORM\Entity
 * @ORM\Table(name="academic_issue_activity")
 * @Config(
 *      defaultValues={
 *          "ownership"={
 *              "owner_field_name"="owner",
 *              "owner_column_name"="owner_id"
 *          },
 *          "entity"={
 *              "icon"="book"
 *          }
 *      }
 * )
 */
class Activity extends ExtendActivity
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="event", type="string", length=255)
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="\Oro\Bundle\UserBundle\Entity\User")
     *
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="\Academic\Bundle\ProjectBundle\Entity\Issue", inversedBy="activities")
     *
     */
    private $issue;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     *
     */
    private $created_at;

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
     * Set event
     *
     * @param string $event
     * @return Activity
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Activity
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
     * Set user
     *
     * @param \Oro\Bundle\UserBundle\Entity\User $user
     * @return Activity
     */
    public function setUser(\Oro\Bundle\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Oro\Bundle\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set issue
     *
     * @param \Academic\Bundle\ProjectBundle\Entity\Issue $issue
     * @return Activity
     */
    public function setIssue(\Academic\Bundle\ProjectBundle\Entity\Issue $issue = null)
    {
        $this->issue = $issue;

        return $this;
    }

    /**
     * Get issue
     *
     * @return \Academic\Bundle\ProjectBundle\Entity\Issue
     */
    public function getIssue()
    {
        return $this->issue;
    }
}
