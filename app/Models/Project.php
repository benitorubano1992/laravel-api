<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['type_id', 'title', 'content', 'slug', 'cover_image'];
    public static function generateSlug($title)
    {
        return Str::slug($title);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function tecnologies()
    {
        return $this->belongsToMany(Tecnology::class);
    }
}
