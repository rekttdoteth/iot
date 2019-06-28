@extends('public.base')
@section('head')
<!-- include summernote css/js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js"></script>
<style type="text/css">
	html, body {
	  overflow: scroll !important;
	}
</style>
@endsection
@section('content')
@include('backend.nav')
<div class="flex container mx-auto">
    <a class="p-4 m-4 rounded text-black text-xl bg-yellow action-btns" href="/v2/backend/getpage/4">Back to Layout</a>
    <a class="p-4 m-4 rounded text-black text-xl bg-green action-btns" href="/backend/project">View All</a>
</div>
<form class="container mx-auto flex flex-col w-1/2" id="createForm" method="POST" action="{{ route('backend:project:store') }}">
	@csrf
	{{-- <div class="flex">
		<label class="self-center">User</label>
		<input class="self-center m-2 p-2 bg-white shadow-md rounded" type="text" name="user_id" value="{{ $user->id }}">
	</div> --}}
	<button class="p-4 m-2 shadow-lg bg-white" type="submit" id="submit-btn">Submit</button>
	<text-input :name="'title'" :data=null/>
	<div class="flex">
		<label class="pt-4">Description</label>
		<textarea name="description" class="m-2 summernote"></textarea>
	</div>
	<date-input :name="'start_date'" :data=null/>
	<date-input :name="'end_date'" :data=null/>
    <div class="flex">
    	<label class="p-2">Related Research Areas</label>
	    <div id='app'>
		    <div class='tagHere'></div>
		    <input type="text" name="tags-field"/>
		</div>
	</div>
	<div class="flex">
		<label class="self-center">Keyword</label>
		<input class="self-center m-2 p-2 bg-white shadow-md rounded" type="text" id="keyword-input"/>
		<button class="p-2 bg-white shadow-md rounded" id="add-btn">Add</button>
	</div>
    <div class="flex">
        <label class="p-2">Keyword Lists</label>
        <div id='app'>
            <div class='ktagHere'></div>
            <input type="text" name="ktags-field"/>
        </div>
    </div>
	<input type="hidden" id="tag_values" name="tags">
	<input type="hidden" id="ktag_values" name="ktags">
</form>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		var tags = [];
		@foreach($r_title as $title)
		tags.push("{{ $title }}");
		@endforeach
		console.log(tags);
		$('.summernote').summernote({
	    	height:200,
	    });
	    $(".note-editor").addClass("m-2 shadow-md");
	    $( "input[name=tags-field]" ).autocomplete({
	      source: tags,
	      minLength: 0,
	      select: function (e, ui) {
		        var el = ui.item.label;
		        e.preventDefault();
		        addTag(el, '.tagHere');
		  },
	    }).click(function(){
		    $(this).autocomplete("search");
		});

		$("#add-btn").click(function(e){
	  		 e.preventDefault();
			 var el = $("#keyword-input").val()
			 $("#keyword-input").val("");
	 		 addTag(el, '.ktagHere');
	  	});

	    $("#submit-btn").click(function(e){
	    	e.preventDefault();
	    	$(".selected_items").each(function(){
	    		// $("#tag_values").append($(this).text()+",");
	    		var tag_text = $(this).text()+",";
    		    $('#tag_values').val($('#tag_values').val() + tag_text);
	    	});
	    	$(".kselected_items").each(function(){
	    		// $("#tag_values").append($(this).text()+",");
	    		var tag_text = $(this).text()+",";
    		    $('#ktag_values').val($('#ktag_values').val() + tag_text);
	    	});
	    	$("#createForm").submit();
	    });

	    function addTag(element, id) {
		    $appendHere = $(id);
		    var $tag = $("<div />"), $a = $("<a href='#' />"), $span = $("<span />");
		    $tag.addClass('tag rounded-full');
		    $('<i class="fa fa-times" aria-hidden="true"></i>').appendTo($a);
		    if(id == '.tagHere'){
			    $span.addClass('selected_items');
			} else {
			    $span.addClass('kselected_items');
			}
		    $span.text(element);
		    $a.bind('click', function(){
		      $(this).parent().remove();
		      $(this).unbind('click');
		    });
		    $a.appendTo($tag);
		    $span.appendTo($tag);
		    $tag.appendTo($appendHere);
		    $("#app input").val('');
		 }
	});
</script>
@endsection