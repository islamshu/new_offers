{{-- <table class=" table" >
    
    <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th >{{ __('Brand name') }}</th>
            <th style="width: 100px;" >{{ __('Brand created at') }}</th>
            <th >{{ __('Brand status') }}</th>
            <th >{{ __('Offer Count') }}</th>
            <th >{{ __('offer name') }}</th>
            <th  style="width: 300px;" >{{ __('offer created at') }}</th>
            <th style="width: 276px;" >{{ __('expired at') }}</th>
            <th >{{ __('offer status') }}</th>
            <th >{{ __('Expired / Notexpired') }}</th>
            <th >{{ __('price') }}</th>
            <th >{{ __('price after discount') }}</th>
            <th >{{ __('percentage discount') }}</th>
            <th >{{ __('Type') }}</th>
            <th >{{ __('Buy Count') }}</th>
            <th >{{ __('client Count') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($offers as $item)
           @if(get_lang() == 'ar')
            <td>{{ @$item->vendor->name_ar }}</td>
            @else
            <td>{{ @$item->vendor->name_en }}</td>
            @endif
            <td>{{ @$item->vendor->created_at }}</td>
            <td>{{ @$item->vendor->status }}</td>
            <td>{{ @$item->vendor->offers->count() }}</td>
            @if(get_lang() == 'ar')
            <td>{{ @$item->name_ar }}</td>
            @else
            <td>{{ @$item->name_en }}</td>
            @endif
            <td>{{ @$item->created_at->format('Y-m-d') }}</td>
            <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->end_time)->format('Y-m-d') }}</td>
            
            <td>{{ $item->status == 0 ? 'deactive' :'active' }}</td>
            @if(Carbon\Carbon::now() > $item->end_time)
            <td> Exprie</td>
            @else
            <td> Not Exprie</td>
            @endif

            <td>{{ @$item->offertype->price}}</td>
            <td>{{ @$item->offertype->price_after_discount}}</td>
            <td>{{ @$item->offertype->discount_value}}</td>
            <td>{{ @$item->offertype->offer_type}}</td>
            <td>{{ @App\Models\Transaction::where('offer_id',$item->id)->count() }}</td>
            <td>{{ get_count_client($item->id) }}</td>

           
            </tr>
        @endforeach
   


    </tbody>

</table>
{!! $offers->appends(request()->input())->links() !!} --}}
<table  class="table table-striped table-hover mb-0" id="dataTable" #tblDealList (scroll)="scrollHandler($event)">
    <thead [style.width.px]="tblWidth">
      <tr>
        <th class="text-center index-clm">*</th>
        <th app-sortable-column columnName="Column1">Column 1</th>
        <th app-sortable-column columnName="Column2">Column 2</th>
        <th app-sortable-column columnName="Column3">Column 3</th>
        <th app-sortable-column columnName="Column4">Column 4</th>
        <th app-sortable-column columnName="Column5">Column 5</th>
        <th app-sortable-column columnName="Column6">Column 6</th>
        <th app-sortable-column columnName="Column7">Column 7</th>
        <th app-sortable-column columnName="Column8">Column 8</th>
        <th app-sortable-column columnName="Column9">Column 9</th>
        <th app-sortable-column columnName="Column10">Column 10</th>
        <th app-sortable-column columnName="Column11">Column 11</th>
        <th app-sortable-column columnName="Column12">Column 12</th>
        <th app-sortable-column columnName="Column13">Column 13</th>
        <th app-sortable-column columnName="Column14">Column 14</th>
        <th app-sortable-column columnName="Column15">Column 15</th>
        <th app-sortable-column columnName="Column16">Column 16</th>

      </tr>
    </thead>