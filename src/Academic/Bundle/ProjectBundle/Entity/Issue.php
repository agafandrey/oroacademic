<?php

namespace Academic\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Academic\Bundle\ProjectBundle\Model\ExtendIssue;

/**
 * @ORM\Entity
 * @ORM\Table(name="academic_issue")
 * @Config(
 *      defaultValues={
 *          "ownership"={
 *              "owner_type"="BUSINESS_UNIT",
 *              "owner_field_name"="owner",
 *              "owner_column_name"="owner_id"
 *          },
 *          "entity"={
 *              "icon"="book"
 *          }
 *      }
 * )
 */
class Issue extends ExtendIssue
{
    private $type_subtask = array(array('code' => 'SUB_TASK', 'label' => 'Subtask'));

    private $types = array(
        array('code' => 'BUG', 'label' => 'Bug'),
        array('code' => 'TASK', 'label' => 'Task'),
        array('code' => 'STORY', 'label' => 'Story'),
    );

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="issue")
     *
     */
    private $project;

    /**
     * @ORM\Column(name="code", type="string", length=30)
     */
    private $code;

    /**
     * @ORM\Column(name="summary", type="string", length=250)
     */
    private $summary;

    /**
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\Column(name="type", type="string", length=30)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="\Academic\Bundle\ProjectBundle\Entity\IssueStatus")
     *
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="\Academic\Bundle\ProjectBundle\Entity\IssuePriority")
     *
     */
    private $priority;

    /**
     * @ORM\ManyToOne(targetEntity="\Academic\Bundle\ProjectBundle\Entity\IssueResolution")
     *
     */
    private $resolution;

    /**
     * @ORM\ManyToOne(targetEntity="\Oro\Bundle\UserBundle\Entity\User")
     *
     */
    private $reporter;

    /**
     * @ORM\ManyToOne(targetEntity="\Oro\Bundle\UserBundle\Entity\User")
     *
     */
    private $assignee;

    /**
     * @ORM\ManyToMany(targetEntity="\Oro\Bundle\UserBundle\Entity\User")
     *
     */
    private $collaborators;

    /**
     * @ORM\OneToMany(targetEntity="\Academic\Bundle\ProjectBundle\Entity\Issue\Comment", mappedBy="issue")
     *
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="\Academic\Bundle\ProjectBundle\Entity\Issue\Activity", mappedBy="issue")
     *
     */
    private $activities;

    /**
     * @ORM\ManyToOne(targetEntity="\Academic\Bundle\ProjectBundle\Entity\Issue", inversedBy="child_issues")
     *
     */
    private $parent_issue;

    /**
     * @ORM\OneToMany(targetEntity="\Academic\Bundle\ProjectBundle\Entity\Issue", mappedBy="parent_issue")
     *
     */
    private $child_issues;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     *
     */
    private $created_at;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     *
     */
    private $updated_at;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->collaborators = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->activities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->child_issues = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set code
     *
     * @param string $code
     * @return Issue
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return Issue
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
     * Set description
     *
     * @param string $description
     * @return Issue
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Issue
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Issue
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
     * @return Issue
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
     * Set project
     *
     * @param \Academic\Bundle\ProjectBundle\Entity\Project $project
     * @return Issue
     */
    public function setProject(\Academic\Bundle\ProjectBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Academic\Bundle\ProjectBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set status
     *
     * @param \Academic\Bundle\ProjectBundle\Entity\IssueStatus $status
     * @return Issue
     */
    public function setStatus(\Academic\Bundle\ProjectBundle\Entity\IssueStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Academic\Bundle\ProjectBundle\Entity\IssueStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set priority
     *
     * @param \Academic\Bundle\ProjectBundle\Entity\IssuePriority $priority
     * @return Issue
     */
    public function setPriority(\Academic\Bundle\ProjectBundle\Entity\IssuePriority $priority = null)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return \Academic\Bundle\ProjectBundle\Entity\IssuePriority
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set resolution
     *
     * @param \Academic\Bundle\ProjectBundle\Entity\IssueResolution $resolution
     * @return Issue
     */
    public function setResolution(\Academic\Bundle\ProjectBundle\Entity\IssueResolution $resolution = null)
    {
        $this->resolution = $resolution;

        return $this;
    }

    /**
     * Get resolution
     *
     * @return \Academic\Bundle\ProjectBundle\Entity\IssueResolution
     */
    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * Set reporter
     *
     * @param \Oro\Bundle\UserBundle\Entity\User $reporter
     * @return Issue
     */
    public function setReporter(\Oro\Bundle\UserBundle\Entity\User $reporter = null)
    {
        $this->reporter = $reporter;

        return $this;
    }

    /**
     * Get reporter
     *
     * @return \Oro\Bundle\UserBundle\Entity\User
     */
    public function getReporter()
    {
        return $this->reporter;
    }

    /**
     * Set assignee
     *
     * @param \Oro\Bundle\UserBundle\Entity\User $assignee
     * @return Issue
     */
    public function setAssignee(\Oro\Bundle\UserBundle\Entity\User $assignee = null)
    {
        $this->assignee = $assignee;

        return $this;
    }

    /**
     * Get assignee
     *
     * @return \Oro\Bundle\UserBundle\Entity\User
     */
    public function getAssignee()
    {
        return $this->assignee;
    }

    /**
     * Add collaborators
     *
     * @param \Oro\Bundle\UserBundle\Entity\User $collaborators
     * @return Issue
     */
    public function addCollaborator(\Oro\Bundle\UserBundle\Entity\User $collaborators)
    {
        $this->collaborators[] = $collaborators;

        return $this;
    }

    /**
     * Remove collaborators
     *
     * @param \Oro\Bundle\UserBundle\Entity\User $collaborators
     */
    public function removeCollaborator(\Oro\Bundle\UserBundle\Entity\User $collaborators)
    {
        $this->collaborators->removeElement($collaborators);
    }

    /**
     * Get collaborators
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCollaborators()
    {
        return $this->collaborators;
    }

    /**
     * Add comments
     *
     * @param \Academic\Bundle\ProjectBundle\Entity\Issue\Comment $comments
     * @return Issue
     */
    public function addComment(\Academic\Bundle\ProjectBundle\Entity\Issue\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Academic\Bundle\ProjectBundle\Entity\Issue\Comment $comments
     */
    public function removeComment(\Academic\Bundle\ProjectBundle\Entity\Issue\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add activities
     *
     * @param \Academic\Bundle\ProjectBundle\Entity\Issue\Activity $activities
     * @return Issue
     */
    public function addActivity(\Academic\Bundle\ProjectBundle\Entity\Issue\Activity $activities)
    {
        $this->activities[] = $activities;

        return $this;
    }

    /**
     * Remove activities
     *
     * @param \Academic\Bundle\ProjectBundle\Entity\Issue\Activity $activities
     */
    public function removeActivity(\Academic\Bundle\ProjectBundle\Entity\Issue\Activity $activities)
    {
        $this->activities->removeElement($activities);
    }

    /**
     * Get activities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * Set parent_issue
     *
     * @param \Academic\Bundle\ProjectBundle\Entity\Issue $parentIssue
     * @return Issue
     */
    public function setParentIssue(\Academic\Bundle\ProjectBundle\Entity\Issue $parentIssue = null)
    {
        $this->parent_issue = $parentIssue;

        return $this;
    }

    /**
     * Get parent_issue
     *
     * @return \Academic\Bundle\ProjectBundle\Entity\Issue
     */
    public function getParentIssue()
    {
        return $this->parent_issue;
    }

    /**
     * Add child_issues
     *
     * @param \Academic\Bundle\ProjectBundle\Entity\Issue $childIssues
     * @return Issue
     */
    public function addChildIssue(\Academic\Bundle\ProjectBundle\Entity\Issue $childIssues)
    {
        $this->child_issues[] = $childIssues;

        return $this;
    }

    /**
     * Remove child_issues
     *
     * @param \Academic\Bundle\ProjectBundle\Entity\Issue $childIssues
     */
    public function removeChildIssue(\Academic\Bundle\ProjectBundle\Entity\Issue $childIssues)
    {
        $this->child_issues->removeElement($childIssues);
    }

    /**
     * Get child_issues
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildIssues()
    {
        return $this->child_issues;
    }
}
