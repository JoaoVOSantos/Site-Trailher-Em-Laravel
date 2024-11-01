@extends ('cliente_template.index')

@section('conteudo')

<div class="modal fade " id="modallogin" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-fullscreen-md-down modal-md modal-dialog-centered " role="document">
        <div class="modal-content p-4 bg-white">
            <div class="modal-body ">
                <div class="login-detail">
                    <div class="login-form p-0">
                        <div class="col-lg-12 mx-auto">
                            <form id="login-form" method="POST" action="{{ route('logout') }}">
                                <h2 class="modal-title fs-3 fw-normal">Bem-vindo, {{ Auth::user()->usu_nome }}</h2>
                                @csrf
                                <div class="modal-footer mt-5 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-red hvr-sweep-to-right dark-sweep">Sair</button>
                                </div>
                            </form>

                            <!-- Remover "modal-footer" para tirar a linha e definir como link para a área de administrador -->
                            <div class="d-flex justify-content-center">
                                @if(Auth::user()->usu_admin == 1)
                                <a href="{{ route('administrador') }}" class="btn btn-red hvr-sweep-to-right dark-sweep">Área Administrador</a>
                                @endif
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                <a href="{{ route('mostrarAreaCliente') }}" class="btn btn-red hvr-sweep-to-right dark-sweep">Área Cliente</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection