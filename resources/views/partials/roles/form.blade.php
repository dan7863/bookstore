<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Type role name']) !!}
    
    @error('name')
        <small class = "text-danger">
            {{$message}}
        </small>
    @enderror

</div>

<div class="h3">Permissions List</div>

@foreach($permissions as $permission)
    <div>
        <label>
            {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
            {{$permission->description}}
        </label>
    </div>
@endforeach
