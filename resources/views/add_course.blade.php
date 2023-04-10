@if (isset($course))
    <h1>Edit course</h1>
@else
    <h1>Add course</h1>
@endif

<form action="{{ isset($course) ? route('course.update.store' , ['cat_id' => $category->cat_id, 'les_id' => $course->les_id]) : route('course.store' , ['cat_id' => $category]) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Are you sure ?')">
    @csrf

    @if ($errors->any())
        <h1 style="color: red">Something went wrong</h1>
    @endif

    <label for="">Course name :</label>
    <input type="text" name="name" value="{{ $course->les_name ?? '' }}">
    @if ($errors->any())
        @foreach ($errors->get('name') as $error)
            <h5 style="color: red">{{ $error }}</h5>
        @endforeach
    @endif
    <br/><br/>

    <label for="">Course price :</label>
    <input type="number" name="price" value="{{ $course->les_price ?? '' }}">
    <br/><br/>
    
    <label for="">Course picture :</label>
    <input type="file" name="image">
    @if ($errors->any())
        @foreach ($errors->get('image') as $error)
            <h5 style="color: red">{{ $error }}</h5>
        @endforeach
    @endif
    <br/><br/>

    <label for="">Course description :</label>
    <textarea name="description" cols="30" rows="10">{{ $course->les_content ?? '' }}</textarea>
    @if ($errors->any())
        @foreach ($errors->get('description') as $error)
            <h5 style="color: red">{{ $error }}</h5>
        @endforeach
    @endif
    <br/><br/>

    <button type="submit" class="btn btn-primary">{{ isset($course) ? 'Update' : 'Create' }}</button>

</form>