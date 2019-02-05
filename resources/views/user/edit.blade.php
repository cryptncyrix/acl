<form method="POST" action="{{ route($action.'.update') }}">
    @csrf
    <input type="hidden" name="id" value="{{   $model->id }}">
    <input type="text" name="name" value="{{   $model->name }}">
    <input type="email" name="email" value="{{   $model->email }}">
    <input type="password" name="password" value="">
    <input type="text" name="info" value="info">
    <input type="submit" name="submit" value="Aktualisieren">
</form>