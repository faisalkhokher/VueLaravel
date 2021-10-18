<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

  /**
   * Get the user that owns the Post
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function category()
  {
      return $this->belongsTo(Category::class, 'category_id', 'id');
  }
  public function users()
  {
      return $this->belongsTo(User::class, 'user_id', 'id');
  }
}

