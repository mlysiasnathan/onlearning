<h1>Add Category</h1>

<form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if ($errors->any())
        <h1 style="color: red">Something went wrong</h1>
    @endif

    <label for="">Category name :</label>
    <input type="text" name="name">
    @if ($errors->any())
        @foreach ($errors->get('name') as $error)
            <h5 style="color: red">{{ $error }}</h5>
        @endforeach
    @endif
    <br/><br/>
    
    <label for="">Category picture :</label>
    <input type="file" name="image">
    @if ($errors->any())
        @foreach ($errors->get('image') as $error)
            <h5 style="color: red">{{ $error }}</h5>
        @endforeach
    @endif
    <br/><br/>

    <label for="">Category description :</label>
    <textarea name="description" cols="30" rows="10"></textarea>
    @if ($errors->any())
        @foreach ($errors->get('description') as $error)
            <h5 style="color: red">{{ $error }}</h5>
        @endforeach
    @endif
    <br/><br/>

    <button type="submit" class="btn btn-primary">Create</button>

</form>