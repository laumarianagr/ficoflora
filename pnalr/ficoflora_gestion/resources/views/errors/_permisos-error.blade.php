@if($errors->any())
    @if(Session::has('permisos'))
        <?php $permisos = Session::get('permisos')?>

        <div class="alert alert-danger error_permisos">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            <h4 class="mt-none"></h4>

                @foreach($errors->all() as $error)
                    {{$permisos}}
                @endforeach

        </div>

    @endif
@endif
