<?php

namespace Modules\Invoice\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Invoice\Database\Factories\InvoiceFactory;
use Modules\Client\Models\Client;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    
        'client_id',
        'client_name',
        'client_email',
        'location',
        'billing_cycle',
        'amount',
        'due_date',
    ];

    protected static function newFactory()
    {
        return InvoiceFactory::new();
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
