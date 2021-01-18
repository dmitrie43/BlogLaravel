@extends('layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <article class="gallery">
                        <table class="table-gallery">
                            <tr>
                                @foreach($gallery as $img)
                                    <td>
                                        <img src="{{$img->getImage()}}" onclick='setBigImage(this)' alt=''/>
                                    </td>
                                @endforeach
                            </tr>
                        </table>
                        <div class="gallery-main">
                            <img id='mainImg' src="{{$image->getImage()}}" onclick="switchBackground()" height='150' alt='Главное изображение'/>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection
