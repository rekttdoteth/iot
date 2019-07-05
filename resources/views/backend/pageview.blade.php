@extends('public.base')
@section('head')
<style type="text/css">
	input:focus {
	  border-style: solid;
	  border-width: 2px;
	  border-color: grey;
	}
	input:focus,
	select:focus,
	textarea:focus,
	button:focus {
	    outline: none;
	}

	html, body {
	  overflow: scroll !important;
	}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
@endsection
@section('content')
@include('backend.v2nav')
<form class="container mx-auto text-center" id="createForm" method="post" action="{{ route('update:page', ['id' => $p->id])}}">
@csrf
@method('PUT') 
<div class="flex justify-left">
	<button class="p-4 m-4 bg-green-light rounded" type="submit" id="submit-btn">Save</button>
	<button class="p-4 m-4 bg-yellow-light rounded" type="reset">Reset</button>
</div>
<div class="flex flex-col">
	<input type="text" class="text-3xl font-bold text-teal-dark text-center" name="nav_title" value="{{ $p->nav_title }}">
	<input type="text" class="text-5xl font-bold text-teal-dark pt-2 text-center" name="title" value="{{ $p->title }}">
</div>
	{{-- @if(!is_null($snss))
		<div class="flex justify-center mt-4">
			@foreach($snss as $sns)
				<div class="flex flex-col">
					<input class="text-teal-dark text-center" value="{{ $sns->display_name }}" name="sns-{{ $sns->id }}">
					<input class="text-grey-darker text-center m-2" value="{{ $sns->url }}" name="sns_url_{{ $sns->id }}">
				</div>
				<span class="border border-teal-dark"></span>
			@endforeach
		</div>
	@endif --}}

	@if(!is_null($desc))
		<div class="mt-12">
			<textarea name="description" class="text-xl text-grey-darker pt-6 summernote"></textarea>
		</div>
	@endif
	@if(!is_null($sub_navs))
		<div class="flex w-full container mx-auto m-8 justify-center">
			@foreach($sub_navs as $sub_nav)
				<button class="bg-grey-lighter px-6 py-4 border border-grey text-teal-dark sub-nav-btn" content-id="{{ $sub_nav->content_id }}">{{ $sub_nav->display_text }}</button>
			@endforeach
		</div>
	@endif
	@if($p->has_keywords)
	<div class="flex m-2">
		<label class="self-center">Keyword</label>
		<input class="self-center m-2 p-2 bg-white rounded border border-grey" type="text" id="keyword-input"/>
		<button class="p-2 bg-white rounded border border-grey" id="add-btn">Add</button>
	</div>
    <div class="flex">
        <label class="p-2">Keyword Lists</label>
        <div id='app' class="border border-grey">
            <div class='tagHere'></div>
            <input type="text" name="tags-field"/>
        </div>
    </div>
	<input type="hidden" id="tag_values" name="tags">
	@endif
	<div class="flex flex-col h-full w-full border-2 border-grey container mx-auto p-4 my-4">
		@if($p->has_keywords)
		<div class="flex flex-wrap">
			@foreach($tags as $tag)
			<button class="rounded-full bg-inherit border border-grey cursor-default this-black px-4 py-2 mx-4 my-2 text-sm">#{{ $tag }}</button>
			@endforeach
		</div>
		@endif
		<div class="border border-grey-light mt-4"></div>
		<div class="m-6">
			@if($p->title == "My Corner")
			<div class="flex">
				<a class="p-4 m-4 rounded text-black text-xl bg-yellow action-btns" href="/backend/blog">View All Post</a>
				<a class="p-4 m-4 rounded text-black text-xl bg-green action-btns" href="/backend/blog/create">Create New Post</a>
			</div>
			@endif
			@if($p->id == 6)
			<table class="content mx-auto mt-6">
		        <tr class="bg-grey p-5 text-center">
		            <th class="this-black py-5 px-6">TYPE OF ENQUIRY</th>
		            <th class="this-black py-5 px-6">DATE</th>
		            <th class="this-black py-5 px-6">MESSAGE</th>
		            <th></th>
		            <th></th>
		        </tr>
		        @foreach($enquiries as $contact)
		        <tr class="bg-grey-lightest p-5 text-center">
		            <td class="this-black py-5 px-6">{{ $contact->type }}</td>
		            <td class="this-black py-5 px-6">{{ \Carbon\Carbon::parse($contact->created_at)->toDateString() }}</td>
		            <td class="this-black py-5 px-6">{{ strlen($contact->message) > 50 ? substr($contact->message,0,50)."..." : $contact->message }}</td>
		            <td class="p-2 py-4"><a href="#message-{{ $contact->id }}" rel="modal:open" class="text-black font-bold no-underline p-2 bg-yellow">View</a></td>
					<td><form  id="delete-form-{{ $contact->id }}" action="{{ route('backend:enquiry:destroy', ['enquiry' => $contact->id]) }}" method="POST">
	                    @csrf
	                    @method('DELETE')
	                    <button class="text-white font-bold no-underline p-2 bg-red delete-btn" data-id="{{ $contact->id }}" type="submit">Delete</button>
	                </form></td>
		        </tr>
		        <div id="message-{{ $contact->id }}" class="modal">
				  <p class="text-large font-bold">{{ \Carbon\Carbon::parse($contact->created_at)->toDateString() }}</p>
				  <p class="text-large">{{ $contact->name }} | {{ $contact->email }} | {{ $contact->phone }}</p>
				  <p class="text-large font-bold underline">RE:{{ ucfirst($contact->type) }}</p>
				  <p class="text-large">{{ $contact->message }}</p>
				  <a class="text-xl font-bold text-red underline" href="#" rel="modal:close">Close</a>
				</div>
		        @endforeach
		    </table>
			@endif
			@foreach($sub_navs as $sub_nav)
			<div class="flex">
				@if($sub_nav->content_id == 'bodies')
				<a class="hidden p-4 m-4 rounded text-black text-xl bg-yellow action-btns" id="edit-btn-{{ $sub_nav->content_id }}" href="/backend/about/3/edit">Edit Professional Bodies</a>
				@elseif($sub_nav->content_id == 'recognition')
				<a class="hidden p-4 m-4 rounded text-black text-xl bg-yellow action-btns" id="edit-btn-{{ $sub_nav->content_id }}" href="/backend/about/7/edit">Edit Academic Recognition</a>
				@elseif($sub_nav->content_id == 'education')
				<a class="hidden p-4 m-4 rounded text-black text-xl bg-yellow action-btns" id="edit-btn-{{ $sub_nav->content_id }}" href="/backend/about/2/edit">Edit Education Background</a>
				@elseif($sub_nav->content_id == 'qualification')
				<a class="hidden p-4 m-4 rounded text-black text-xl bg-yellow action-btns" id="edit-btn-{{ $sub_nav->content_id }}" href="/backend/about/4/edit">Edit Qualification & Skills</a>
				@elseif($sub_nav->content_id == 'teaching')
				<a class="hidden p-4 m-4 rounded text-black text-xl bg-yellow action-btns" id="edit-btn-{{ $sub_nav->content_id }}" href="/backend/about/5/edit">Edit Teaching Experience</a>
				@elseif($sub_nav->content_id == 'administrative')
				<a class="hidden p-4 m-4 rounded text-black text-xl bg-yellow action-btns" id="edit-btn-{{ $sub_nav->content_id }}" href="/backend/about/6/edit">Edit Administrative Experience</a>
				@elseif($sub_nav->content_id == 'experience')
				<a class="hidden p-4 m-4 rounded text-black text-xl bg-yellow action-btns" id="edit-btn-{{ $sub_nav->content_id }}" href="/backend/about/1/edit">Edit Work Experience</a>
				@elseif($sub_nav->content_id == 'event')
				<a class="hidden p-4 m-4 rounded text-black text-xl bg-yellow action-btns" href="/backend/blog?q=event" id="create-btn-{{ $sub_nav->content_id }}">View All Event</a>
				<a class="hidden p-4 m-4 rounded text-black text-xl bg-green action-btns" href="/backend/blog/create" id="add-btn-{{ $sub_nav->content_id }}">Create New Event</a>
				@else
				<a class="hidden p-4 m-4 rounded text-black text-xl bg-yellow action-btns" href="/backend/<?php echo $sub_nav->content_id == 'education' ? 'about' : $sub_nav->content_id == 'bodies' ? 'about' : $sub_nav->content_id == 'experience' ? 'about' :  $sub_nav->content_id ?>" id="create-btn-{{ $sub_nav->content_id }}">View All <?php echo $sub_nav->content_id == 'education' ? 'Description' : $sub_nav->content_id == 'bodies' ? 'Description' : $sub_nav->content_id == 'experience' ? 'Description' :  ucfirst($sub_nav->content_id) ?></a>
				<a class="hidden p-4 m-4 rounded text-black text-xl bg-green action-btns" href="/backend/<?php echo $sub_nav->content_id == 'education' ? 'about' : $sub_nav->content_id == 'bodies' ? 'about' : $sub_nav->content_id == 'experience' ? 'about' :  $sub_nav->content_id ?>/create" id="add-btn-{{ $sub_nav->content_id }}">Create New <?php echo $sub_nav->content_id == 'education' ? 'Description' : $sub_nav->content_id == 'bodies' ? 'Description' : $sub_nav->content_id == 'experience' ? 'Description' :  ucfirst($sub_nav->content_id)?></a>
				@endif
			</div>
			@endforeach
		</div>
	</div>


	@if(!is_null($stats))
		<div class="flex justify-center mt-6">
		@foreach($stats as $stat)
			<div class="flex flex-col bg-blue-custom-dark shadow p-6 m-4 rounded">
				<input name="stat-{{ $stat->id }}" class="text-2xl bg-blue-custom-dark font-bold text-orange-dark text-center" value="{{ $stat->content }}">
				<input name="stat_desc_{{ $stat->id }}" class="text-orange-dark bg-blue-custom-dark pt-4 text-center" value="{{ $stat->description }}">	
			</div>
		@endforeach
		</div>
	@endif
</form>
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('.delete-btn').on('click', function(e){
            const formId = $(this).attr('data-id');
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: ['Cancel', 'Yes, delete it!'],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $('#delete-form-'+formId).submit();
                }
            });
        });
		$(".sub-nav-btn").click(function(e){
			e.preventDefault();
			$(".sub-nav-btn").each(function(){
				$(this).removeClass('bg-green text-white');
				$(this).addClass('bg-grey-lighter text-teal-dark');
			});
			$(this).removeClass('bg-grey-lighter text-teal-dark');
			$(this).addClass('bg-green text-white');
			$(".action-btns").each(function(){
				$(this).addClass('hidden');
			});
			var about = ['bodies', 'education', 'experience', 'qualification', 'teaching', 'administrative', 'recognition'];
			if(about.includes($(this).attr('content-id'))){
				$("#edit-btn-"+$(this).attr('content-id')).removeClass('hidden');
			} else {
				$("#create-btn-"+$(this).attr('content-id')).removeClass('hidden');
				$("#add-btn-"+$(this).attr('content-id')).removeClass('hidden');
			}
		});

		$('.summernote').summernote({
	    	height:200,
	    	width: 800,
	    });
	    $(".note-editor").addClass("m-2 shadow-md");
	    @if(!is_null($desc))
	    $('.summernote').summernote("code", `<?php echo $desc->content ?>`);
	    @endif

	    $( "input[name=tags-field]" ).autocomplete({
	      minLength: 0,
	      select: function (e, ui) {
		        var el = ui.item.label;
		        e.preventDefault();
		        addTag(el);
		  },
	    }).click(function(){
		    $(this).autocomplete("search");
		});

	    $("#submit-btn").click(function(e){
	    	e.preventDefault();
	    	$(".selected_items").each(function(){
	    		// $("#tag_values").append($(this).text()+",");
	    		var tag_text = $(this).text()+",";
			    $('#tag_values').val($('#tag_values').val() + tag_text);
	    	});
	    	$("#createForm").submit();
	    });

	    $("#add-btn").click(function(e){
	  		 e.preventDefault();
			 var el = $("#keyword-input").val()
			 $("#keyword-input").val("");
	 		 addTag(el);
	  	});

	  	@foreach($tags as $tag)
		addTag("{{ $tag }}");
		@endforeach  


	    function addTag(element) {
		    $appendHere = $(".tagHere");
		    var $tag = $("<div />"), $a = $("<a href='#' />"), $span = $("<span />");
		    $tag.addClass('tag rounded-full');
		    $('<i class="fa fa-times" aria-hidden="true"></i>').appendTo($a);
		    $span.addClass('selected_items');
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