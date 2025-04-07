<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait TraitHasAudit
{
    /**
     * Boot the trait
     */
    public static function bootTraitHasAudit(): void
    {
        $user = auth()->user();

        // Registering model event listeners
        static::creating(function ($model) use ($user) {
            if ($user) {
                $model->created_by = $user->id;
                $model->updated_by = $user->id;
                //$model->save();
            }
        });

        static::updating(function ($model) use ($user) {
            if ($user) {
                $model->updated_by = $user->id;
                //$model->save();
            }
        });

        static::deleting(function ($model) use ($user) {
            if ($user) {
                $model->deleted_by = $user->id;
                //$model->save(); // Save the model with the deleted_by value before deletion
            }
        });
    }
}
