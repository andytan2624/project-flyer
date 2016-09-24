<?php
use App\Flyer;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Mockery as m;

class AddPhotoTyoFlyerTest extends TestCase
{

    /** @test */
    function it_()
    {
        $flyer = factory(App\Flyer::class)->create();

        $file = m::mock(UploadedFile::class, [
            'getClientOriginalName' => 'foo',
            'getClientOriginalExtension' => 'jpg'
        ]);

        $file->shouldReceive('move');

        //$form = new AddPhotoToFlyer($flyer, $file, $thumbnail);
    }
}