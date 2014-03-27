@extends('master')


@section('content')

	<h1>Place Grace</h1>
	
	A <a href='http://en.wikipedia.org/wiki/Grace_Hopper'>Grace Hopper</a> inspired placeholder service.

	<div class="pure-g">
        <div class="pure-u-1-1">
        
        	<img src='http://placegrace.s3.amazonaws.com/grace-hopper-8bit.png'>
        
			<h2>Place Holder Images</h2>
			http://placegrace.com/width/height
        
        	<h2>Filler Text</h2>
            <p>{{ $words }}</p>
            
            <button class="pure-button">Refresh</button>
        </div>
    </div>
@stop