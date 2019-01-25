<div class="box">
    <div class="box-body no-padding">
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <th style="width: 10px">#</th>
                <th style="width: 15%">Package name</th>
                <th style="width: 10%">Current version</th>
                <th style="width: 10%">Latest version</th>
                <th style="width: 10%">Latest status</th>
                <th>Description</th>
            </tr>
            @foreach($packages as $index => $package)
                <tr>
                    <td>{{ $index+1 }}.</td>
                    <td><a href="https://packagist.org/packages/{{$package['name']}}" target="_blank">{{$package['name']}}</a></td>
                    <td>{{$package['version']}}</td>
                    <td>{{ $package['latest'] }}</td>
                    <td><span class="label {{$package['label']}}">{{ $package['latest-status'] }}</span></td>
                    <td>{{ $package['description'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
