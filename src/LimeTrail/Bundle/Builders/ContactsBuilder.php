<?php

namespace LimeTrail\Bundle\Builders;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Routing\RouterInterface;
use Thrace\DataGridBundle\DataGrid\DataGridFactoryInterface;
use Thrace\DataGridBundle\DataGrid\CustomButton;

/**
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContactsBuilder
{
    const IDENTIFIER = 'contacts';
    protected $factory;
    protected $translator;
    protected $router;
    protected $em;
    protected $container;

    public function __construct(DataGridFactoryInterface $factory,
             TranslatorInterface $translator,
             RouterInterface $router,
             EntityManager $em,
             ContainerInterface $container)
    {
        $this->factory = $factory;
        $this->translator = $translator;
        $this->router = $router;
        $this->em = $em;
        $this->container = $container;
    }

    public function build(/*$locator*/)
    { /* https://github.com/thrace-project/datagrid-bundle/blob/master/Resources/doc/index.md#installation */

        $query = "c.id, c.firstName, c.middleName, c.lastName,
                  c.jobTitle, c.directPhone, c.mobilePhone,
                  c.email, co.name as Company, a.address, ci.name as City,
                  s.abbreviation as State, c.chartColor, c";

        $gridModeler = $this->container->get('lime_trail_grid_model.provider');
        $gridModeler->createModel($query);

        $dataGrid = $this->factory->createDataGrid(self::IDENTIFIER);
        $dataGrid
            ->setQueryBuilder($this->getQueryBuilder($query))
            ->setCaption($this->translator->trans('Contacts'))
            ->setColNames($gridModeler->getColNames())
            ->setColModel($gridModeler->getColModel())
            ->enableSearchButton(true)
            ->enableEditButton(true)
            ->setSortName('c.lastName')
            ->setSortOrder('ASC')
            ->setShrinkToFit(false)
            ->setForceFit(true)
            ->setAutoWidth(true)
            ->setHeight('100%')
            ->setHideGrid(false)
            ->setRowNum(50)
        ;

        if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
            $dataGrid->enableDeleteButton(true);
        }

        $dataGrid->addCustomButton(new CustomButton('ExportXls', array(
            'title' => 'Export to Xls',
            'caption' => 'Export',
            'buttonIcon' => 'ui-icon-document',
            'position' => 'last',
            'uri' => $this->router->generate('limetrail_storeinformation_exportgrid',
                      array('grid' => self::IDENTIFIER)
                      ),
            )
          )
        );

        return $dataGrid;
    }

    protected function getQueryBuilder($query)
    {
        $qb = $this->em->getRepository('LimeTrailBundle:Contact')->createQueryBuilder('c');

        $qb->select($query)
            ->Join('c.office', 'o')
            ->Join('o.company', 'co')
            ->Join('o.address', 'a')
            ->Join('o.city', 'ci')
            ->Join('o.state', 's')
        ;

        return $qb;
    }
}
