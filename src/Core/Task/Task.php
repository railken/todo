<?php

namespace Core\Task;

use Illuminate\Database\Eloquent\Model;
use Railken\Laravel\Manager\ModelContract;
use Illuminate\Database\Eloquent\SoftDeletes;

use Core\User\User;
use Core\Project\Project;

class Task extends Model implements ModelContract
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'priority', 'expires_at', 'user_id', 'project_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'expires_at'];

    /**
     * Get the user that owns the task
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the project that contains the task
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Is task expired?
     *
     * @return boolean
     */
    public function isExpired()
    {
        return (new \DateTime()) > $this->expires_at;
    }
}
