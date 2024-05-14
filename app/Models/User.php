<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;


class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia;
    public $table = 'users';

    public $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'username'
    ];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'remember_token' => 'string',
        'username' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'email_verified_at' => 'nullable',
        'password' => 'required|string|max:255',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'username' => 'nullable|string|max:255'
    ];

    public function agendas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Agenda::class, 'users_updated_id');
    }

    public function agenda1s(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Agenda::class, 'users_created_id');
    }

    public function galeris(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Galeri::class, 'users_updated_id');
    }

    public function galeri2s(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Galeri::class, 'users_created_id');
    }

    public function kegiatans(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Kegiatan::class, 'users_updated_id');
    }

    public function kegiatan3s(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Kegiatan::class, 'users_created_id');
    }

    public function pages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Page::class, 'users_id');
    }

    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Post::class, 'users_id');
    }

    public function pegawai(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(\App\Models\Pegawai::class, 'user_id');
    }

    public function getLatestLinkSk()
    {
        // Ambil link terbaru dari model LinkSk dengan rentang tanggal yang sesuai
        $latestLinkSk = LinkSk::where('dari_tanggal', '<=', now())
            ->where('sampai_tanggal', '>=', now())
            ->latest('updated_at')
            ->first();

        // Jika ditemukan link terbaru, kembalikan link-nya, jika tidak, kembalikan null
        return $latestLinkSk ? $latestLinkSk->link : null;
    }

}
