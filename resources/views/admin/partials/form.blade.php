<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Write Subgender Name']) !!}
    
    @error('name')
        <small class = "text-danger">{{$message}}</small>
    @enderror
</div>
<div class = "form-group">
    {!! Form::label('slug', 'Slug') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Write Subgender Slug', 'readonly']) !!}
    @error('slug')
        <small class = "text-danger">{{$message}}</small>
    @enderror
</div>

<div class = "form-group">
    {!! Form::label('gender_id', 'Gender') !!}
    {!! Form::select('gender_id', $genders, null, ['class' => 'form-control']) !!}
    @error('gender_id')
        <small class = "text-danger">{{$message}}</small>
    @enderror

    {{-- <label for = "">Gender: </label>

    <select name = "gender_id" class = "form-control">
        <option value = "" selected>Select One</option>
        @if(!empty($genders))
            @foreach($genders as $gender)
                <option value = "{{$gender->id}}">{{$gender->name}}</option>
            @endforeach
        @endif
    </select> --}}
</div>
