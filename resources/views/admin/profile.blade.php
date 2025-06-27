@extends('admin.inc.layouts')

@section('parentMenu', 'Profile')
@section('page-title', 'Profile')

@section('admin-content')

    @push('styles')
        <!--cubeportfolio-->
        <link type="text/css" rel="stylesheet" href="{{ asset('dist/plugins/cubeportfolio/css/cubeportfolio.min.css') }}">
        <style>
            .cbp-item img {
                height: 400px;
                width: 100%;
                object-fit: cover;
            }

            .department-label {
                position: absolute;
                top: 10px;
                right: 10px;
                background: #007bff;
                color: white;
                padding: 4px 10px;
                font-size: 12px;
                border-radius: 4px;
                text-transform: capitalize;
                box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
            }
        </style>
    @endpush

    <div class="row">
        <div class="col-lg-12">
            <div class="chart-box">
                <div id="js-filters-masonry" class="cbp-l-filters-alignRight">
                    <div data-filter="*" class="cbp-filter-item-active cbp-filter-item"> All</div>
                    @foreach ($departments as $department)
                        <div data-filter=".{{ Str::slug($department) }}" class="cbp-filter-item">
                            {{ $department }}
                        </div>
                    @endforeach
                </div>

                <div id="js-grid-masonry" class="cbp">
                    @foreach ($users as $user)
                        <div class="cbp-item {{ Str::slug($user->department) }}">
                            <a href="{{ !empty($user->profile_image)
                                ? asset('uploads/profile/' . $user->profile_image)
                                : ($user->gender == 'male'
                                    ? asset('default-male.jpg')
                                    : asset('default-female.jpg')) }}"
                                class="cbp-caption cbp-lightbox" data-title="{{ $user->name }}<br>{{ $user->role }}">

                                <div class="cbp-caption-defaultWrap position-relative">
                                    <img src="{{ !empty($user->profile_image)
                                        ? asset('uploads/profile/' . $user->profile_image)
                                        : ($user->gender == 'male'
                                            ? asset('default-male.jpg')
                                            : asset('default-female.jpg')) }}"
                                        alt="{{ $user->name }}" style="height: 400px; width: 100%; object-fit: cover;">

                                    <div class="department-label">
                                        {{ $user->department }}
                                    </div>
                                </div>


                                <div class="cbp-caption-activeWrap">
                                    <div class="cbp-l-caption-alignCenter">
                                        <div class="cbp-l-caption-body">
                                            <div class="cbp-l-caption-title">{{ $user->name }}</div>
                                            <div class="cbp-l-caption-desc">{{ $user->position ?? '' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <!--cubeportfolio-->
        <!-- load jquery -->
        <script src="{{ asset('dist/plugins/cubeportfolio/jquery-latest.min.js') }}"></script>
        <!-- load cubeportfolio -->
        <script src="{{ asset('dist/plugins/cubeportfolio/jquery.cubeportfolio.min.js') }}"></script>
        <!-- init cubeportfolio -->
        <script src="{{ asset('dist/plugins/cubeportfolio/main.js') }}"></script>
    @endpush
@endsection
