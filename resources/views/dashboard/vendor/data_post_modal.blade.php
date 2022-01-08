<div class="post   col-sm-12 col-md-6 col-lg-4 rounded">
    <table class="datatable table datatable-bordered datatable-head-custom">
    
        <tr>
            {{ dd($vendor->categorys) }}
            @foreach ($vendor->categorys as $item)
                
            
            <td>{{ $item->name}}</td>
            @endforeach
        </tr>
    </table>
</div>