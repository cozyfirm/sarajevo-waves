<?php

namespace App\Models\Hotel\Rooms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static get()
 * @method static where(string $string, string $string1, $id)
 */
class Room extends Model{
    use HasFactory;

    protected $table = 'rooms';
    protected $guarded = ['id'];
}
