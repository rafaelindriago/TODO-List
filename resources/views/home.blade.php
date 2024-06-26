@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <section class="card">
                    <h5 class="card-header">
                        <span class="bi bi-journals text-muted"></span>
                        {{ __('My To-Do List.') }}
                    </h5>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success"
                                 role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
