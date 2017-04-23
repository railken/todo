<?php

namespace Core\Project;

use Illuminate\Database\Eloquent\Model;
use Railken\Laravel\Manager\ModelContract;

use Core\User\User;

class Project extends Model implements ModelContract
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id'];

    /**
     * User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
