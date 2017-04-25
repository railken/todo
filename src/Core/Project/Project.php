<?php

namespace Core\Project;

use Illuminate\Database\Eloquent\Model;
use Railken\Laravel\Manager\ModelContract;
use Illuminate\Database\Eloquent\SoftDeletes;

use Core\User\User;

class Project extends Model implements ModelContract
{

    use SoftDeletes;

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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
