<div>
    <p>{{$model->id}}</p>
    <p>{{$model->name}}</p>
    <p>{{$model->default_access}}</p>
    <p>{{$model->info}}</p>
    <a href="{{ route($action.'.edit', $model->id) }}"> Bearbeiten</a>
</div>