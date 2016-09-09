<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    //
	protected $table = 'flyer_photos';

	protected $fillable = ['paths'];

	protected $baseDir = '/flyers/photos';

	public function flyer()
	{
		return $this->belongsTo('App\Flyer');
	}

	public static function fromForm(UploadedFile $file)
	{
		$photo = new static;

		$name = time() . $file->getClientOriginalName();

		$photo->paths = $photo->baseDir . '/' . $name;

		$file->move('flyers/photos', $name);

		return $photo;
	}
}
