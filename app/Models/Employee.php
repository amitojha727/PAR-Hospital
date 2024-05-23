<?php

namespace App\Models;

use App\ExamDetail;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Khill\Lavacharts\Lavacharts;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Employee extends Authenticatable
{
    protected $table = 'employee_mast';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'emp_id',
        'site_id',
        'emp_fname',
        'emp_sname',
        'emp_user_id',
        'password'
    ];
    //protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class, 'site_id', 'site_id');
    }
}
