<?php

class User extends Eloquent  {

	protected $table = 'users';
	protected $hidden = array('passwd');
    protected $fillable = array('userid', 'gid', 'homedir', 'shell', 'passwd');

    public function group() {
        return $this->hasOne('Group', 'gid', 'gid');
    }

    public function totalTransferFormated()
    {
        $units = array('B', 'KiB', 'MiB', 'GiB', 'TiB');
        $unit_count = 0;
        $total = Transfer::where('userid', '=', $this->userid)->sum('size');
        while ($total > 1024) {
            $total = $total / 1024;
            $unit_count++;
        }
        return number_format($total, 2) . " ".$units[$unit_count];
    }
}
