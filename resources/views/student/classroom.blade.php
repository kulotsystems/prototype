<!DOCTYPE html>
<html>
<head>
    <title>Classroom</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
</head>
<style type="text/css">
    *{
        margin: 0;
    }
    .main-box{
        margin: auto;
        width: 400px;
    }
</style>
<body>
<x-app-layout>
    <div class="main-box">
        <br>
        <br>
        <h1 style="font-size: 22px">Join Classroom</h1>
        <br>
        <br>
        @if (session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif
        <form action="{{ url('/classroom') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Search Room</label>
                <input type="text" class="search form-control" id="exampleFormControlInput1" style="border-color: lightgray;border-radius: 4px" name="search_room">
            </div><br>
            <button class="btn btn-success" type="submit" style="background-color: green">GO</button>
        </form>
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">Room Name</th>
                <th scope="col">Description</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($filterData))
                @foreach ($filterData as $filterDatas)
                    <tr>
                        <td>{{ $filterDatas->rname }}</td>
                        <td>{{ $filterDatas->description }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</x-app-layout>
</body>
</html>
