<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';
    protected $fillable = ['name'];
    // Relação muitos-para-muitos com User
    public function users()
    {
        return $this->belongsToMany(User::class, 'profile_user');
    }

    // Relação muitos-para-muitos com Permission
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'profile_permission');
    }
}
