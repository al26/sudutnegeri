@section('title', 'Ikhtisar')

<div class="col-12">
    <div class="card">
        <div class="card-header">Dashboard Admin</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            You are logged in!
        </div>
    </div>
</div>