<?php

namespace Modules\Client\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Client\Database\Factories\SubscriptionFactory;

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
        //return SubscriptionFactory::new();
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
