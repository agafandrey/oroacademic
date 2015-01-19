<?php

namespace Academic\Bundle\ProjectBundle\Controller;

use Academic\Bundle\ProjectBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

class ProjectController extends Controller
{
    /**
     * @Route("/list", name="academic_project_project_list")
     * @Acl(
     *      id="academic_project_list",
     *      type="entity",
     *      permission="VIEW",
     *      class="AcademicProjectBundle:Project"
     * )
     * @Template()
     */
    public function indexAction()
    {
        return [
            'entity_class' => $this->container->getParameter('academic_project.project.entity.class')
        ];
    }

    /**
     * Create project form
     *
     * @Route("/create", name="academic_project_project_create")
     * @Template("AcademicProjectBundle:Project:update.html.twig")
     * @Acl(
     *      id="academic_project_project_create",
     *      type="entity",
     *      permission="CREATE",
     *      class="AcademicProjectBundle:Project"
     * )
     */
    public function projectCreateAction()
    {
        return $this->update(new Project());
    }

    /**
     * Update project form
     *
     * @Route("/update/{id}", name="academic_project_project_update", requirements={"id"="\d+"}, defaults={"id"=0})
     * @Template("AcademicProjectBundle:Project:update.html.twig")
     * @Acl(
     *      id="academic_project_project_update",
     *      type="entity",
     *      permission="EDIT",
     *      class="AcademicProjectBundle:Project"
     * )
     */
    public function projectUpdateAction(Project $entity)
    {
        return $this->update($entity);
    }

    /**
     * View project info
     *
     * @Route("/view/{id}", name="academic_project_project_view", requirements={"id"="\d+"}, defaults={"id"=0})
     * @Template("AcademicProjectBundle:Project:view.html.twig")
     * @Acl(
     *      id="academic_project_project_view",
     *      type="entity",
     *      permission="VIEW",
     *      class="AcademicProjectBundle:Project"
     * )
     */
    public function projectViewAction(Project $entity)
    {
        return array(
            'entity'           => $entity
        );
    }

    /**
     * @param Project $entity
     *
     * @return array
     */
    protected function update(Project $entity)
    {
        if ($this->get('academic_project.form.handler.project')->process($entity)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('academic.project.controller.project.saved.message')
            );

            if (!$this->getRequest()->get('_widgetContainer')) {
                return $this->get('oro_ui.router')->redirectAfterSave(
                    ['route' => 'academic_project_project_update', 'parameters' => ['id' => $entity->getId()]],
                    ['route' => 'academic_project_project_list'],
                    $entity
                );
            }
        }

        return array(
            'entity'           => $entity,
            'form'             => $this->get('academic_project.form.project')->createView()
        );
    }

    /**
     * @Route("/widget/info/{id}", name="academic_project_widget_info", requirements={"id"="\d+"})
     * @AclAncestor("academic_project_view")
     * @Template()
     */
    public function infoAction(Project $project)
    {
        return [
            'project' => $project
        ];
    }
}
