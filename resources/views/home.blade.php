@extends('layouts.app')

@section('content')
    <div class="container"
         x-data="todoList">
        <div class="row">
            <div class="col justify-content-between mb-3">
                <button class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#todoFormModal"
                        type="button">
                    <span class="bi bi-journal-plus"></span>
                    {{ __('New') }}
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <section class="card">
                    <h5 class="card-header">
                        <span class="bi bi-journals text-muted"></span>
                        {{ __('My To-Do List') }}
                    </h5>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success"
                                 role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <section class="card mb-3"
                                 x-show="! loaded">
                            <h5 class="card-header">
                                <div class="placeholder-glow">
                                    <span class="placeholder rounded col-12 col-md-6"></span>
                                </div>
                            </h5>

                            <div class="card-body">
                                <div class="placeholder-glow">
                                    <span class="placeholder rounded col-12 col-md-8"></span>
                                </div>

                                <div class="placeholder-glow">
                                    <span class="placeholder rounded col-12 col-md-10"></span>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="placeholder-glow">
                                    <span class="placeholder rounded col-12 col-md-4"></span>
                                </div>
                            </div>
                        </section>

                        <template x-for="item in data">
                            <section class="card mb-3"
                                     x-bind:id="item.id">
                                <h5 class="card-header">
                                    <span class="bi bi-journal-check"></span>

                                    <span x-text="item.title"></span>
                                </h5>

                                <div class="card-body">
                                    <p x-text="item.description"></p>

                                    <small class="text-muted">
                                        <span class="bi bi-clock"></span>

                                        <span x-text="item.created_at"></span>
                                    </small>
                                </div>

                                <div class="card-footer">
                                    <button class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#todoFormModal"
                                            type="button"
                                            x-bind:data-key="item.id"
                                            x-on:click="fetch($el.dataset.key)">
                                        <span class="bi bi-journal-text"></span>
                                        {{ __('Edit') }}
                                    </button>

                                    <button class="btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#todoDeleteModal"
                                            type="button"
                                            aria-label="{{ __('Delete') }}"
                                            x-bind:data-key="item.id">
                                        <span class="bi bi-journal-x"></span>
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </section>
                        </template>

                        <template x-if="loaded && ! data.length">
                            <section class="card mb-3">
                                <h5 class="card-header text-muted text-center">
                                    <span class="bi bi-journal-x"></span>
                                    {{ __('Ooops!') }}
                                </h5>

                                <div class="card-body text-muted text-center">
                                    <span class="bi bi-journal-x"></span>
                                    {{ __('Nothing here!') }}
                                </div>
                            </section>
                        </template>
                    </div>
                </section>
            </div>
        </div>

        <template x-if="lastPage > 1">
            <ul class="pagination">
                <li class="page-item"
                    x-bind:class="{ 'disabled': currentPage == 1 }">
                    <button class="page-link"
                            type="button"
                            aria-label="{{ __('pagination.previous') }}"
                            x-on:click="fetchPage(Number(currentPage) - 1)"
                            x-bind:disabled="currentPage == 1">
                        <span class="bi bi-chevron-double-left"></span>
                    </button>
                </li>

                <li class="page-item disabled">
                    <span class="page-link">
                        <span class="bi bi-journals"></span>

                        <span x-text="currentPage"></span>

                        {{ __('of') }}

                        <span x-text="lastPage"></span>
                    </span>
                </li>

                <li class="page-item"
                    x-bind:class="{ 'disabled': currentPage == lastPage }">
                    <button class="page-link"
                            type="button"
                            aria-label="{{ __('pagination.next') }}"
                            x-on:click="fetchPage(Number(currentPage) + 1)"
                            x-bind:disabled="currentPage == lastPage">
                        <span class="bi bi-chevron-double-right"></span>
                    </button>
                </li>
            </ul>
        </template>

        <section class="modal fade"
                 id="todoFormModal"
                 tabindex="-1"
                 x-on:shown-bs-modal.dot="$el.querySelector('.modal-body input')
                    .focus()"
                 x-on:hidden-bs-modal.dot="reset()">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <span class="bi bi-journal-plus text-muted"></span>
                            {{ __('To-Do') }}
                        </h5>

                        <button class="btn-close"
                                data-bs-dismiss="modal"
                                type="button"
                                aria-label="{{ __('Close') }}"></button>
                    </div>

                    <div class="modal-body">
                        <form id="todoForm"
                              method="POST"
                              x-on:submit.prevent="save()">
                            <div class="mb-3">
                                <input class="form-control"
                                       type="text"
                                       required
                                       maxlength="128"
                                       placeholder="{{ __('Add a title for your To-Do') }}"
                                       x-model="attributes.title">
                            </div>

                            <div class="mb-3">
                                <textarea class="form-control"
                                          rows="8"
                                          maxlength="2048"
                                          placeholder="{{ __('Describe your To-Do here') }}"
                                          x-model="attributes.description"></textarea>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary"
                                type="submit"
                                form="todoForm">
                            <span class="bi bi-journal-check"></span>
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="modal fade"
                 id="todoDeleteModal"
                 tabindex="-1"
                 x-on:show-bs-modal.dot="$el.querySelector('.modal-footer button')
                    .dataset.key = $event.relatedTarget.dataset.key"
                 x-on:hide-bs-modal.dot="delete $el.querySelector('.modal-footer button')
                    .dataset.key">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <span class="bi bi-journal-x text-muted"></span>
                            {{ __('To-Do') }}
                        </h5>

                        <button class="btn-close"
                                data-bs-dismiss="modal"
                                type="button"
                                aria-label="{{ __('Close') }}"></button>
                    </div>

                    <div class="modal-body">
                        <strong class="text-danger">
                            {{ __('Are you sure to DELETE this To-Do?') }}
                        </strong>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-danger"
                                type="button"
                                x-on:click="destroy($el.dataset.key)">
                            <span class="bi bi-journal-x"></span>
                            {{ __('Delete') }}
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
