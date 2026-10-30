<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'page_url',
        'referer',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    /**
     * Scope untuk filter berdasarkan tanggal
     */
    public function scopeLastDays($query, $days = 30)
    {
        return $query->where('visited_at', '>=', now()->subDays($days));
    }

    /**
     * Hitung pengunjung unik per hari
     */
    public static function getUniqueVisitorsPerDay($days = 30)
    {
        return self::selectRaw('DATE(visited_at) as date, COUNT(DISTINCT ip_address) as count')
            ->where('visited_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date');
    }

    /**
     * Hitung total page views per hari
     */
    public static function getPageViewsPerDay($days = 30)
    {
        return self::selectRaw('DATE(visited_at) as date, COUNT(*) as count')
            ->where('visited_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date');
    }
}