<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value',
        'description',
        'property_id',
        'expense_type_id'
    ];

    public function type() {
        return $this->belongsTo(ExpenseType::class);
    }

    public function property() {
        return $this->belongsTo(Property::class);
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }
}
