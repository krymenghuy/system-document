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
        return $this->belongsTo(DocumentCategory::class, 'category_id');
    }

    public function getFilePathAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function evaluations()
    {
        return $this->hasMany(DocumentEvaluation::class);
    }

    // Accessor for file extension
    public function getFileExtensionAttribute()
    {
        return pathinfo($this->file_path, PATHINFO_EXTENSION) ?: 'pdf';
    }

    // Accessor for file size
    public function getFileSizeAttribute()
    {
        if (file_exists(storage_path('app/public/' . $this->file_path))) {
            return filesize(storage_path('app/public/' . $this->file_path));
        }
        return 0;
    }

    // Accessor for download count (placeholder)
    public function getDownloadCountAttribute()
    {
        return 0; // Since we don't have this column yet
    }

    // Accessor for evaluations count
    public function getEvaluationsCountAttribute()
    {
        return $this->evaluations()->count();
    }

    // Accessor for formatted created date
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at ? $this->created_at->format('M d, Y') : 'N/A';
    }

    // Accessor for formatted updated date
    public function getUpdatedAtFormattedAttribute()
    {
        return $this->updated_at ? $this->updated_at->format('M d, Y') : 'N/A';
    }

    // Accessor for detailed created date
    public function getCreatedAtDetailedAttribute()
    {
        return $this->created_at ? $this->created_at->format('F d, Y \a\t g:i A') : 'N/A';
    }

    // Accessor for detailed updated date
    public function getUpdatedAtDetailedAttribute()
    {
        return $this->updated_at ? $this->updated_at->format('F d, Y \a\t g:i A') : 'N/A';
    }
}
