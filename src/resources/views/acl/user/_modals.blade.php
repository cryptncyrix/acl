<div class="modal fade" id="modal_{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_destroy"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">{{__('AclLang::views.sure')}}</p>
            </div>
            <div class="modal-body">
                <h3 class="text-danger"><i class="fa fa-trash "></i> {{__('AclLang::views.users') . ' ' . __('AclLang::views.destroy')}}:</h3>
                <p>{{$value->name}}</p>
            </div>
            <div class="modal-footer flex-center">
                <a href="{{ route($action.'.destroy' , $value->id) }}" class="btn  btn-danger">{{__('AclLang::views.destroy')}}</a>
                <a class="btn  btn-dark" data-bs-dismiss="modal">{{__('AclLang::views.cancel')}}</a>
            </div>
        </div>
    </div>
</div>