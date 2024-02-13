<?php

namespace GuiddiniLaravel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Epayment extends Model
{
    use HasFactory;

    /**
  * The database table used by the model.
  *
  * @var string
  */
 protected $table = 'epayments';

 /**
  * The database primary key value.
  *
  * @var string
  */
 protected $primaryKey = 'id';

 
 protected $fillable = [
    'status',// 0 NO PAYEE 1 PAYEE
    'order_id',//Identifiant de la transaction
    'order_id_satim',
    'bool',// 0: Transaction created. 1: Transaction confirmed.
    'error_code',
    'code',//Numéro d'autorisation
    'total',
    'message_return',
    'date_transaction',
    'date_expiration',
    'file'
    
    
];

protected $hidden = [
    'created_at',
    'updated_at'
];


}
