<?php

namespace Academic\Bundle\ProjectBundle\Entity\Issue;

use Doctrine\ORM\Mapping as ORM;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Academic\Bundle\ProjectBundle\Model\Issue\ExtendComment;

/**
 * @ORM\Entity
 * @ORM\Table(name="academic_issue_comment")
 * @Config(
 *      defaultValues={
 *          "ownership"={
 *              "owner_type"="USER",
 *              "owner_field_name"="user",
 *              "owner_column_name"="owner_id"
 *          },
 *          "entity"={
 *              "icon"="book"
 *          }
 *      }
 * )
 */
class Comment extends ExtendComment
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="body", type="string", length=30)
     */
    private $body;

    /**
     * @ORM\ManyToOne(targetEntity="\Oro\Bundle\UserBundle\Entity\User")
     *
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="\Academic\Bundle\ProjectBundle\Entity\Issue", inversedBy="comments")
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
     * Set body
     *
     * @param string $body
     * @return Comment
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Comment
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
     * @return Comment
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
     * @return Comment
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
