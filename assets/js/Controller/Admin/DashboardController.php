<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\CategoriePronostics;
use App\Entity\Forum;
use App\Entity\ForumCategorie;
use App\Entity\Pronostics;
use App\Entity\Stractegie;
use App\Entity\StrategieCategorie;
use App\Entity\User;
use App\Entity\Vip;
use AppTestBundle\Entity\UnitTests\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;

class DashboardController extends AbstractDashboardController
{
    /**
     *
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
//        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // redirect to some CRUD controller
       $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
//       return $this->redirect($routeBuilder->setController(PronosticsCrudController::class)->generateUrl());
//       return parent::index();
        return $this->render('bundles/EasyAdminBundle/page/content.html.twig');
    }
    /**
    * @Route("/admin/dashboard", name="admin_dashboard")
     */
    public function dashboard(): Response
   {
        return $this->render('bundles/EasyAdminBundle/page/content.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Parieurs')
        // you can include HTML contents too (e.g. to link to an image)


        // the path defined in this method is passed to the Twig asset() function
        ->setFaviconPath('favicon.svg')

        // the domain used by default is 'messages'
        ->setTranslationDomain('my-custom-domain');

    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Acceuil', 'icon class', Article::class)->setQueryParameter('sortField','id')->setQueryParameter('sortDirection','DESC');
        yield MenuItem::linkToCrud('Stratégie', 'icon class', Stractegie::class);
        yield MenuItem::linkToCrud('Catégorie des stratégies ', 'icon class', StrategieCategorie::class);
        yield MenuItem::linkToCrud('Pronostics catégorie ', 'icon class', CategoriePronostics::class);
        yield MenuItem::linkToCrud('Pronostics ', 'icon class', Pronostics::class);
        yield MenuItem::linkToCrud('Forum catégories ', 'icon class', ForumCategorie::class);
        yield MenuItem::linkToCrud('Forum ', 'icon class', Forum::class);
        yield MenuItem::linkToCrud('Utilisateur VIP', 'icon class', Vip::class);
        yield MenuItem::linkToCrud('Les utilisateur ', 'icon class', User::class);
        yield MenuItem::linkToUrl('Visit public website', null, '/');
        yield MenuItem::linkToUrl('Search in Google', 'fab fa-google', 'https://google.com');
    }

    /**
     * @param UserInterface $user
     * @return UserMenu
     */
    public function configureUserMenu(UserInterface $user): UserMenu
    {
        // Usually it's better to call the parent method because that gives you a
        // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
        // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
        return parent::configureUserMenu($user)
            // use the given $user object to get the user name
            ->setName($user->getEmail())
            // use this method if you don't want to display the name of the user
            ->displayUserName(false)

            // you can return an URL with the avatar image
            ->setAvatarUrl('https://...')
//            ->setAvatarUrl($user->getProfileImageUrl())
            // use this method if you don't want to display the user image
            ->displayUserAvatar(false)
            // you can also pass an email address to use gravatar's service
//            ->setGravatarEmail($user->getMainEmailAddress())

            // you can use any type of menu item, except submenus
            ->addMenuItems([
                /*  MenuItem::linkToRoute('My Profile', 'fa fa-id-card', '...', ['...' => '...']),
                  MenuItem::linkToRoute('Settings', 'fa fa-user-cog', '...', ['...' => '...']),
                  */MenuItem::section(),
                MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
            ]);
    }
    /* public function configureCrud(Crud $crud): Crud
     {
         return $crud
             ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
             ;
     }*/
    public function configureCrud(): Crud
    {
        return Crud::new()
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ->addFormTheme('@FMElfinder/Form/elfinder_widget.html.twig')
            // the names of the Doctrine entity properties where the search is made on
            // (by default it looks for in all properties)
            ->setSearchFields(['nom'])
            // use dots (e.g. 'seller.email') to search in Doctrine associations

            // set it to null to disable and hide the search box

            // defines the initial sorting applied to the list of entities
            // (user can later change this sorting by clicking on the table columns)
            ->setDefaultSort(['id' => 'DESC'])
//        ->setDefaultSort(['id' => 'DESC', 'title' => 'ASC', 'startsAt' => 'DESC'])

            // the max number of entities to display per page
            ->setPaginatorPageSize(30)
            // these are advanced options related to Doctrine Pagination
            // (see https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/tutorials/pagination.html)
            ->setPaginatorUseOutputWalkers(true)
            ->setPaginatorFetchJoinCollection(true)
            // ...

            // the first argument is the "template name", which is the same as the
            /*  // Twig path but without the `@EasyAdmin/` prefix
              ->overrideTemplate('label/null', 'admin/labels/my_null_label.html.twig')

              ->overrideTemplates([
                  'crud/index' => 'admin/pages/index.html.twig',
                  'crud/field/textarea' => 'admin/fields/dynamic_textarea.html.twig',*/
//            ])
            ;
    }
    public function configureAssets(): Assets
    {
        return Assets::new()
            // the argument of these methods is passed to the asset() Twig function
            // CSS assets are added just before the closing </head> element
            // and JS assets are added just before the closing </body> element
           /* ->addCssFile('build/all.min.css')
            ->addCssFile('build/tempusdominus-bootstrap-4.min.css')
            ->addCssFile('build/icheck-bootstrap.min.css')
            ->addCssFile('build/jqvmap.min.css')
            ->addCssFile('build/adminlte.min.css')
            ->addCssFile('build/OverlayScrollbars.min.css')
            ->addCssFile('build/daterangepicker.css')
            ->addCssFile('build/summernote-bs4.css')
            ->addCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700')
            ->addCssFile('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')
            ->addJsFile('build/jquery-ui.min.js')
            ->addJsFile('build/bootstrap.bundle.min.js')
            ->addJsFile('build/Chart.min.js')
            ->addJsFile('build/sparkline.js')
            ->addJsFile('build/jquery.vmap.min.js')
            ->addJsFile('build/jquery.knob.min.js')
            ->addJsFile('build/moment.min.js')
            ->addJsFile('build/daterangepicker.js')
            ->addJsFile('build//tempusdominus-bootstrap-4.min.js')
            ->addJsFile('build/summernote-bs4.min.js')
            ->addJsFile('build/jquery.overlayScrollbars.min.js')
            ->addJsFile('build/adminlte.js')
            ->addJsFile('build/dashboard.js')
            ->addJsFile('build/demo.js')*/


            // use these generic methods to add any code before </head> or </body>
            // the contents are included "as is" in the rendered page (without escaping them)
            ->addHtmlContentToHead('<link rel="dns-prefetch" href="https://assets.example.com">')
            ->addHtmlContentToBody('<script>  $.widget.bridge(\'uibutton\', $.ui.button) </script>')
            ->addHtmlContentToBody('<!-- generated at '.time().' -->')
            ;
    }
   /* protected function createSearchQueryBuilder($entityClass, $searchQuery, array $searchableFields, $sortField = null, $sortDirection = null, $dqlFilter = null)
    {
        // Récupération du query builder parent
        $qb = parent::createSearchQueryBuilder($entityClass, $searchQuery, $searchableFields, $sortField, $sortDirection, $dqlFilter);

        // Si entité Beer, prise en charge du nom de la catégorie
        if ($entityClass === Beer::class) {
            $qb->innerJoin('entity.category', 'c')
                ->orWhere('LOWER(c.name) LIKE :category_name')
                ->setParameter('category_name', '%'.$searchQuery.'%')
            ;
        }

        return $qb;
    }*/

}
