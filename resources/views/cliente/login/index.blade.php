@extends('cliente_template.index')


@section('conteudo')



<div class="modal fade " id="modallogin" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-fullscreen-md-down modal-md modal-dialog-centered " role="document">
        <div class="modal-content p-4 bg-white">
            <div class="modal-header mx-auto border-0">
                <h2 class="modal-title fs-3 fw-normal">Login</h2>
            </div>
            <div class="modal-body ">
                <div class="login-detail">
                    <div class="login-form p-0">
                        <div class="col-lg-12 mx-auto">
                            <form id="login-form" class="" method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="Email">
                                    <label for="floatingEmail">Email</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Senha">
                                    <label for="floatingPassword">Senha</label>
                                </div>

                                <div class="modal-footer mt-5 d-flex justify-content-center">
                                <button type="submit" class="btn btn-red hvr-sweep-to-right dark-sweep">Login</button>
                                <button type="button" onclick="window.location.href='{{ route('register') }}'" class="btn btn-outline-gray hvr-sweep-to-right dark-sweep">Registre-se</button>
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