@if ($message = Session::get('success'))
    <p>{{ $message }}</p>
@endif

<a href="{{ route('cms.foreign-transactions.create') }}">Import foreign transaction</a>
