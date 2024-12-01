<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReservations extends Model
{
    use HasFactory;

    protected $table = 'book_reservations';

    protected $fillable = ['reserved_at', 'expired_at', 'user_id', 'book_id'];
}
