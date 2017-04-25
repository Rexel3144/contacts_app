<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'name', 'email', 'phone', 'address', 'birthday',
    ];
    
    /**
     * 
     * Define a relation between Contact and User
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    /**
     * 
     * Define a relation between Contact and Company
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(){
        return $this->belongsTo('App\Company','company_id');
    }
}
