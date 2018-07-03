<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Menu\Items\Contents\Link;
use Menu\Menu;
use Menu\MenuHandler;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeMainMenu();
        $this->composeUserMenu();
        $this->composeContactMenu();
        $this->composeMemberMenus();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Make the main menu.
     */
    private function composeMainMenu()
    {
        View::composer('app.includes.menu', function ($view) {
            // Set up some permissions
            $user         = Auth::user();
            $isRegistered = Auth::check();
            $isMember     = $isRegistered && $user->isMember();
            $isAdmin      = $isRegistered && $user->isAdmin();

            // Create the parent menu
            $menu = Menu::handler('mainMenu');

            // Parent menu
            $menu->add('#', 'About Us', Menu::items('about'));
            $menu->add('#', 'Media', Menu::items('media'))->activePattern('^\/media');
            $menu->add(route('event.diary'), 'Events Diary', Menu::items('events'))->activePattern('^\/events');
            $menu->add(route('resource.search'), 'Resources', Menu::items('resources'))->activePattern('^\/resources');
            $menu->add('#', 'Enquiries', Menu::items('contact'))->activePattern('^\/contact');

            // About sub-menu
            $menu->find('about')
                 ->add(route('page.show', ['slug' => 'about']), 'About the society')
                 ->add(route('committee.view'), 'The committee');

            // Media sub-menu
            $menu->find('media')
                 ->add(route('media.images.index'), 'Image Gallery')->activePattern('^\/media\/images')
                 ->add(route('media.videos.index'), 'Videos')->activePattern('^\/media\/videos');

            if ($isRegistered) {
                // Members' area sub-menu
                //if ($isMember) {
                //    $menu->find('members')
                //         ->add(route('quotes.index'), 'Quotes Board')
                //         ->add('#', 'Other', Menu::items('members.misc'), [], ['class' => 'misc'])
                //         ->add(route('contact.accident'), 'Report an Accident')
                //}
                //
                //// Other sub-menu
                //if ($isMember) {
                //    $menu->find('members.misc')
                //         ->add(route('election.index'), 'Committee elections')->activePattern('^\/elections')
                //         ->add(route('award.season.index'), 'Awards')->activePattern('^\/awards');
                //}
                //if ($isAdmin) {
                //    $menu->find('members.misc')
                //
                //}

                // Resources sub-menu
                $menu->find('resources')
                     ->add(route('resource.search', ['category' => 'event-reports']), 'Event Reports')
                     ->add(route('resource.search', ['category' => 'event-risk-assessments']), 'Event Risk Assessments')
                     ->add(route('resource.search', ['category' => 'meeting-minutes']), 'Meeting Minutes')
                     ->add(route('resource.search', ['category' => 'meeting-agendas']), 'Meeting Agendas');
            }

            // Contact sub-menu
            $menu->find('contact')
                 ->add(route('contact.enquiries'), 'General enquiries')
                 ->add(route('contact.feedback'), 'Provide feedback');

            // Add the necessary classes
            $menu->addClass('nav navbar-nav');
            $this->bootstrapifyMenu($menu);

            // Render
            $view->with('mainMenu', $menu->render());
        });
    }

    private function composeUserMenu()
    {
        View::composer('app.includes.menu', function ($view) {
            // Set up some permissions
            $user         = Auth::user();
            $isRegistered = Auth::check();
            $isMember     = $isRegistered && $user->isMember();
            $isAdmin      = $isRegistered && $user->isAdmin();

            $menu = Menu::handler('userMenu');

            if ($isRegistered) {
                $menu->add(route('membership.view'), 'Members', Menu::items('members'))
                     ->add(route('event.index'), 'Events', Menu::items('events'))->activePattern('^\/events')
                     ->add('#', 'Training', Menu::items('training'))->activePattern('^\/training')
                     ->add('#', 'Equipment', Menu::items('equipment'))->activePattern('^\/equipment')
                     ->add(route('quotes.index'), 'Quotes Board')
                     ->add(route('election.index'), 'Elections')->activePattern('^\/elections')
                     ->add(route('award.season.index'), 'Awards')->activePattern('^\/awards');

                if ($isMember) {
                    $menu->find('events')
                         ->add(route('event.report'), 'Submit event report');

                    $menu->find('training')
                         ->add(route('training.skill.index'), 'View skills')->activePattern('^\/training\/skills');

                    $menu->find('equipment')
                         ->add(route('equipment.assets'), 'Asset register')
                         ->add(route('equipment.repairs.index'), 'Repairs database');

                    //$menu->add('#', 'Other', Menu::items('other'));
                    //$menu->find('other')

                }

                if ($isAdmin) {
                    $menu->find('members')
                         ->add(route('user.index'), 'View all users')
                         ->add(route('user.create'), 'Create a new user');

                    $menu->find('events')
                         ->add(route('event.index'), 'View all events')
                         ->add(route('event.create'), 'Create a new event');

                    $menu->find('training')
                         ->add(route('training.category.index'), 'View categories')
                         ->add(route('training.skill.proposal.index'), 'Review proposals')->activePattern('^\/training\/proposals')
                         ->add(route('training.skill.log'), 'Skills log');

                    $menu->add(route('page.index'), 'Webpages');
                }
            }

            $this->bootstrapifyMenu($menu);

            $view->with('userMenu', $menu->render());
        });
    }

    /**
     * Make the sub menu for the contact section.
     */
    private function composeContactMenu()
    {
        View::composer('contact.shared', function ($view) {
            $menu = Menu::handler('contactMenu');
            $menu->add(route('contact.enquiries'), 'General Enquiries')
                 ->add(route('contact.book'), 'Book Us')->activePattern('\/contact\/book')
                 ->add(route('contact.feedback'), 'Provide Feedback');
            $menu->addClass('nav nav-tabs');
            $view->with('menu', $menu->render());
        });
    }

    /**
     * Make the sub menus for the member profile views.
     */
    private function composeMemberMenus()
    {
        view()->composer('members.view', function ($view) {
            $user = $view->getData()['user'];
            $menu = Menu::handler('profileMenu');
            if ($user->isActiveUser()) {
                $menu->add(route('member.profile', ['tab' => 'profile']), 'My Details')
                     ->add(route('member.profile', ['tab' => 'events']), 'Events')
                     ->add(route('member.profile', ['tab' => 'training']), 'Training');
            } else {
                $menu->add(route('member.view', ['username' => $user->username, 'tab' => 'profile']), 'Details')
                     ->add(route('member.view', ['username' => $user->username, 'tab' => 'events']), 'Events')
                     ->add(route('member.view', ['username' => $user->username, 'tab' => 'training']), 'Training');
            }
            $menu->addClass('nav nav-tabs');
            $view->with('menu', $menu->render());
        });
    }

    private function bootstrapifyMenu(MenuHandler $menu)
    {
        $menu->getItemsByContentType(Link::class)
             ->map(function ($item) {
                 if ($item->hasChildren()) {
                     $item->addClass('dropdown');
                     $item->getChildren()->getAllItems()->map(function ($childItem) use ($item) {
                         if ($childItem->isActive()) {
                             $item->addClass('active');
                         }
                     });
                 }
             });
        $menu->getAllItemLists()
             ->map(function ($itemList) {
                 if ($itemList->hasChildren()) {
                     $itemList->addClass('dropdown-menu');
                 }
             });
    }
}
