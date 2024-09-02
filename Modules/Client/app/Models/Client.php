<?php

namespace Modules\Client\Models;

use Modules\Invoice\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Client\Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Client extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'client_name',
        'facility_level',
        'location',
        'client_email',
        'billing_cycle',
        'amount',
        'contact_name',
        'contact_phone',
        'support_engineer_name',
        'support_engineer_phone',
        'support_engineer_email',

    ];

    //for soft deletes
    protected $dates = ['deleted_at'];

    protected static function newFactory()
    {
        //return ClientFactory::new();
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
