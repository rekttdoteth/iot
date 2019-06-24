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
    <a class="p-4 m-4 rounded text-black text-xl bg-green action-btns" href="/backend/researcher/create">Create New</a>
</div>
<div class="container mx-auto">
    <table class="border border-grey-dark m-2">
        <tr>
            <th>Avatar</th>
            <th>Image</th>
            <th class="p-2">Full Name</th>
            <th class="p-2">Bio</th>
            <th class="p-2">Profile URL</th>
            <th class="p-2">Related Projects</th>
            <th></th><th></th>
        </tr>
        @foreach($data as $researcher)
        <tr class="">
            <td class="p-2"><img width="50" height="50" class="border-white shadow-md border-2 rounded-full" src="{{ Avatar::create($researcher->fullname)->setDimension(200)->toBase64() }}"></td>
            <td class="p-2">
                @if($researcher->image_url != NULL)
                <img width="50" height="50" class="border-white shadow-md border-2 rounded-full" src="{{ \Image::make($researcher->image_url)->greyscale()->encode('data-url') }}">
                @endif
            </td>
            <td class="p-2">{{ $researcher->fullname }}</td>
            <td class="p-2"><?php echo $researcher->bio ?></td>
            <td class="p-2"><a href="{{ $researcher->profile_url }}" target="_blank">{{ $researcher->profile_url }}</a></td>
            <td class="p-2">{{ implode(", ", $researcher->tagNames()) }}</td>
            <td class="p-2 py-4"><a href="{{ route('backend:researcher:edit', ['researcher' => $researcher]) }}" class="text-black font-bold no-underline p-2 bg-yellow">Edit</a></td>
            <td class="p-2 py-4">
                <form  id="delete-form-{{ $researcher->id }}" action="{{ route('backend:researcher:destroy', ['researcher' => $researcher]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="text-white font-bold no-underline p-2 bg-red delete-btn" data-id="{{ $researcher->id }}" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
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
    });
</script>
@endsection