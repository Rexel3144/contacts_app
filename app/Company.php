<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
    
    /**
     * 
     * Relation between Company and Contact
     * 
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function contacts() {

        return $this->hasMany('App\Contact');
    }
    
    /**
     * 
     * Trying to find Id of company with $name
     * or create a new company and return its id
     * 
     * @param string $name
     * @return integer
     */
    public static function findIdByNameOrCreate($name) {
        $company = self::select('id')->where('name', '=', $name)->first();
        if (empty($company)) {
            $company = self::create(['name'=>$name]);
        }
        return $company->id;
    }

}
