<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'title', 'message', 'Is_Active', 'Is_Deleted', 'Created_on', 'Created_by', 'Updated_on', 'Updated_by'];

    public $timestamps = false;
}