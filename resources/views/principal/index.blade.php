@extends('cliente_template.index')

@section('conteudo')
<section class="slider_section text-white">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($produtosMaisPedidas as $index => $item)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 col-lg-6">
                                <div class="detail-box">
                                    <h1>{{ $item->pro_nome }}</h1>
                                    <p>{{ $item->pro_descricao }}</p>
                                    <div class="btn-box">
                                        <a href="{{ route('adicionar.carrinho', $item->id) }}" class="btn1">
                                            Compre Agora
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="container">
            <ol class="carousel-indicators">
                @foreach ($produtosMaisPedidas as $index => $item)
                    <li data-target="#customCarousel1" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
        </div>
    </div>
</section>
@endsection
