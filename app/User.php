<?php

namespace App;

use App\Models\Group;
use App\Models\Symptom;
use App\Models\SymptomRecord;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User.
 *
 * @property string $api_token
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'api_token', 'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function symptoms(): BelongsToMany
    {
        return $this->belongsToMany(Symptom::class)->withTimestamps();
    }

    public function symptomRecords()
    {
        return $this->hasMany(SymptomRecord::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }
}
