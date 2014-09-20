<?php

class Occasion extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'occasions';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('pivot', 'created_at', 'updated_at');

    public function users()
    {
        return $this->belongsToMany('User')->withPivot('complete');
    }

    public function timeslot()
    {
		return $this->hasMany('Timeslot');
    }



}
