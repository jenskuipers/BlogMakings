<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use HasFactory, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * The attributes that are sortable.
     */
    public $sortable = [
        'name'
    ];

    /**
     * The posts that this category has.
     * 
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
