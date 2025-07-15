<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'category_id');
    }

    public function getDocumentsCountAttribute()
    {
        return $this->documents()->count();
    }

    public function getAverageRatingAttribute()
    {
        return $this->documents()
            ->join('document_evaluations', 'documents.id', '=', 'document_evaluations.document_id')
            ->avg('document_evaluations.rating');
    }

    public function getTotalEvaluationsAttribute()
    {
        return $this->documents()
            ->join('document_evaluations', 'documents.id', '=', 'document_evaluations.document_id')
            ->count('document_evaluations.id');
    }
}
