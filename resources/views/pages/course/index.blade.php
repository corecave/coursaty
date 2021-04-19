@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">{{ __('Courses') }}</div>

                    <div class="card-body table-responsive">
                        @includeIf('layouts.includes.alarts')
                        <div class="form-group">
                            <select name="trashed" class="form-control">
                                <option value=""> -- Select --</option>
                                <option value="with">With Trashed</option>
                                <option value="only">Only Trashed</option>
                            </select>
                        </div>
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
