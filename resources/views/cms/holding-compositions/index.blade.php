@if ($message = Session::get('success'))
    <p>{{ $message }}</p>
@endif

<a href="{{ route('cms.holding-compositions.create') }}">{{ __('Import holding composition') }}</a><br />
