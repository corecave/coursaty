@extends('layouts.app')

@section('content')
    <div x-data="FORMS.home()" x-init="init">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading" x-html="filters.category.name"></h1>
                <p class="lead text-muted mb-0" x-html="filters.category.notes">
                </p>
                <hr>
                <input class="form-control form-control-lg" type="text" x-model="filters.title"
                    placeholder="Search for course...">
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-3">
                    <div class="card bg-light mb-3">
                        <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Categories
                        </div>
                        <ul class="list-group category_block">
                            <template x-for="category in categories" :key="category.id">
                                <li :class="{'list-group-item': true, 'active': filters.category.id == category.id}"
                                    @click.prevent="filters.category = category">
                                    <a href="javascript:;" x-html="category.name"></a>
                                </li>
                            </template>
                            <template x-if="categoryRequest.loadmore">
                                <li class="list-group-item read-more">
                                    <a href="#" @click.prevent="loadCategories">
                                        <span x-show="!categoryRequest.loading">
                                            Read More...
                                            <i class="fas fa-plus-circle"></i>
                                        </span>
                                        <span x-show="categoryRequest.loading">
                                            Loading...
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </span>
                                    </a>
                                </li>
                            </template>
                        </ul>
                    </div>
                    <div class="card bg-light mb-3">
                        <div class="card-header bg-warning text-white text-uppercase"><i class="fa fa-list"></i> Ratings
                        </div>
                        <ul class="list-group category_block">
                            <li :class="{'list-group-item': true, 'active': filters.rating == 1}"
                                @click="filters.rating = 1">
                                <div class="d-flex align-items-center">
                                    <div class="rating">
                                        <label class="on">☆</label>
                                        <label class="off">☆</label>
                                        <label class="off">☆</label>
                                        <label class="off">☆</label>
                                        <label class="off">☆</label>
                                    </div>
                                    <span class="text-muted ml-2 rating-text">(1207)</span>
                                </div>
                            </li>
                            <li :class="{'list-group-item': true, 'active': filters.rating == 2}"
                                @click="filters.rating = 2">
                                <div class="d-flex align-items-center">
                                    <div class="rating">
                                        <label class="on">☆</label>
                                        <label class="on">☆</label>
                                        <label class="off">☆</label>
                                        <label class="off">☆</label>
                                        <label class="off">☆</label>
                                    </div>
                                    <span class="text-muted ml-2 rating-text">(3000)</span>
                                </div>
                            </li>
                            <li :class="{'list-group-item': true, 'active': filters.rating == 3}"
                                @click="filters.rating = 3">
                                <div class="d-flex align-items-center">
                                    <div class="rating">
                                        <label class="on">☆</label>
                                        <label class="on">☆</label>
                                        <label class="on">☆</label>
                                        <label class="off">☆</label>
                                        <label class="off">☆</label>
                                    </div>
                                    <span class="text-muted ml-2 rating-text">(1500)</span>
                                </div>
                            </li>
                            <li :class="{'list-group-item': true, 'active': filters.rating == 4}"
                                @click="filters.rating = 4">
                                <div class="d-flex align-items-center">
                                    <div class="rating">
                                        <label class="on">☆</label>
                                        <label class="on">☆</label>
                                        <label class="on">☆</label>
                                        <label class="on">☆</label>
                                        <label class="off">☆</label>
                                    </div>
                                    <span class="text-muted ml-2 rating-text">(200)</span>
                                </div>
                            </li>
                            <li :class="{'list-group-item': true, 'active': filters.rating == 5}"
                                @click="filters.rating = 5">
                                <div class="d-flex align-items-center">
                                    <div class="rating">
                                        <label class="on">☆</label>
                                        <label class="on">☆</label>
                                        <label class="on">☆</label>
                                        <label class="on">☆</label>
                                        <label class="on">☆</label>
                                    </div>
                                    <span class="text-muted ml-2 rating-text">(1200)</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card bg-light mb-3">
                        <div class="card-header bg-success text-white text-uppercase">Level</div>
                        <div class="card-body p-0">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input type="checkbox" x-model="filters.levels" class="form-check-input"
                                            id="beginner" value="beginner">
                                        <label class="form-check-label" for="beginner">Beginner</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input type="checkbox" x-model="filters.levels" class="form-check-input"
                                            id="immediate" value="immediate">
                                        <label class="form-check-label" for="immediate">Immediate</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input type="checkbox" x-model="filters.levels" class="form-check-input" id="high"
                                            value="high">
                                        <label class="form-check-label" for="high">High</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card bg-light mb-3">
                        <div class="card-header bg-danger text-white text-uppercase">Time</div>
                        <div class="card-body p-0">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input type="checkbox" x-model="filters.hours" class="form-check-input" id="less-4"
                                            value="less-4">
                                        <label class="form-check-label" for="less-4">Less Than 4 hours</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input type="checkbox" x-model="filters.hours" class="form-check-input" id="less-8"
                                            value="less-8">
                                        <label class="form-check-label" for="less-8">Less Than 8 hours</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input type="checkbox" x-model="filters.hours" class="form-check-input" id="more-8"
                                            value="more-8">
                                        <label class="form-check-label" for="more-8">More Than 8 hours</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <template x-for="course in courses" :key="course.id">
                            <div class="col-12 col-md-6 col-lg-4 item mb-3">
                                <div class="card">
                                    <div class="card-floating-header">
                                        <span class="badge badge-info" x-html="course.category"></span>
                                        <button class="btn btn-icon"><i class="far fa-heart"></i></button>
                                    </div>
                                    <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="javascript:;" title="View Product"
                                                x-html="course.title"></a>
                                        </h5>
                                        <span class="text-muted card-subtitle"><i class="far fa-user"></i>
                                            <span x-text="course.author"></span>
                                        </span>
                                        <p class="card-text mt-1" x-html="course.description"></p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="rating">
                                                <template x-for="i in 5" :key="i">
                                                    <label
                                                        :class="{'on': i <= course.rating, 'off': i > course.rating}">☆</label>
                                                </template>
                                            </div>
                                            <span class="text-muted ml-2 rating-text" x-text="`(${course.level})`"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <div class="col-12">
                            <nav aria-label="...">
                                <ul class="pagination justify-content-center">
                                    <template x-if="courseRequest.loadmore">
                                        <li class="page-item read-more">
                                            <a href="#" class="page-link" @click.prevent="loadCourses">
                                                <span x-show="!courseRequest.loading">
                                                    Read More...
                                                    <i class="fas fa-plus-circle"></i>
                                                </span>
                                                <span x-show="courseRequest.loading">
                                                    Loading...
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </template>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="text-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-lg-4 col-xl-3">
                        <h5>About</h5>
                        <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                        <p class="mb-0">
                            Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant
                            impression.
                        </p>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto">
                        <h5>Informations</h5>
                        <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                        <ul class="list-unstyled">
                            <li><a href="">Link 1</a></li>
                            <li><a href="">Link 2</a></li>
                            <li><a href="">Link 3</a></li>
                            <li><a href="">Link 4</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto">
                        <h5>Others links</h5>
                        <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                        <ul class="list-unstyled">
                            <li><a href="">Link 1</a></li>
                            <li><a href="">Link 2</a></li>
                            <li><a href="">Link 3</a></li>
                            <li><a href="">Link 4</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3">
                        <h5>Contact</h5>
                        <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                        <ul class="list-unstyled">
                            <li><i class="fa fa-home mr-2"></i> My company</li>
                            <li><i class="fa fa-envelope mr-2"></i> email@example.com</li>
                            <li><i class="fa fa-phone mr-2"></i> + 33 12 14 15 16</li>
                            <li><i class="fa fa-print mr-2"></i> + 33 12 14 15 16</li>
                        </ul>
                    </div>
                    <div class="col-12 copyright mt-3">
                        <p class="float-left">
                            <a href="#">Back to top</a>
                        </p>
                        <p class="text-right text-muted">created with <i class="fa fa-heart"></i> by <a
                                href="https://t-php.fr/43-theme-ecommerce-bootstrap-4.html"><i>t-php</i></a> | <span>v.
                                1.0</span></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
@endpush
