<?php

namespace App\Models\Hotel\Rooms;

use App\Models\Core\Keyword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static where(string $string, string $string1, $id)
 */
class Light extends Model{
    use HasFactory;

    protected $table = 'rooms__lights';
    protected $guarded = ['id'];

    public function statusRel(): HasOne{
        return $this->hasOne(Keyword::class, 'value', 'status')->where('type',  'light_status');
    }
}
