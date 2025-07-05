<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'master_menu_id',
        'name',
        'icon',
        'route',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function masterMenu()
    {
        return $this->belongsTo(MasterMenu::class);
    }
}
