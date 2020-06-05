@if ($message = Session::get('success'))
    <p>{{ $message }}</p>
@endif

<a href="{{ route('cms.foreign-transactions.create') }}">{{ __('Import foreign transaction V1') }}</a><br />
<a href="{{ route('cms.foreign-transactions.create.v2') }}">{{ __('Import foreign transaction V2') }}</a>
