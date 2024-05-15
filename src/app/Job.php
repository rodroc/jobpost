<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model /*Eloquent*/
{
    protected $connection = 'sqlite';
    protected $primaryKey = 'id';
    protected $table = 'jobs';

    protected $fillable = [
        'title',
        'description',
        'link',
        'location',
        'emptype',
        'requirements',
        'moderator_email',
        'active',
        'spam'
    ];
}
