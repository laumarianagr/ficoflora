@if(Session::has('warning') )

    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="mt-none">Importante:</h4>
        <ul>

                <li> {{Session::get('warning')}}</li>

        </ul>
    </div>
@endif