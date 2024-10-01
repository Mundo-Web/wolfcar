<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'inside', 'district', 'city', 'country', 'cellphone','office_phone', 'email', 'facebook', 'instagram','youtube', 'twitter', 'whatsapp', 'linkedin', 'tiktok' , 'form_email', 'business_hours', 'schedule', 'mensaje_whatsapp', 'aboutus', 'htop', 'whatsapp1','whatsapp2', 'support_one', 'support_two'];

}
