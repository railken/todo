<?php

namespace Core\User;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Railken\Laravel\Manager\ModelContract;

use Core\Project\Project;
use Core\Task\Task;

class User extends Authenticatable implements ModelContract
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Retrieve projects
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Retrieve projects
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Retrieve points
     *
     * @return integer
     */
    public function points()
    {

        $base_point = 3;

        return $this->tasks()->where('done', 1)->get()->map(function($task) use ($base_point){
            return $base_point+$task->priority;
        })->sum();
    }
}
