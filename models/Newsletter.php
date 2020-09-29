<?php namespace Dmrch\Contact\Models;

use Model;

/**
 * Newsletter Model
 */
class Newsletter extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'dmrch_contact_newsletters';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
