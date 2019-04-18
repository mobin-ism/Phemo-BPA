<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table = 'trainings';

    public function trainingType()
    {
        return $this->belongsTo(TrainingType::class);
    }
}