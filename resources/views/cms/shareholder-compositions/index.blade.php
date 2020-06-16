@if ($message = Session::get('success'))
    <p>{{ $message }}</p>
@endif

<a href="{{ route('cms.shareholder-compositions.create') }}">{{ __('Import shareholder composition') }}</a><br />
