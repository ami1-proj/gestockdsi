<?php

namespace App\Observers;

use App\AppBaseModel;

class AppBaseModelObserver
{
    /**
     * Handle the app base model "created" event.
     *
     * @param  \App\AppBaseModel  $appBaseModel
     * @return void
     */
    public function created($appBaseModel)
    {
        $appBaseModel->unsetDefault($appBaseModel);
    }

    /**
     * Handle the app base model "updated" event.
     *
     * @param  \App\AppBaseModel  $appBaseModel
     * @return void
     */
    public function updated($appBaseModel)
    {
        $appBaseModel->unsetDefault($appBaseModel);
    }

    /**
     * Handle the app base model "deleted" event.
     *
     * @param  \App\AppBaseModel  $appBaseModel
     * @return void
     */
    public function deleted($appBaseModel)
    {
        if (class_basename($appBaseModel) == 'Affectation') {

        } else {
          $appBaseModel->unsetDefault($appBaseModel);
          $appBaseModel->addToRecycleBin();
        }
    }

    /**
     * Handle the app base model "restored" event.
     *
     * @param  \App\AppBaseModel  $appBaseModel
     * @return void
     */
    public function restored($appBaseModel)
    {
        $appBaseModel->removeFromRecycleBin(true);
    }

    /**
     * Handle the app base model "force deleted" event.
     *
     * @param  \App\AppBaseModel  $appBaseModel
     * @return void
     */
    public function forceDeleted($appBaseModel)
    {
        $appBaseModel->removeFromRecycleBin(false);
    }
}
