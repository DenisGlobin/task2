<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'message', 'file_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
