<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author',
        'publication_year',
        'file_path',
        'description',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(DocumentCategory::class);
    }

    public function getFilePathAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function evaluations()
    {
        return $this->hasMany(DocumentEvaluation::class);
    }
}
