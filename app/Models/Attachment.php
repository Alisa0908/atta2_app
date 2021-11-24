<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'org_name',
        'name',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
