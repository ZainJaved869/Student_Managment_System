<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'amount',
        'due_date',
        'paid_date',
        'payment_method',
        'transaction_id',
        'status'
    ];

    protected $casts = [
        'due_date' => 'date',
        'paid_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Accessor for formatted amount
    public function getFormattedAmountAttribute()
    {
        return '$' . number_format($this->amount, 2);
    }

    // Check if fee is overdue
    public function getIsOverdueAttribute()
    {
        return $this->status === 'pending' && $this->due_date < now();
    }
}