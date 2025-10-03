<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Carbon\Carbon;

class Ticket extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    protected $fillable = [
        'customer_id',
        'topic',
        'text',
        'status',
        'response_date',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments')->useDisk('public');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function scopeToday($query)
    {
        return $query->whereBetween('created_at', [
            Carbon::now()->startOfDay(),
            Carbon::now()->endOfDay(),
        ]);
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),
        ]);
    }
}
