<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['title','content','catagory_id','user_id','status','image'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

public function catagory()
{
    return $this->belongsTo(Catagory::class);
}
public function postimage()
{
    return $this->hasMany(PostImage::class,'post_id','id');
}
}
