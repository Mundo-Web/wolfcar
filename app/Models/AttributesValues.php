<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributesValues extends Model
{
    use HasFactory;
    protected $fillable=['attribute_id',
        'valor',
        'descripcion',
        'color',
        'imagen',
        'visible',
        'status'
    ];

    public function attribute()
    {
        return $this->belongsTo(Attributes::class, 'attribute_id');
    }
    
    public function attributeProductValues()
    {
        return $this->hasMany(AttributeProductValues::class, 'attribute_value_id');
    }
}
