<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>{{ __('AclLang::views.title') }}</title>
<!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    body {
        height: 100%;
        background: #202020; /* fallback for old browsers */
        background: -webkit-radial-gradient(#202020, #303030);
        background: -moz-radial-gradient( #202020, #303030);
        background: -o-radial-gradient( #202020, #303030);
        background: radial-gradient(#202020, #303030);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    footer {
        position: relative;
        bottom: 20px;
        width: 100%;
        height: 60px;
        line-height: 60px;
    }
    #logout-form {
        display: none;
    }
    .form {
        position: relative;
        z-index: 1;
        background: #ffffff; /* fallback for old browsers */
        background: -webkit-radial-gradient(#ffffff, #f2dede);
        background: -moz-radial-gradient( #ffffff, #f2dede);
        background: -o-radial-gradient( #ffffff, #f2dede);
        background: radial-gradient(#ffffff, #f2dede);
        max-width: 540px;
        margin: 100px auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
    .table, .alert  {
        margin: 50px auto 10px;
        box-shadow: 0 0 25px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
    .form input[type="text"], input[type="email"], input[type="password"] {
        outline: 0;
        background: #c1c1c1;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
        text-align: center;
    }
    .form input[type="radio"] {
        margin: 15px 15px 15px 15px;
    }
    .form input[type="submit"] {
        text-transform: uppercase;
        outline: 0;
        background: #2F2F2F;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #2fa360;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
        margin-top: 15px;
    }
    .form input[type="submit"]:hover,.form input[type="submit"]:active,.form input[type="submit"]:focus {
        background: #2fa360;
        color: #2F2F2F;
    }
    p {
        color:#2fa360
    }
    h1, h2, h3, h4, h5, h6{
        margin: 25px 0 0 0;
        color: #c1c1c1;
    }
    .modal-content {
        background-color: #343a40;
    }
    .modal-header, .modal-footer {
        border: none;
    }
    .modal-header .heading
    {
        color: red;
    }
</style>