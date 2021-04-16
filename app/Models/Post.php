<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\Builder;

class Post extends  Eloquent
{
    use HasFactory;
    use  Sluggable;


    const PUBLIC='1';
    const PRIVATE='0';

    protected $fillable=[
        'title',
        'slug',
        'description',
        'content',
        'image_path',
        'user_id',
        'visible'
        
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable():array
    {
        return [
            'slug'=>[
                'source'=>'title'
            ]
        ];
    }

    public function isVisible()
    {
        return $this->visible == Post::PUBLIC;
    }
}
