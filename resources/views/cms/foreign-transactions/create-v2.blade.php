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

<form id="createForeignTransactionForm" method="post" action="{{ route('cms.foreign-transactions.store.v2') }}" enctype="multipart/form-data">
    @method('post')
    @csrf()
    <label for="csvFile">Csv files</label><br/>
    <input id="csvFiles" name="csvFiles[]" type="file" placeholder="{{ __("Csv files") }}"  accept=".csv" multiple="multiple"><br/><br/>

    <button type="submit">Store to database</button>
</form>
