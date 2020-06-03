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

<form id="createForeignTransactionForm" method="post" action="{{ route('cms.foreign-transactions.store') }}" enctype="multipart/form-data">
    @method('post')
    @csrf()
    <label for="csvFile">Csv file</label><br/>
    <input id="csvFile" name="csvFile" type="file" placeholder="{{ __("Csv file") }}"  accept=".csv"><br/><br/>

    <label for="transactionDate">Transaction date</label><br/>
    <input id="transactionDate" name="transactionDate" type="date" placeholder="Transaction date" value="{{ now()->format('Y-m-d') }}"><br/><br/>

    <label for="transactionType">Transaction type</label><br/>
    <input type="radio" id="transactionTypeVolume" name="transactionType" value="volume" checked>
    <label for="transactionTypeVolume">Volume</label><br/>
    <input type="radio" id="transactionTypeValue" name="transactionType" value="value">
    <label for="transactionTypeValue">Value</label><br/><br/>

    <button type="submit">Store to database</button>
</form>
