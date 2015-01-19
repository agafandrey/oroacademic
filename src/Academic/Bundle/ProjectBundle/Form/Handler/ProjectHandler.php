<?php

namespace Academic\Bundle\ProjectBundle\Form\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;

use Academic\Bundle\ProjectBundle\Entity\Project;

use Oro\Bundle\OrganizationBundle\Entity\BusinessUnit;

class ProjectHandler
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * @param FormInterface $form
     * @param Request       $request
     * @param ObjectManager $manager
     */
    public function __construct(FormInterface $form, Request $request, ObjectManager $manager)
    {
        $this->form    = $form;
        $this->request = $request;
        $this->manager = $manager;
    }

    /**
     * Process form
     *
     * @param  Project $entity
     * @return bool  True on successful processing, false otherwise
     */
    public function process(Project $entity)
    {
        $this->form->setData($entity);

        if (in_array($this->request->getMethod(), array('POST', 'PUT'))) {
            $this->form->submit($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($entity);
                return true;
            }
        }

        return false;
    }

    /**
     * "Success" form handler
     *
     * @param Project $entity
     */
    protected function onSuccess(Project $entity)
    {
        $organization = $this->manager->getRepository('OroOrganizationBundle:Organization')->getFirst();
        $businessUnit = new BusinessUnit();
        $businessUnit->setName($entity->getName());
        $businessUnit->setOrganization($organization);
        $entity->setOwner($businessUnit);
        $entity->setOrganization($organization);

        $this->manager->persist($businessUnit);
        $this->manager->persist($entity);
        $this->manager->flush();
    }
}
