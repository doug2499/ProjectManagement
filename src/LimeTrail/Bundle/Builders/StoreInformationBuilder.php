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
class StoreInformationBuilder
{
    const IDENTIFIER = 'store_info';
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

    public function build()
    { /* https://github.com/thrace-project/datagrid-bundle/blob/master/Resources/doc/index.md#installation
    http://stackoverflow.com/questions/7413905/jqgrid-populate-select-control-on-row-edit

    */

        $query = 'si.id, si.storeNumber, c.name as City, s.abbreviation as State,
                  st.name as StoreType, a.address as Address, sr.name as Intersection,
                  z.zipcode as ZipCode, d.name as Division, r.name as Region, si';

        $gridModeler = $this->container->get('lime_trail_grid_model.provider');
        $gridModeler->createModel($query);

        $rowList = array(30,60,80,120);

        $dataGrid = $this->factory->createDataGrid(self::IDENTIFIER);
        $dataGrid
            ->setQueryBuilder($this->getQueryBuilder($query))
            ->setCaption($this->translator->trans('Store Information'))
            ->setColNames($gridModeler->getColNames())
            ->setColModel($gridModeler->getColModel())
            ->enableSearchButton(true)
            ->enableAddButton(false)
            ->enableEditButton(true)
            ->enableDeleteButton(false)
            ->setSortName('City')
            ->setSortOrder('ASC')
            ->setShrinkToFit(false)
            ->setHeight('100%')
            ->setRowNum(50)
            ->setRowList($rowList)
            //->setDependentDataGrids(array('projects_contact'))
        ;

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
        $qb = $this->em->getRepository('LimeTrailBundle:StoreInformation')->createQueryBuilder('si');

        $qb->select($query)
            ->Join('si.storeType', 'st')
            ->Join('si.address', 'a')
            ->Join('si.streetIntersection', 'sr')
            ->Join('si.city', 'c')
            ->Join('si.zip', 'z')
            //->Join('si.county', 'co')
            ->Join('si.division', 'd')
            ->Join('si.region', 'r')
            ->Join('si.state', 's')
            ->groupBy('si.storeNumber')
        ;

        return $qb;
    }
}
