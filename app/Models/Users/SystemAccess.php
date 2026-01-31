<?php

namespace App\Models\Users;

use App\Models\User;
use App\Traits\Common\CommonTrait;
use App\Traits\Common\TimeTrait;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create(array $array)
 * @method static orderBy(string $string, string $string1)
 */
class SystemAccess extends Model{
    use HasFactory, TimeTrait;

    protected $table = 'users__system_access';
    protected $guarded = ['id'];

    public function dateTime(): string{
        if (!empty($this->created_at)) { return $this->date($this->created_at); }
        return $this->date(Carbon::now());
    }
    public function userRel(): HasOne{
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
