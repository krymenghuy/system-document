<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'route',
        'order',
        'is_active',
        'has_children'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'has_children' => 'boolean'
    ];

    public function childMenus()
    {
        return $this->hasMany(ChildMenu::class)->orderBy('order');
    }

    public function activeChildMenus()
    {
        return $this->hasMany(ChildMenu::class)->where('is_active', true)->orderBy('order');
    }
}
