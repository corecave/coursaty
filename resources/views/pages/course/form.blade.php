@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card" x-data="FORMS.course({{ isset($course) ? $course->toJson() : 'undefined' }})"
                    x-init="init" @input="V" @change="V" @focusout="V">
                    <div class="card-header" x-text="title"></div>

                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="form-group row validated">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text"
                                        :class="{'form-control': true, 'is-invalid': hasErrors('name') && isTouched('name')}"
                                        id="name" name="name" placeholder="Name" x-model="form.name">
                                    <div class="invalid-feedback" x-html="getErrors('name')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row validated">
                                <label for="name" class="col-sm-2 col-form-label">Author</label>
                                <div class="col-sm-10">
                                    <input type="text"
                                        :class="{'form-control': true, 'is-invalid': hasErrors('author') && isTouched('author')}"
                                        id="author" name="author" placeholder="Name" x-model="form.author">
                                    <div class="invalid-feedback" x-html="getErrors('author')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row validated">
                                <label for="active" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select
                                        :class="{'form-control': true, 'is-invalid': hasErrors('active') && isTouched('active')}"
                                        id="active" name="active" x-model="form.active">
                                        <option value="">-- Select --</option>
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                    <div class="invalid-feedback" x-html="getErrors('active')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row validated">
                                <label for="level" class="col-sm-2 col-form-label">Level</label>
                                <div class="col-sm-10">
                                    <select
                                        :class="{'form-control': true, 'is-invalid': hasErrors('level') && isTouched('level')}"
                                        id="level" name="level" x-model="form.level">
                                        <option value="">-- Select --</option>
                                        <option value="beginner">Beginner</option>
                                        <option value="immediate">Immediate</option>
                                        <option value="high">High</option>
                                    </select>
                                    <div class="invalid-feedback" x-html="getErrors('level')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row validated">
                                <label for="views" class="col-sm-2 col-form-label">Hours</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0"
                                        :class="{'form-control': true, 'is-invalid': hasErrors('hours') && isTouched('hours')}"
                                        id="hours" name="hours" placeholder="Hours" x-model="form.hours">
                                    <div class="invalid-feedback" x-html="getErrors('hours')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row validated">
                                <label for="views" class="col-sm-2 col-form-label">Views</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0"
                                        :class="{'form-control': true, 'is-invalid': hasErrors('views') && isTouched('views')}"
                                        id="views" name="views" placeholder="Views" x-model="form.views">
                                    <div class="invalid-feedback" x-html="getErrors('views')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row validated">
                                <label for="rating" class="col-sm-2 col-form-label">Rating</label>
                                <div class="col-sm-10">
                                    <select
                                        :class="{'form-control': true, 'is-invalid': hasErrors('rating') && isTouched('rating')}"
                                        id="rating" name="rating" x-model="form.rating">
                                        <option value="">-- Select --</option>
                                        <template x-for="i in 5" :key="i">
                                            <option :value="i" x-text="i" :selected="i == form.rating"></option>
                                        </template>
                                    </select>
                                    <div class="invalid-feedback" x-html="getErrors('rating')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row validated">
                                <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select
                                        :class="{'form-control categories-data-ajax': true, 'is-invalid': hasErrors('category_id') && isTouched('category_id')}"
                                        name="category_id" id="category_id" placeholder="Selected Category"
                                        x-ref="selectedCategory" style="width:100%;">
                                        <option v-if="form.category" :value="form.category? form.category.id : ''"
                                            selected="selected" x-text="form.category? form.category.name : ''"></option>
                                    </select>
                                </div>
                                <div class="invalid-feedback" x-html="getErrors('category_id')">
                                </div>
                            </div>
                            <div class="form-group row validated">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea
                                        :class="{'form-control': true, 'is-invalid': hasErrors('description') && isTouched('description')}"
                                        placeholder="Description..." id="description" name="description"
                                        x-model="form.description"></textarea>
                                    <div class="invalid-feedback" x-html="getErrors('description')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" :disabled="hasErrors()">Save
                                        Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
