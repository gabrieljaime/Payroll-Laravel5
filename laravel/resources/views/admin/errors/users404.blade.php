@extends('admin.layouts.dashboard')

@section('template_title')
@endsection

@section('template_fastload_css')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
            Pagina de Error 404
            </h1>
            <ol class="breadcrumb">
                <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Tablero</a></li>
                <li class="active">Error 404</li>
            </ol>
        </section>
        <section class="content">
            <div class="error-page">
                <h2 class="headline text-yellow"> 404</h2>
                <div class="error-content">
                    <h3><i class="fa fa-warning text-yellow"></i>Ups! Página no encontrada.</h3>
                    <p>
                        No hemos podido encontrar la página que estabas buscando.
                        Mientras tanto, puedes <a href="/dashboard"> volver al panel </a> {{-- or try using the search form. --}}
                    </p>
{{--                     <form class="search-form">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form> --}}
                </div>
            </div>
        </section>
    </div>
@endsection

@section('template_scripts')

@include('admin.structure.dashboard-scripts')
@endsection