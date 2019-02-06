<form method="POST" action="{{ route($action.'.store') }}">
    @csrf
    <input type="text" name="name" value="name">
    <input type="text" name="info" value="info">
    Active <input type="radio" name="default_access" value=1>
    Disabled <input type="radio" name="default_access" value=0>
    <input type="submit" name="submit" value="Hinzufügen">
</form>