@extends ('cliente_template.index')

@section('conteudo')

<div class="modal fade " id="modallogin" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-fullscreen-md-down modal-md modal-dialog-centered " role="document">
        <div class="modal-content p-4 bg-white">
            <div class="modal-body ">
                <div class="login-detail">
                    <div class="login-form p-0">
                        <div class="col-lg-12 mx-auto">
                            <form id="login-form" class="" method="POST" action="{{ route('logout') }}">
                            <h2 class="modal-title fs-3 fw-normal">Bem-vindo, {{ Auth::user()->usu_nome }}</h2>
                                @csrf
                                <div class="modal-footer mt-5 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-red hvr-sweep-to-right dark-sweep">Sair</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection