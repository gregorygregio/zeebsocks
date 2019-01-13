<?php

namespace App\Listeners;

use App\User;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class BuildMenuListener {

    /**
      * Create the event listener.
      *
      * @return void
      */
    public function __construct()
    {
         //
    }

    /**
      * Handle the event.
      *
      * @param  BuildingMenu  $event
      * @return void
      */
    public function handle(BuildingMenu $event)
    {
      //TODO
        $event->menu->add([
              'text'    => 'Notificações',
              'url'     => 'adm/panel/products',
              'icon'    => 'bell',
              'label'   => 7000,
              'label_color' => 'danger',
        ]);
    }

}
