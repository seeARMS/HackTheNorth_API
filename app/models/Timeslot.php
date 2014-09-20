<?php

class Timeslot extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'timeslots';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');


    public function occasion()
    {
        return $this->belongsTo('Occasion');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }


}
