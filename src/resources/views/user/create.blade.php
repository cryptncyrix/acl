<form method="POST" action="{{ route($action.'.store') }}">
    @csrf
    <input type="text" name="name" value="name">
    <input type="email" name="email" value="">
    <input type="password" name="password" value="password">
    <input type="text" name="info" value="info">
    Active <input type="radio" name="active" value=1>
    Disabled <input type="radio" name="active" value=0>
    <input type="submit" name="submit" value="Hinzufügen">
</form>