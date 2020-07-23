<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NafazUser extends Model
{
    protected $fillable = ['national_id', 'ar_name', 'en_name', 'ar_family_name', 'en_family_name', 'ar_father_name',
        'en_father_name', 'ar_first_name', 'en_first_name', 'ar_grandfather_name', 'en_grandfather_name',
        'ar_nationality', 'nationality', 'nationality_code', 'gender', 'id_expiry_date', 'card_issue_date',
        'iqama_expiry_hijri', 'id_expiry_hijri', 'card_issue_hijri','iqama_expiry_date', 'birth_date', 'birth_hijri'];


    protected $primaryKey = 'user_id';
}
