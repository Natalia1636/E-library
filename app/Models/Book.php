<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = ['title','author','description','page_count','category_id'];

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
