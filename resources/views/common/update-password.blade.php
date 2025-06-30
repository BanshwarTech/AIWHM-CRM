@php
    $role = session('USER_ROLE');
    $layout = match ($role) {
        'admin' => 'admin.inc.layouts',
        'team-leader' => 'teamleader.inc.layout',
        'team-member' => 'teammember.inc.layout',
    };

    $content = match ($role) {
        'admin' => 'admin-content',
        'team-leader' => 'teamleader-content',
        'team-member' => 'teammember-content',
    };

@endphp

@extends($layout)


@section('parentMenu', 'Authentication')
@section('page-title', 'Update Password')

@section($content)

@endsection
