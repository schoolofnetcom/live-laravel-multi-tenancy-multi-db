@extends('layouts.tenant')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Categorias</div>

                    <div class="card-body">
                        <ul>
                            @foreach($categories as $category)
                                <li>
                                    {{$category->name}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
