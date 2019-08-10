@extends('public.base')

@section('content')
<div class="flex flex-col w-full bg-grey">
	{{-- <div class="flex w-full bg-grey-dark shadow-md this-white">
		<div class="flex mx-8 py-6">
			<p class="font-bold text-2xl">Sami Hajjaj</p>
		</div>
		<div class="container justify-center py-6" style="margin-left: 150px;">
				<a class="no-underline hover:text-blue-darker mx-4" href="/profile">Profile</a>
				<a class="no-underline hover:text-blue-darker mx-4" href="/academic">Academic</a>
				<a class="no-underline hover:text-blue-darker mx-4" href="/research">Research</a>
				<a class="no-underline hover:text-blue-darker mx-4" href="/mycorner">My Corner</a>
				<a class="no-underline hover:text-blue-darker mx-4" href="/contact">Contact Me</a>
		</div>
	</div>
	<div class="flex">
		<div class="flex flex-col px-8 bg-grey-darker py-6 h-screen shadow-md">
			<div class="flex flex-col pt-4">
				<p class="font-extrabold this-white text-xl">Find me on:</p>
				<a class="pt-2 py-1 this-white">LinkedIn</a>
				<a class="py-1 this-white">Google Scholar</a>
				<a class="py-1 this-white">Facebook</a>
				<a class="py-1 this-white">IEEE</a>
				<a class="py-1 this-white">IMeche</a>
				<a class="py-1 this-white">BEM</a>
				<a class="py-1 this-white">IEM</a>
				<a class="py-1 this-white">Others</a> 
			</div>
			<div class="flex flex-col pt-4" style="visibility: hidden;">
				<p class="font-bold this-white text-xl">Recent Activity:</p>
				<a class="pt-2 py-1 this-white">Latest Post</a>
				<a class="py-1 this-white">Recent Project</a>
				<a class="py-1 this-white">Recent Award</a>
			</div>
		</div> --}}
		<div class="flex flex-col text-center w-full h-screen bg-grey">
			<p class="text-5xl font-bold this-white pt-8 mt-16">{{ $data->title }}</p>
			<p class="text-xl this-white pt-6"><?php echo $data->description->content ?></p>
			<a class="mx-auto px-6 mt-16 py-4 text-white bg-green rounded border-2 font-bold border-green" href="/profile">Welcome</a>
		</div>
	</div>
</div>








@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
    	
    });
</script>

@endsection