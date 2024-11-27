<?php

namespace Modules\Client\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Modules\Client\Models\Client;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'client_id',
        'amount',
        'start_date',
        'end_date',
        'payment_status',
       
    ];

    protected static function newFactory()
    {
        
        return \Modules\Client\Database\Factories\SubscriptionFactory::new();
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
