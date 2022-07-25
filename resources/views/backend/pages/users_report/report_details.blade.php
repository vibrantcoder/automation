<div class="row">
    <div class="col  mr-8">
        <div class="font-size-sm text-muted font-weight-bold">User Name</div>
        <div class="font-size-h4 font-weight-bolder">{{ $report_details[0]['user_name'] }}</div>
    </div>
    <div class="col ">
        <div class="font-size-sm text-muted font-weight-bold">Date & Time</div>
        <div class="font-size-h4 font-weight-bolder">{{ date_time_formate($report_details[0]['created_at']) }}</div>
    </div>
</div>

<div class="row mt-5" style="margin-left: 0.2rem !important;margin-right: 0.2rem !important">
    @php
        $response = json_decode($report_details[0]['response']);        
    @endphp
    @foreach ($response as $res_key => $res_value)
        @foreach ($res_value[0] as $key => $value)            
            <h3>Brand Name : {{ $key }}</h3>
            <table class="table  table-responsive">
                <thead>
                    <tr>
                        @foreach ($value as $us_key => $us_value)
                            <th>{{ $us_key }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($value as $usr_key => $usr_value)
                            <td>{{ $usr_value }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <hr>
        @endforeach
    @endforeach
</div>
 
