@if ($errors->any())
    <div>
        <strong>{{ __('Please check the form below for errors') }}</strong>
        <ol>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ol>
    </div>
@endif

<form id="createShareholderCompositionsForm" method="post" action="{{ route('cms.shareholder-compositions.store') }}" enctype="multipart/form-data">
    @method('post')
    @csrf()
    <label for="txtFile">{{ __('Txt file') }}</label><br/>
    <input id="txtFile" name="txtFile" type="file" placeholder="{{ __("Txt file") }}" accept=".txt"><br/><br/>

    <button type="submit">{{ __('Store to database') }}</button>
</form>
