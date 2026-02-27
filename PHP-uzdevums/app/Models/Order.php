<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = ['customer_id', 'user_id', 'status', 'total', 'notes'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Filter by status
    public function scopeStatus(Builder $query, $status)
    {
        if ($status) {
            $query->where('status', $status);
        }
    }

    // Filter by customer
    public function scopeForCustomer(Builder $query, $customerId)
    {
        if ($customerId) {
            $query->where('customer_id', $customerId);
        }
    }
}