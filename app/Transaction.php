<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
     'transcode', 
     'seller_id', 
     'buyer_id',
     'currency_id',
     'country_id', 
     'confirm_token', 
     'transaction_type', 
     'description',
      'amount',
     'fulfill_days',
     'paid_at', 
     'user_ipaddress', 
     'transaction_status', 
     'confirmed_by_merchant', 
     'is_released', 
     'is_stopped', 
     'is_refunded', 
     'is_extended', 
     'is_amountpaid', 
     'pepperest_fee', 
     'escrow_fee',  
     'reason_for_stopping', 
     'reason_for_stop_refund', 
     
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'posted_at', 
        'created_at',
        'updated_at',
        'started_at', 
        'end_at',
        'fufill_notice_at',
        'stop_payment_at',
        'stop_refund_at',
        'refund_at', 
        'released_at',
        'stopped_at', 
        'insert_at',
        'arbitration_request_date'
    ];

    /**
     * Auto casting fields.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Get the user who owns the observation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the observation's latin name.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function latinName()
    {
        return $this->belongsTo('App\LatinName', 'latin_name_id', 'id');
    }

    /**
     * Return lists observation belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     */
    public function collections()
    {
        return $this->belongsToMany('App\Collection');
    }

    /**
     * Get all flags.
     *
     * @return mixed
     */
    public function flags()
    {
        return $this->hasMany('App\Flag');
    }

    /**
     * Get related confirmations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function confirmations()
    {
        return $this->hasMany('App\Confirmation');
    }

    /**
     * Get related private notes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany('App\Note');
    }

    /**
     * @param $bounds
     */
    public function scopeBounds($query, $bounds)
    {
        if ($bounds->southWest->lat < $bounds->northEast->lat) {
            $query->whereBetween('latitude', [$bounds->southWest->lat, $bounds->northEast->lat]);
        } else {
            $query->whereBetween('latitude', [$bounds->northEast->lat, $bounds->southWest->lat]);
        }

        $left_edge = $bounds->southWest->lng;
        $right_edge = $bounds->northEast->lng;

        if ($right_edge < $left_edge) {
            $query->where(function ($query) use ($left_edge, $right_edge) {
                $query->whereBetween('longitude', [$left_edge, 180]);
                $query->orWhere(function ($query) use ($right_edge) {
                    $query->whereBetween('longitude', [-180, $right_edge]);
                });
            });
        } else {
            $query->whereBetween('longitude', [$left_edge, $right_edge]);
        }
    }


}
