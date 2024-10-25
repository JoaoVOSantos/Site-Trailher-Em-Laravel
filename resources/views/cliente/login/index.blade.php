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
                                    <label for="floatingInput">Email</label>
                                    <input type="email" class="form-control" name="email">

                                </div>

                                <div class="form-floating mb-3">
                                    <label for="floatingInput">Senha</label>
                                    <input type="password" class="form-control" name="password">

                                </div>
                                <div class="modal-footer mt-5 d-flex justify-content-center">
                                <button type="submit" class="btn btn-red hvr-sweep-to-right dark-sweep">Login</button>
                                <button type="button" onclick="window.location.href='{{ route('register') }}'" class="btn btn-outline-gray hvr-sweep-to-right dark-sweep">Register</button>

                                </div>

                                <div class="checkbox d-flex justify-content-between mt-4">
                                    <p class="lost-password">
                                        <a href="{{ route('register') }}">Não possui uma conta? Registre-se</a>
                                    </p>
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