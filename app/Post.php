<?php

namespace FotoStrana;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];

    /**
     * Автор поста (пользователь)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Пользователи, лайкнувшие пост
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function liked()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    /**
     * Проверяет, лайкнул ли этот пост переданный (текущий) пользователь
     *
     * @return bool
     */
    public function likedByUser(User $user = null)
    {
        if (!$user) {
            $user = request()->user();
        }

        return $this->liked->contains($user);
    }

    /**
     * Категории, выбранные для поста
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
}
