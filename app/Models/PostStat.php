<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class PostStat extends Model
{
    /** @use HasFactory<\Database\Factories\PostStatFactory> */
    use HasFactory;

    protected $table = 'post_stats';
    protected $fillable = [
        'user_id', 'post_id',
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function post() : BelongsTo {
        return $this->belongsTo(Post::class);
    }

    public function scopeGroupPosts(Builder $query) : void {
        $query->select([
            DB::raw('count(id) as views'),
            'user_id',
            DB::raw('DATE(created_at) as date')
        ])->groupBy('user_id', 'date');
    }

    public function scopeGroupUsers(Builder $query) : void {
        $query->select([
            DB::raw('count(id) as views'),
            'post_id',
            DB::raw('DATE(created_at) as date')
        ])->groupBy('post_id', 'date');
    }

    public function scopeFilterPosts(Builder $query, $post_ids) : void {
        if($post_ids) {
            $query->where('post_id', $post_ids);
        }
    }

    public function scopeFilterUsers(Builder $query, $user_ids) : void {
        if($user_ids) {
            $query->where('post_id', $user_ids);
        }
    }
}
