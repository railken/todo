<?php

namespace Core\Task;

use Illuminate\Database\Eloquent\Model;
use Railken\Laravel\Manager\ModelContract;

class Task extends Model implements ModelContract
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
}